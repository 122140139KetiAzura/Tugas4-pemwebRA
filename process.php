<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $errors = [];
    $name = trim($_POST["name"]);
    $email = trim($_POST["email"]);
    $phone = trim($_POST["phone"]);
    $password = trim($_POST["password"]);
    $file = $_FILES["file"];

    // Validasi server-side
    if (empty($name) || strlen($name) < 3) {
        $errors[] = "Nama minimal 3 karakter.";
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Email tidak valid.";
    }
    if (empty($phone) || !is_numeric($phone) || strlen($phone) < 10) {
        $errors[] = "Nomor telepon tidak valid.";
    }
    if (empty($password) || strlen($password) < 6) {
        $errors[] = "Password minimal 6 karakter.";
    }
    if ($file["error"] !== UPLOAD_ERR_OK || $file["type"] !== "text/plain" || $file["size"] > 1024 * 1024) {
        $errors[] = "File harus berupa teks dan maksimal 1MB.";
    }

    // Jika ada error, kembalikan ke form
    if (!empty($errors)) {
        echo "<ul>";
        foreach ($errors as $error) {
            echo "<li>$error</li>";
        }
        echo "</ul>";
        echo '<a href="form.php">Kembali ke Form</a>';
        exit;
    }

    // Baca isi file
    $fileContent = file_get_contents($file["tmp_name"]);
    $fileLines = explode(PHP_EOL, $fileContent);

    // Simpan data ke sesi
    session_start();
    $_SESSION["data"] = [
        "name" => $name,
        "email" => $email,
        "phone" => $phone,
        "password" => $password,
        "fileContent" => $fileLines,
        "userAgent" => $_SERVER["HTTP_USER_AGENT"]
    ];

    // Redirect ke result.php
    header("Location: result.php");
    exit;
}
?>
