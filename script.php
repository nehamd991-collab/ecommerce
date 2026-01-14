<?php
include "connect.php";

if (isset($_POST["submit"])) {
    $username = trim($_POST["username"]);
    $password = trim($_POST["password"]);

    // Check if username exists
    $sql = "SELECT * FROM user WHERE username='$username'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        // User exists, check password
        $row = mysqli_fetch_assoc($result);
        if ($row['password'] === $password) {
            header("Location: homepage.php");
            exit();
        } else {
            echo "<script>alert('Incorrect password')</script>";
        }
    } else {
        echo "<script>alert('User does not exist')</script>";
    }
}
?>
