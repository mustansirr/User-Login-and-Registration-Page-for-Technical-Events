<?php include 'register.html' ?>
<?php include 'connect.php'; ?>

<?php
$fnameErr = $lnameErr = $emailErr = $contactErr = $zipErr = "";

if (isset($_POST['submit'])) {
    $firstname = test_input($_POST["fname"]);
    if (!preg_match("/^([a-zA-Z' ]+)$/", $firstname)) {
        echo "<script>alert('Only letters allowed.')</script>";
        return;
    }
    $lastname = test_input($_POST["lname"]);
    if (!preg_match("/^([a-zA-Z' ]+)$/", $lastname)) {
        echo "<script>alert('Only letters allowed.')</script>";
        return;
    }
    $contact = test_input($_POST["phone"]);
    if (!preg_match("/^[6-9][0-9]{9}$/", $contact)) {
        $contactErr = "<script>alert('The Contact Number is invalid.')</script>";
    }
    $email = test_input($_POST["email"]);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailErr = "<script>alert('Invalid email address.')</script>";
    }
    $collegeName = test_input($_POST["collegeName"]);
    $collegeID = test_input($_POST["collegeId"]);
    $password = test_input($_POST["pass"]);
    if (empty($_POST["gender"])) {
        $genderErr = "<script>alert('Gender is required.')</script>";
    } else {
        $gender = test_input($_POST["gender"]);
    }
    $signup = test_input($_POST["news"]);
}

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if (isset($_POST["submit"])) {
    $sql = "INSERT INTO `users`(`First Name`, `Last Name`, `Contact Number`, `Email ID`, `College Name`, `College ID`, `Password`, 
    `Gender`, `Signed up for News`) VALUES ('$firstname','$lastname','$contact','$email','$collegeName','$collegeID','$password',
    '$gender','$signup')";
    $save = mysqli_query($conn, $sql);
    echo "<script>alert('Successfully registered!')</script>";
    echo "<script>window.location.replace('login.php')</script>";
}
mysqli_close($conn);
?>