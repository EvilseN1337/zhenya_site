
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Контакты</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .contacts-container {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 30px;
            margin-top: 30px;
        }
        .contact-info {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .contact-item {
            margin-bottom: 25px;
        }
        .contact-item i {
            font-size: 1.5rem;
            color: #667eea;
            margin-right: 10px;
        }
        .contact-item h3 {
            margin-bottom: 5px;
            color: #333;
        }
        .contact-item p {
            color: #666;
            line-height: 1.6;
        }
        .work-time {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 5px;
            margin-top: 20px;
        }
        .work-time h4 {
            margin-bottom: 10px;
            color: #333;
        }
        .work-time p {
            color: #666;
            margin: 5px 0;
        }
        .map {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .map iframe {
            width: 100%;
            height: 400px;
            border: none;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="nav">
            <div class="logo">ExtraService</div>
            <div class="nav-links">
                <a href="index.html">Главная</a>
                

    <div class="container">
        <h1>Контакты</h1>
        
        <div class="contacts-container">
            <div class="contact-info">
                <h2>Наши контакты</h2>
                
                <div class="contact-item">
                    <h3><i class="fas fa-phone"></i> Телефон</h3>
                    <p>8-800-123-45-67 (бесплатно по России)</p>
                    <p>+7 (495) 123-45-67 (Москва)</p>
                </div>
                
                <div class="contact-item">
                    <h3><i class="fas fa-envelope"></i> Email</h3>
                    <p>support@company.ru</p>
                    <p>info@company.ru</p>
                </div>
                
                <div class="contact-item">
                    <h3><i class="fas fa-map-marker-alt"></i> Адрес</h3>
                    <p>г. Москва, ул. Примерная, д. 123</p>
                </div>
                
                <div class="work-time">
                    <h4>Режим работы</h4>
                    <p>Пн-Пт: 9:00 - 20:00</p>
                    <p>Сб: 10:00 - 18:00</p>
                    <p>Вс: выходной</p>
                    <p><strong>Онлайн-поддержка:</strong> круглосуточно</p>
                </div>
            </div>
            
            <div class="map">
                <h2>Мы на карте</h2>
                <iframe 
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2245.3731411754097!2d37.6176!3d55.7558!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x46b54a5a738fa419%3A0x7c347d50b6d8b8c4!2z0JzQvtGB0LrQstCw!5e0!3m2!1sru!2sru!4v1234567890!5m2!1sru!2sru" 
                    allowfullscreen="" 
                    loading="lazy">
                </iframe>
            </div>
        </div>
    </div>

    <div class="footer">
        <p>© 2025 Служба поддержки. Все права защищены.</p>
    </div>

    <!-- Font Awesome для иконок -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</body>
</html>