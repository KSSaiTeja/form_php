<?php
// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Database connection (replace with your own credentials)
    $conn = mysqli_connect("localhost", "your_username", "your_password", "your_database");

    // Check if the connection was successful
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Check username availability
    if (isset($_POST['username'])) {
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        
        $query = "SELECT * FROM users WHERE username = '$username'";
        $result = mysqli_query($conn, $query);
        
        if (mysqli_num_rows($result) > 0) {
            echo "<span style='color:red'>Username Already Exists.</span>";
        } else {
            echo "<span style='color:green'>Username Available.</span>";
        }
    }

    // Check email availability
    if (isset($_POST['email'])) {
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        
        $query = "SELECT * FROM users WHERE email = '$email'";
        $result = mysqli_query($conn, $query);
        
        if (mysqli_num_rows($result) > 0) {
            echo "<span style='color:red'>Email Already Exists.</span>";
        } else {
            echo "<span style='color:green'>Email Available.</span>";
        }
    }

    // Insert data into the database (replace 'registration' with your table name)
    if (isset($_POST['submit'])) {
        $name = mysqli_real_escape_string($conn, $_POST['username']);
        $firstname = mysqli_real_escape_string($conn, $_POST['firstname']);
        $lastname = mysqli_real_escape_string($conn, $_POST['lastname']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);
        $repassword = mysqli_real_escape_string($conn, $_POST['repassword']);
        $phone = mysqli_real_escape_string($conn, $_POST['phone']);
        $address1 = mysqli_real_escape_string($conn, $_POST['address1']);
        $address2 = mysqli_real_escape_string($conn, $_POST['address2']);
        $city = mysqli_real_escape_string($conn, $_POST['city']);
        $pincode = mysqli_real_escape_string($conn, $_POST['pincode']);
        $country = mysqli_real_escape_string($conn, $_POST['country']);

        // Check if username and email are available before inserting
        $check_username_query = "SELECT * FROM users WHERE username = '$name'";
        $check_email_query = "SELECT * FROM users WHERE email = '$email'";

        $username_result = mysqli_query($conn, $check_username_query);
        $email_result = mysqli_query($conn, $check_email_query);

        if (mysqli_num_rows($username_result) > 0) {
            echo "<span style='color:red'>Username Already Exists.</span>";
        } elseif (mysqli_num_rows($email_result) > 0) {
            echo "<span style='color:red'>Email Already Exists.</span>";
        } else {
            // Insert data into the registration table
            $sql = "INSERT INTO registration (Name, Firstname, Lastname, Email, Password, Repassword, Phone, Address1, Address2, City, Pincode, Country) 
                    VALUES ('$name', '$firstname', '$lastname', '$email', '$password', '$repassword', '$phone', '$address1', '$address2', '$city', '$pincode', '$country')";

            if (mysqli_query($conn, $sql)) {
                echo "<span style='color:green'>Registration Successful.</span>";
            } else {
                echo "Error: " . mysqli_error($conn);
            }
        }
    }

    // Close the database connection
    mysqli_close($conn);
}
?>
