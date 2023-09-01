<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Registration Form</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        /* Styling for the entire page */
        body {
            font-family: Arial, sans-serif;
            background-color: #f7f7f7;
            margin: 0;
            padding: 0;
        }

        /* Styling for the registration container */
        .container {
            max-width: 400px;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        }

        /* Styling for the form header */
        h2 {
            text-align: center;
            color: #007BFF;
        }

        /* Styling for form elements */
        form {
            display: flex;
            flex-direction: column;
        }

        /* Styling for labels */
        label {
            font-weight: bold;
            margin-bottom: 5px;
            color: #333;
        }

        /* Styling for input fields */
        input[type="text"],
        input[type="password"],
        input[type="email"],
        input[type="date"] {
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
            padding-left: 15px;
        }

        /* Styling for the submit and reset buttons */
        input[type="submit"],
        input[type="reset"] {
            background-color: #007BFF;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
            font-size: 18px;
            margin-top: 10px;
        }

        /* Styling for error messages */
        span.error {
            color: red;
        }

        /* Styling for success messages */
        span.success {
            color: green;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Registration Form</h2>
        <form id="registrationForm" method="post" action="registration.php">
            <!-- Username -->
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required placeholder="Enter your username" />
            <span id="usernameStatus" class="error"></span><br /><br />

            <!-- First Name -->
            <label for="firstname">First Name:</label>
            <input type="text" id="firstname" name="firstname" required placeholder="Enter your first name" /><br /><br />

            <!-- Last Name -->
            <label for="lastname">Last Name:</label>
            <input type="text" id="lastname" name="lastname" required placeholder="Enter your last name" /><br /><br />

            <!-- Email -->
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required placeholder="Enter your email" />
            <span id="emailStatus" class="error"></span><br /><br />

            <!-- Password -->
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required placeholder="Enter your password" /><br /><br />

            <!-- Re-enter Password -->
            <label for="repassword">Re-enter Password:</label>
            <input type="password" id="repassword" name="repassword" required placeholder="Re-enter your password" />
            <span id="passwordMatchError" class="error"></span><br /><br />

            <!-- Phone -->
            <label for="phone">Phone:</label>
            <input type="text" id="phone" name="phone" required placeholder="Enter your phone number" /><br /><br />

            <!-- Date of Birth -->
            <label for="dob">Date of Birth:</label>
            <input type="date" id="dob" name="dob" required placeholder="Select your date of birth" /><br /><br />

            <!-- City -->
            <label for="city">City:</label>
            <input type="text" id="city" name="city" required placeholder="Enter your city" /><br /><br />

            <!-- Address 1 -->
            <label for="address1">Address 1:</label>
            <input type="text" id="address1" name="address1" required placeholder="Enter your address" /><br /><br />

            <!-- Address 2 -->
            <label for="address2">Address 2:</label>
            <input type="text" id="address2" name="address2" required placeholder="Enter additional address (if any)" /><br /><br />

            <!-- Pincode -->
            <label for="pincode">Pincode:</label>
            <input type="text" id="pincode" name="pincode" required placeholder="Enter your pincode" /><br /><br />

            <!-- Country -->
            <label for="country">Country:</label>
            <input type="text" id="country" name="country" required placeholder="Enter your country" /><br /><br />

            <!-- Submit Button -->
            <input type="submit" name="submit" value="Register" />
            <!-- Reset Button -->
            <input type="reset" value="Reset" />
            <span id="registrationMessage" class="success"></span>
        </form>
    </div>

    <script>
        $(document).ready(function () {
            // Function to check username availability
            function checkUsernameAvailability() {
                var username = $("#username").val();
                $.post(
                    "check_availability.php",
                    {
                        username: username,
                    },
                    function (data) {
                        $("#usernameStatus").html(data);
                    }
                );
            }

            // Function to check email availability
            function checkEmailAvailability() {
                var email = $("#email").val();
                $.post(
                    "check_availability.php",
                    {
                        email: email,
                    },
                    function (data) {
                        $("#emailStatus").html(data);
                    }
                );
            }

            // Function to check password match
            function checkPasswordMatch() {
                var password = $("#password").val();
                var repassword = $("#repassword").val();
                if (password !== repassword) {
                    $("#passwordMatchError").text("Passwords do not match");
                } else {
                    $("#passwordMatchError").text("");
                }
            }

            // Event handlers for real-time validation
            $("#username").keyup(checkUsernameAvailability);
            $("#email").keyup(checkEmailAvailability);
            $("#repassword").keyup(checkPasswordMatch);

            // Form submission handler
            $("#registrationForm").submit(function (event) {
                // Prevent the default form submission
                event.preventDefault();

                // Submit the form
                $.ajax({
                    type: "POST",
                    url: "registration.php",
                    data: $(this).serialize(),
                    success: function (response) {
                        $("#registrationMessage").html(response);
                    },
                });
            });
        });
    </script>
</body>
</html>
