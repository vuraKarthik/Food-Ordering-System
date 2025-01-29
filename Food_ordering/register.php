<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="loginstyle.css">
    <title>Registration Page</title>
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

if(isset($_POST["registered"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $email = $_POST["email"];
    
    $verify_query = mysqli_query($con, "SELECT email FROM users WHERE email='$email'");
    $verify_username = mysqli_query($con, "SELECT username FROM users WHERE username='$username'");
    if(mysqli_num_rows($verify_query) != 0) {
        echo "<div class='message'><h2>This Email is already registered!</h2></div>"."<br>";
        echo "<a href='javascript:self.history.back()'><button class='btn'>Go Back</button>";
    }
    elseif(mysqli_num_rows($verify_username)!=0){
        echo "<div class='message'><h2>Username not available</h2></div>"."<br>";
        echo "<a href='javascript:self.history.back()'><button class='btn'>Go Back</button>";
    }
    else {
        $insert_query = mysqli_query($con, "INSERT INTO users(username,password,email) VALUES('$username','$password','$email')");
        
        if($insert_query) {
            echo "<div class='message'><h2>Registration Successful</h2></div>"."<br>";
            echo "<a href='login.php'><button class='btn'>Login Now</button>";
        } else {
            echo "Error: " . mysqli_error($con);
        }
    }
} else {
?>
     <form id="registrationForm" action="" method="post" onsubmit="return validateForm()">
        <h1>Register</h1>
        <label>Username</label>
        <input type="text" id="username" name="username" placeholder="Enter your username" required><br>
        <label>Email</label>
        <input type="email" name="email" id="email" placeholder="Enter your email" required><br>
        <label>Password</label>
        <input type="password" name="password" id="password" placeholder="Enter your password" required><br>
        <label>Confirm Password</label>
        <input type="password" name="confirm_password" id="confirm_password" placeholder="Confirm your password" required><br>
        <button type="submit" name="registered">Register</button>
        <p>Already have an account? <a href="login.php">Login here</a></p>
    </form>
    <?php } ?>
</body>
<script>

        function validateForm() {
            var username = document.getElementById("username").value;
            var email = document.getElementById("email").value;
            var password = document.getElementById("password").value;
            var confirmPassword = document.getElementById("confirm_password").value;
            var emailtype = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (username == "") {
                alert("Username must be filled out!");
                return false;
            }
            if (!email.match(emailtype)) {
                alert("Email must be valid!");
                return false;
            }
            if (password == "") {
                alert("Password must be filled out!");
                return false;
            }
            if (confirmPassword == "") {
                alert("Please confirm your password!");
                return false;
            }
            if (password != confirmPassword) {
                alert("Passwords do not match!");
                return false;
            }

            return true;
        }
    </script>
</html>

