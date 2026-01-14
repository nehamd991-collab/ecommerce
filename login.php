<?php
include 'connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $confirm = $_POST['confirm'];

    if ($password !== $confirm) {
        $error = "Passwords do not match";
    } else {
        $hashedpassword = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $conn->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $name, $email, $hashedpassword);

        if ($stmt->execute()) {
            header("Location: login.php");
            exit;
        } else {
            $error = "Error: " . $stmt->error;
        }
        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign Up</title>
</head>
<body>
    <h1>Sign Up</h1>
    <?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
    <form action="" method="POST">
        <label>Name</label>
        <input type="text" name="name" required><br><br>
        <label>Email</label>
        <input type="email" name="email" required><br><br>
        <label>Password</label>
        <input type="password" name="password" required><br><br>
        <label>Confirm Password</label>
        <input type="password" name="confirm" required><br><br>
        <button type="submit">Sign Up</button>
    </form>
    <p>Already have an account? <a href="login.php">Login here</a></p>
</body>
</html>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="login.css">
</head>
<body>
   
   <form class="header" method="POST" action="">
    <h2>LOGIN</h2>
    
    <?php if (!empty($error_message)): ?>
      <div id="error-message" style="color: red; font-weight: bold; margin-bottom: 10px; padding: 10px; background-color: #ffe6e6; border-radius: 4px;">
        <?php echo $error_message; ?>
      </div>
    <?php endif; ?>
    
    <?php if (!empty($success_message)): ?>
      <div id="success-message" style="color: green; font-weight: bold; margin-bottom: 10px; padding: 10px; background-color: #e6ffe6; border-radius: 4px;">
        <?php echo $success_message; ?>
      </div>
    <?php endif; ?>
    
    <label for="userName">User Name</label>
    <input type="text" name="username" value="<?php echo isset($_POST['username']) ? htmlspecialchars($_POST['username']) : ''; ?>" required><br><br>
    <label for="Password">Password</label>
    <input type="password" name="password" required><br><br>
    <button type="submit" value="submit" name="submit" id="loginBtn">Sign In</button><br><br>

     <a href="register.php" id="register">Register here</a>

   </form>

</body>
</html>