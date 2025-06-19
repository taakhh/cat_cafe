<?php
// Убедитесь, что это не спам-бот (проверяем скрытое поле)
if (!empty($_POST['_gotcha'])) {
    // Это вероятно спам-бот, игнорируем
    header('Location: help.html');
    exit;
}

// Получаем данные из формы
$name = htmlspecialchars($_POST['name']);
$email = htmlspecialchars($_POST['email']);
$phone = htmlspecialchars($_POST['phone'] ?? 'Не указан');
$subject = htmlspecialchars($_POST['subject']);
$message = htmlspecialchars($_POST['message']);

// Ваш email, куда будут приходить сообщения
$to = 'tania070607kat@gmail.com'; // ЗАМЕНИТЕ НА СВОЙ EMAIL

// Тема письма
$email_subject = "Новое сообщение с сайта Котокафе: $subject";

// Тело письма
$email_body = "
<h2>Новое сообщение с сайта Котокафе</h2>
<p><strong>Имя:</strong> $name</p>
<p><strong>Email:</strong> $email</p>
<p><strong>Телефон:</strong> $phone</p>
<p><strong>Тема:</strong> $subject</p>
<p><strong>Сообщение:</strong></p>
<p>$message</p>
";

// Заголовки
$headers = "MIME-Version: 1.0\r\n";
$headers .= "Content-type: text/html; charset=utf-8\r\n";
$headers .= "From: $name <$email>\r\n";
$headers .= "Reply-To: $email\r\n";

// Отправка письма
$success = mail($to, $email_subject, $email_body, $headers);

// Ответ для AJAX-запроса
if ($success) {
    echo 'Сообщение успешно отправлено!';
} else {
    echo 'Ошибка при отправке сообщения.';
}
?>