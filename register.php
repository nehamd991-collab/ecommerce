<?php

include "connect.php";

if (isset($_POST["submit"])){
  $firstName = $_POST["firstName"];
  $lastName = $_POST["lastName"];
  $username = $_POST["username"];
  $password = $_POST["password"];

  $sql ="SELECT * FROM user WHERE username='$username'";
       
  $result = mysqli_query($conn, $sql);
  $num = mysqli_num_rows($result);
  
  if($num> 0 ) {
    echo "<script>alert('user already exist')</script>";
  }else{
    $insert ="INSERT INTO user (firstName,lastName,username,password) VALUES('$firstName','$lastName','$username','$password')";
    mysqli_query($conn,$insert);
    header("location:login.php");
    exit();
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>REGISTRATION</title>
</head>
<body>
    <link rel="stylesheet" href="register.css">

    <form class="header" method="post" action="">
      

       <h2>REGISTER</h2> 

    <label for="firstName">First Name</label> 
    <input type="text" name="firstName" ></input><br><br>
    <label for="lastName">Last Name</label> 
    <input type="text" name="lastName" ></input><br><br>
    <label for="userName">User Name</label> 
    <input type="text" name="username" ></input><br><br>
    <label for="firstName">Password</label> 
    <input type="text" name="password" ></input><br><br>
    <label for="firstName">Confirm Password</label> 
    <input type="text" name="confirm" ></input><br><br>
    
    <button type="submit" value="submit" name="submit">Sign Up</button><br><br>
    
      <a href="login.php" id="login">Login here</a>
    

    </form>

<script src="script.php"></script> 

    
</body>
</html>