<?php
session_start();
include('koneksi.php'); // koneksi ke DB

$error = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = mysqli_real_escape_string($mysqli, $_POST['username']);
    $password = mysqli_real_escape_string($mysqli, $_POST['password']);
    $password_md5 = md5($password); // Ubah ke md5

    // Cek user
    $query = mysqli_query($mysqli, "SELECT * FROM user WHERE username = '$username' AND password = '$password_md5'");
    $user = mysqli_fetch_assoc($query);

    if ($user) {
        $_SESSION['ID_Karyawan'] = $user['ID_Karyawan'];
        $_SESSION['username'] = $user['username'];
        header("Location: index.php");
        exit;
    } else {
        $error = "Username atau password salah";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Login - GDM Market</title>
  <link rel="stylesheet" href="assets/css/style.css">
  <style>
    .login-container {
      max-width: 400px;
      margin: 100px auto;
      padding: 30px;
      background-color: #f7f7f7;
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
      text-align: center;
    }
    .login-container input {
      width: 80%;
      padding: 10px;
      margin-bottom: 15px;
    }
    .login-container button {
      padding: 10px 30px;
      background-color: #007bff;
      color: #fff;
      border: none;
      border-radius: 5px;
    }
    .login-container button:hover {
      background-color: #0056b3;
    }
    .error-message {
      color: red;
      margin-top: 10px;
    }
  </style>
</head>
<body>
  <div class="login-container">
    <h2>Login GDM Market</h2>
    <form method="post" action="">
      <input type="text" name="username" placeholder="Username" required><br>
      <input type="password" name="password" placeholder="Password" required><br>
      <button type="submit">Login</button>
    </form>
    <?php if ($error): ?>
      <p class="error-message"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>
  </div>
</body>
</html>
