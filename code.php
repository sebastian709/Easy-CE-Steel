<?php
session_start();
require 'db/connection.php';






























# Login
// if (isset($_POST['username']) && isset($_POST['password'])) {
//     $username = $_POST['username'];
//     $password = $_POST['password'];

//     $username = mysqli_real_escape_string($conn, $username);
//     $password = mysqli_real_escape_string($conn, $password);

//     $password = md5($password);

//     $sql = "SELECT * FROM users WHERE username = '" . $username . "' AND password = '" . $password . "'";

//     $result = mysqli_query($conn, $sql)
//         or die(mysqli_error($conn));

//     $num = mysqli_fetch_array($result);

//     if ($num > 0) {
//         $_SESSION['access'] = 'user';
//         $_SESSION['username'] = $num['username'];
//         $_SESSION['id'] = $num['id'];
//         header("Location: access/users-main.php");
//         exit();
//     } else {
//         header("Location: login.php?error=Incorrect username or password. Please try again.");
//         exit();
//     }
// }

# Register
// if (isset($_POST['firstname']) && isset($_POST['lastname']) && isset($_POST['r-username']) && isset($_POST['email']) && isset($_POST['r-password']) && isset($_POST['con-password'])) {

//     if ($_POST['r-password'] == $_POST['con-password']) {
//         $firstname = mysqli_real_escape_string($conn, $_POST["firstname"]);
//         $lastname = mysqli_real_escape_string($conn, $_POST["lastname"]);
//         $username = mysqli_real_escape_string($conn, $_POST["r-username"]);
//         $email = mysqli_real_escape_string($conn, $_POST["email"]);
//         $password = mysqli_real_escape_string($conn, $_POST["r-password"]);

//         $password = md5($password);

//         $checking = "SELECT * FROM users WHERE username = '$username'";

//         $result = mysqli_query($conn, $checking)
//             or die(mysqli_error($conn));

//         $num = mysqli_fetch_array($result);

//         if ($num > 0) {
//             header("Location: register.php?error=Username already exist.");
//             exit();
//         } else {
//             $query = "INSERT INTO users (`firstname`, `lastname`, `username`, `email`, `password`) VALUES('$firstname', '$lastname','$username', '$email', '$password')";
//             if (mysqli_query($conn, $query)) {
//                 echo '<script>alert("Registration Done")</script>';
//             }
//         }
//     }
// }
?>