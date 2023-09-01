<?php
if (isset($_POST['username'])) {
    $username = $_POST['username'];
    $conn = mysqli_connect("localhost", "un", "pw", "registration");
    
    // username exists..
    $query = "SELECT * FROM users WHERE username = '$username'";
    $result = mysqli_query($conn, $query);
    
    if (mysqli_num_rows($result) > 0) {
        echo "<span style='color:red'>Username Already Exists.</span>";
    } else {
        echo "<span style='color:green'>Username Available.</span>";
    }
}

if (isset($_POST['email'])) {
    $email = $_POST['email'];
    $conn = mysqli_connect("localhost", "un", "pw", "registration");
    
    // email exists..
    $query = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($conn, $query);
    
    if (mysqli_num_rows($result) > 0) {
        echo "<span style='color:red'>Email Already Exists.</span>";
    } else {
        echo "<span style='color:green'>Email Available.</span>";
    }
}
?>
