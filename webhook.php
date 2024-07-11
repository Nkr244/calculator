<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

// Обработка preflight-запроса
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    exit(0);
}

// Получаем данные из запроса
$data = json_decode(file_get_contents('php://input'), true);

if ($data) {
    $view = $data['view'];
    $guests = $data['guests'];
    $drinks = $data['drinks'];
    $count = $data['count'];
    $name = $data['name'];
    $phone = $data['phone'];
    $email = $data['email'];

    // Логика обработки данных (например, сохранение в базу данных или отправка на email)

    // Пример: отправка email
    $to = 'nikita.rusakov.z@gmail.com';
    $subject = 'Новая заявка с калькулятора';
    $message = "Вид бара/услуги: $view\nКоличество гостей: $guests\nКоличество напитков: $drinks\nСтоимость: $count\nИмя: $name\nТелефон: $phone\nEmail: $email";
    $headers = 'From: no-reply@example.com' . "\r\n" .
        'Reply-To: no-reply@example.com' . "\r\n" .
        'X-Mailer: PHP/' . phpversion();

    mail($to, $subject, $message, $headers);

    // Возвращаем ответ клиенту
    echo json_encode(['status' => 'success', 'message' => 'Данные успешно отправлены']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Не удалось получить данные']);
}
?>
