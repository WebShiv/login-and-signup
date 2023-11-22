

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome Page</title>
</head>
<body>
    <h2>Welcome</h2>
    
    <?php
    if (isset($welcome_message)) {
        echo "<p>{$welcome_message}</p>";
    }
    ?>

    <p>This is your welcome page. Add more content as needed.</p>

    <a href="login.php">Logout</a>
</body>
</html>
