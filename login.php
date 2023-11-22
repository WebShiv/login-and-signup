<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Establish database connection
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "pat";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Process form data
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Retrieve hashed password from the database based on the provided username
    $sql = "SELECT * FROM users WHERE username='$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $hashed_password = $row['password'];

        // Verify the provided password against the hashed password
        if (password_verify($password, $hashed_password)) {
            header("Location: welcome.php");
            exit();
        } else {
            $login_message = "Invalid password";
        }
    } else {
        $login_message = "Invalid username";
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
</head>
<style>
    h2{
        width: 50%;
        position: relative;
        left: 45vw;
        top: 150px;
    }
    .container{
        width: 300px;
        height: 300px;
        background-color: #bc9494;
        position: relative;
        border-radius: 5px;
        left: 38vw;
        top: 10vw;
        color: white;
    }
    .container form{
        display: flex;
        align-items: center;
        flex-direction: column;
        position: relative;
        top: 100px;
    }
    a{
        margin-top: 12px;
        color: white;
        text-decoration: none;
    }
</style>
<body>
    <h2>Login</h2>
    
    <?php
    if (isset($login_message)) {
        echo "<p>{$login_message}</p>";
    }
    ?>
   <div class="container">
    
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <label for="username">Username:</label>
        <input type="text" name="username" required><br>

        <label for="password">Password:</label>
        <input type="password" name="password" required><br>

        <input type="submit" value="Login">
        <a href="signup.php">Signup</a>
    </form>
   </div>
</body>
</html>
