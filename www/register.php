<?php
// Include database configuration
require 'database.php';
// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve user input
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Validate input
    if (empty($first_name) || empty($last_name) || empty($email) || empty($password)) {
        $error = "Please fill in all the fields.";
    } else {
        // Sanitize and validate email
        $email = filter_var($email, FILTER_SANITIZE_EMAIL);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error = "Invalid email address.";
        } else {
            // Check if the email is already registered
            $check_email_query = "SELECT * FROM users WHERE email = '$email'";
            $check_email_result = mysqli_query($conn, $check_email_query);

            if ($check_email_result && mysqli_num_rows($check_email_result) > 0) {
                $error = "Email address already registered.";
            } else {
                // Hash the password
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);

                // Insert new user into the database
                $insert_query = "INSERT INTO users (first_name, last_name, email, password_hash, is_employee)
                                 VALUES ('$first_name', '$last_name', '$email', '$hashed_password', 0)";

                $insert_result = mysqli_query($conn, $insert_query);

                if ($insert_result) {
                    $success_message = "Registration successful. You can now <a href='loginpage.php'>login</a>.";
                } else {
                    $error = "Error executing the query.";
                }
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Page</title>
</head>

<body>

    <h2>Register</h2>

    <?php
    // Display success or error message if any
    if (isset($success_message)) {
        echo "<p style='color: green;'>$success_message</p>";
    } elseif (isset($error)) {
        echo "<p style='color: red;'>$error</p>";
    }
    ?>

    <form method="post" action="">
        <label>First Name:</label>
        <input type="text" name="first_name" required><br>

        <label>Last Name:</label>
        <input type="text" name="last_name" required><br>

        <label>Email:</label>
        <input type="email" name="email" required><br>

        <label>Password:</label>
        <input type="password" name="password" required><br>

        <input type="submit" value="Register">
    </form>

</body>

</html>