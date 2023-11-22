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
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Insert data into the database
    $sql = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$password')";

    if ($conn->query($sql) === TRUE) {
        $message = "Signup successful!";
    } else {
        $message = "Error: " . $sql . "<br>" . $conn->error;
    }
    if (isset($message)) {
        header("Location: login.php");
        exit();
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup Page</title>
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
    <h2>Signup</h2>
    
    <?php
    if (isset($message)) {
        echo "<p>{$message}</p>";
    }
    ?>
    <div class="container">

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <label for="username">Username:</label>
        <input type="text" name="username" required><br>

        <label for="email">Email:</label>
        <input type="email" name="email" required><br>

        <label for="password">Password:</label>
        <input type="password" name="password" required><br>

        <input type="submit" value="Signup">
    </form>
    </div>
</body>
</html>
