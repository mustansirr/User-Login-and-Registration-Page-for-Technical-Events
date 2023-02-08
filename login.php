<?php include 'login.html' ?>
<?php include 'connect.php'; ?>
<?php
if (isset($_POST['submit'])) {
    $username = $_POST['email'];
    $password = $_POST['pass'];

    $db_username = mysqli_query($conn, "SELECT `Email ID` FROM `users` WHERE `Email ID` = '$username'");
    $db_password = mysqli_query($conn, "SELECT `Password` FROM `users` WHERE `Password` = '$password'");
    $db_fname = mysqli_query($conn, "SELECT `First Name` FROM `users` WHERE `Password` = '$password'");
    $sql = "SELECT * FROM `users` WHERE `Email ID` = '$username' AND `Password` = '$password'";
    $result = mysqli_query($conn, $sql);
    // $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $count = mysqli_num_rows($result);
    if ($count == 1) {
        echo "<script>alert('Logged In!')</script>";
        echo "<script>window.location.replace('index.php')</script>";
    } else {
        if (empty($username) || empty($password)) {
            echo "<script>alert('Username or Password is missing.')</>";
        } else if ($username != $db_username || $password != $db_password) {
            echo "<script>alert('Incorrect Username or Password.')</script>";
        }
    }
}
?>