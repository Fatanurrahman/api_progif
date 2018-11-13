<?php
    session_start();
    
    $error='';
    if (isset($_POST['submit'])) {
        if ((empty($_POST['username'])) || (empty($_POST['password']))) {
            $error="Username or Password is invalid";
            header("location: index.php");
        } else {
            $username=$_POST['username'];
            $password=$_POST['password'];
            $connection = mysqli_connect("localhost", "root", "")
                    or die;
            
            $username = stripslashes($username);
            $password = stripslashes($password);
            $username = mysqli_real_escape_string($connection, $username);
            $password = mysqli_real_escape_string($connection, $password);
            $db = mysqli_select_db($connection, 'api');
            $query = mysqli_query($connection, "SELECT id FROM user WHERE username='$username' AND passcode='$password'");
            $rows = mysqli_num_rows($query);
            if ($rows == 1) {
                $_SESSION['login_user']=$username; // Initializing Session
                header("location: profil.php"); // Redirecting To Other Page
            } else {
                $error = "Username or Password is invalid";
                header("location: index.php");
            }
            mysqli_close($connection); // Closing Connection
        }
    }
?>
