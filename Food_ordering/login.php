<?php
  SESSION_START();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="loginstyle.css">
    
    <title>Login Page</title>
    <style>
        .message{
            padding: 20px;
            border-radius: 10px;
            max-width: 400px;
            width: 100%;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); 
    }
        .btn{
            width: 100%;
            padding: 10px;
            margin-top: 20px;
            border: none;
            border-radius: 5px;
            background-color: #007bff; 
            color: white;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
  
    </style>

</head>
<body>
    <?php
    include("config.php");
    if(isset($_POST['logged'])){
        $username = mysqli_real_escape_string($con,$_POST['username']);
        $password = mysqli_real_escape_string($con,$_POST['password']);

        $result = mysqli_query($con,"SELECT * FROM users WHERE username='$username' AND password='$password' ") or die("Error!");
        $row = mysqli_fetch_assoc($result);

        if(is_array($row) && !empty($row)){
            $_SESSION['valid'] = $row['email'];
            $_SESSION['username'] = $row['username'];
            $_SESSION['user_id'] = $row['id'];
        }else{
            echo "<div class='message'>
              <p>Wrong Username or Password</p>
               </div> <br>";
           echo "<a href='login.php'><button class='btn'>Go Back</button>";
 
        }
        if(isset($_SESSION['valid'])){
            header("Location: homepage.php");
        }
      }else{
    ?>
    <form action="login.php" method="post">
        <h1>Login</h1>
        <label>Username</label>
        <input type="text" name="username" placeholder="Enter your username"><br>
        <label>Password</label>
        <input type="password" name="password" placeholder="Enter your password"><br>
        <button type="submit" name="logged">Login</button>
        <p>Not a member? <a href="register.php">Signup now</a></p>
    </form>
    <?php } ?>
</body>
