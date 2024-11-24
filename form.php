<!-- form.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Pendaftaran</title>
    <link rel="stylesheet" href="style.css">
    <script>
        function validateForm() {
            const name = document.forms["registrationForm"]["name"].value.trim();
            const email = document.forms["registrationForm"]["email"].value.trim();
            const phone = document.forms["registrationForm"]["phone"].value.trim();
            const password = document.forms["registrationForm"]["password"].value.trim();
            const file = document.forms["registrationForm"]["file"].files[0];

            if (!name || name.length < 3) {
                alert("Nama harus diisi dan minimal 3 karakter.");
                return false;
            }
            if (!email.includes("@")) {
                alert("Email tidak valid.");
                return false;
            }
            if (!phone || isNaN(phone) || phone.length < 10) {
                alert("Nomor telepon tidak valid.");
                return false;
            }
            if (!password || password.length < 6) {
                alert("Password minimal 6 karakter.");
                return false;
            }
            if (!file || file.type !== "text/plain") {
                alert("File harus berupa teks.");
                return false;
            }
            if (file.size > 1024 * 1024) { // 1MB
                alert("Ukuran file maksimal 1MB.");
                return false;
            }
            return true;
        }
    </script>
</head>
<body>
    <form name="registrationForm" action="process.php" method="POST" enctype="multipart/form-data" onsubmit="return validateForm()">
        <label for="name">Nama:</label>
        <input type="text" id="name" name="name" required><br>
        
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br>
        
        <label for="phone">Nomor Telepon:</label>
        <input type="text" id="phone" name="phone" required><br>
        
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br>
        
        <label for="file">Upload File (teks):</label>
        <input type="file" id="file" name="file" accept=".txt" required><br>
        
        <button type="submit">Daftar</button>
    </form>
</body>
</html>
