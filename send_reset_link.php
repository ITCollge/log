<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];

    // تحقق من البريد الإلكتروني في قاعدة البيانات (هنا، نحن نفترض وجود بريد المسؤول فقط)
    if ($email == 'abdalhamedajaj@gmail.com') {
        $token = bin2hex(random_bytes(50)); // إنشاء رمز مميز عشوائي
        $resetLink = "http://yourdomain.com/reset_password.php?token=" . $token;

        // تخزين الرمز المميز في جلسة التخزين (أو يمكنك تخزينه في قاعدة البيانات)
        session_start();
        $_SESSION['reset_token'] = $token;

        // إرسال البريد الإلكتروني (هنا نستخدم mail() للدليل، يجب استخدام مكتبة إرسال بريد محترفة مثل PHPMailer)
        $subject = "Password Reset Request";
        $message = "Click the following link to reset your password: " . $resetLink;
        $headers = "From: no-reply@yourdomain.com";

        if (mail($email, $subject, $message, $headers)) {
            echo "Reset link sent to your email.";
        } else {
            echo "Failed to send reset link.";
        }
    } else {
        echo "Email not found.";
    }
}
?>
