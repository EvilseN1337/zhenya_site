<?php
// admin_login.php - ИСПРАВЛЕННАЯ ВЕРСИЯ


// Если уже авторизован
if(isset($_SESSION['user_id'])) {
    if($_SESSION['role'] == 'admin') {
        header('Location: admin_dashboard.php');
    } else {
        header('Location: user_dashboard.php');
    }
    exit();
}

$error = '';

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';
    
    if(empty($username) || empty($password)) {
        $error = "Заполните все поля";
    } else {
        try {
            // Ищем пользователя по имени
            $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
            $stmt->execute([$username]);
            $user = $stmt->fetch();
            
            // Отладка (можно удалить после исправления)
            /*
            echo "<pre>";
            echo "Ищем пользователя: $username\n";
            echo "Найден: " . ($user ? 'да' : 'нет') . "\n";
            if($user) {
                echo "Роль в БД: " . $user['role'] . "\n";
                echo "Пароль верный: " . (password_verify($password, $user['password']) ? 'да' : 'нет') . "\n";
            }
            echo "</pre>";
            */
            
            if($user && password_verify($password, $user['password'])) {
                // Проверяем роль
                if($user['role'] == 'admin') {
                    $_SESSION['user_id'] = $user['id'];
                    $_SESSION['username'] = $user['username'];
                    $_SESSION['role'] = $user['role'];
                    
                    header('Location: admin_dashboard.php');
                    exit();
                } else {
                    $error = "У вас нет прав администратора";
                }
            } else {
                $error = "Неверный логин или пароль";
            }
        } catch(PDOException $e) {
            $error = "Ошибка базы данных";
            // Для отладки можно раскомментировать:
            // $error .= ": " . $e->getMessage();
        }
    }
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Вход для администратора</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #2f9bda 0%, #6b7aa1 100%);
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .login-box {
            background: white;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.3);
            width: 350px;
        }
        .login-box h2 {
            text-align: center;
            margin-bottom: 30px;
            color: #333;
        }
        .form-group { margin-bottom: 20px; }
        .form-group input {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 1rem;
        }
        .btn {
            width: 100%;
            padding: 12px;
            background: #1a1a2e;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 1rem;
            cursor: pointer;
        }
        .btn:hover { background: #16213e; }
        .error {
            background: #f8d7da;
            color: #721c24;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 20px;
        }
        .links {
            margin-top: 20px;
            text-align: center;
        }
        .links a {
            color: #1a1a2e;
            text-decoration: none;
        }
        .demo {
            margin-top: 20px;
            padding: 10px;
            background: #f8f9fa;
            border-radius: 5px;
            font-size: 0.9rem;
        }
    </style>
</head>
<body>
    <div class="login-box">
        <h2>Вход для администратора</h2>
        
        <?php if($error): ?>
            <div class="error"><?php echo $error; ?></div>
        <?php endif; ?>
        
        <form method="POST">
            <div class="form-group">
                <input type="text" name="username" placeholder="Имя пользователя" 
                       value="<?php echo isset($_POST['username']) ? htmlspecialchars($_POST['username']) : ''; ?>" required>
            </div>
            <div class="form-group">
                <input type="password" name="password" placeholder="Пароль" required>
            </div>
            <button type="submit" class="btn">Войти</button>
        </form>
        
        <div class="links">
            <a href="index.php">← На главную</a>
        </div>
        
        <div class="demo">
            <p><strong>Демо-доступ:</strong></p>
            <p>Логин: admin</p>
            <p>Пароль: admin123</p>
        </div>
    </div>
</body>
</html>