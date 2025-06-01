<?php
session_start();
include('koneksi.php');

$error = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = mysqli_real_escape_string($mysqli, $_POST['username']);
    $password = mysqli_real_escape_string($mysqli, $_POST['password']);
    $password_md5 = md5($password);

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
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Login - GDM Market</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
  <style>
    body {
      margin: 0;
      padding: 0;
      font-family: 'Poppins', sans-serif;
      background: linear-gradient(135deg, #A66DD4, #C38CFF);
      height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .login-container {
      background-color: #fff;
      padding: 40px 30px;
      border-radius: 12px;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
      width: 100%;
      max-width: 400px;
      text-align: center;
    }

    .login-container h2 {
      margin-bottom: 25px;
      font-size: 24px;
      color: #333;
    }

    .login-container input {
      width: 100%;
      padding: 12px;
      margin-bottom: 20px;
      border: 1px solid #ddd;
      border-radius: 8px;
      font-size: 14px;
    }

    .login-container button {
      width: 100%;
      padding: 12px;
      background-color: #A66DD4;
      border: none;
      color: #fff;
      border-radius: 50px;
      font-weight: bold;
      font-size: 14px;
      cursor: pointer;
      transition: background 0.3s ease;
    }

    .login-container button:hover {
      background-color: #934FCB;
    }

    .error-message {
      color: red;
      margin-top: 15px;
      font-size: 14px;
    }

    .login-container p {
      font-size: 14px;
      margin-top: 20px;
    }

    .login-container a {
      color: #A66DD4;
      text-decoration: none;
    }

    .login-container a:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>
  <div class="login-container">
    <h2>Login GDM Market</h2>
    <form method="post" action="">
      <input type="text" name="username" placeholder="Username" required>
      <input type="password" name="password" placeholder="Password" required>
      <button type="submit">Login</button>
    </form>
    <?php if ($error): ?>
      <p class="error-message"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>
    <p>Do not have an account? <a href="register.php">Register</a></p>
  </div>
</body>
</html>
