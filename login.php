<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');

require_once '../config/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $input = json_decode(file_get_contents('php://input'), true);
        
        $email = $input['email'] ?? '';
        $password = $input['password'] ?? '';
        $remember = $input['remember'] ?? false;
        
        if (empty($email) || empty($password)) {
            throw new Exception('Заполните все поля');
        }
        
        // Поиск пользователя
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ? AND is_active = 1");
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if (!$user || !password_verify($password, $user['password'])) {
            throw new Exception('Неверный email или пароль');
        }
        
        // Генерация токена сессии
        $token = bin2hex(random_bytes(32));
        $expiresAt = $remember ? date('Y-m-d H:i:s', strtotime('+30 days')) : date('Y-m-d H:i:s', strtotime('+1 day'));
        
        // Сохранение сессии
        $stmt = $pdo->prepare("
            INSERT INTO user_sessions (user_id, session_token, ip_address, user_agent, expires_at) 
            VALUES (?, ?, ?, ?, ?)
        ");
        
        $stmt->execute([
            $user['id'],
            $token,
            $_SERVER['REMOTE_ADDR'],
            $_SERVER['HTTP_USER_AGENT'],
            $expiresAt
        ]);
        
        // Обновление времени последнего входа
        $stmt = $pdo->prepare("UPDATE users SET last_login = NOW() WHERE id = ?");
        $stmt->execute([$user['id']]);
        
        // Удаление пароля из данных пользователя
        unset($user['password']);
        
        echo json_encode([
            'success' => true,
            'token' => $token,
            'user' => $user
        ]);
        
    } catch(Exception $e) {
        http_response_code(401);
        echo json_encode([
            'success' => false,
            'error' => $e->getMessage()
        ]);
    }
} else {
    http_response_code(405);
    echo json_encode(['error' => 'Метод не поддерживается']);
}
?>