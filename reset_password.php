<?php
session_start();
$token = $_GET['token'] ?? '';

if ($token !== $_SESSION['reset_token']) {
    die('Invalid token');
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $new_password = password_hash($_POST['new_password'], PASSWORD_DEFAULT);

    // تحديث كلمة المرور في قاعدة البيانات
    // هنا نحن نفترض وجود ملف `db.php` يتضمن الاتصال بقاعدة البيانات

    include 'db.php';
    $stmt = $pdo->prepare("UPDATE users SET password = ? WHERE email = 'admin@example.com'");
    if ($stmt->execute([$new_password])) {
        echo "Password updated successfully.";
    } else {
        echo "Failed to update password.";
    }

    // إزالة الرمز المميز من الجلسة
    unset($_SESSION['reset_token']);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
</head>
<body>
    <h2>Reset Password</h2>
    <form method="post" action="">
        <label for="new_password">Enter new password:</label>
        <input type="password" id="new_password" name="new_password" required>
        <button type="submit">Reset Password</button>
    </form>
</body>
</html>
