<?php 

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS.css">
    <title>UPGRADE&SELL</title>
</head>
<body>
<header>
        <h1>UPGRADE&SELL</h1>
        <nav>
            <ul>
                <li><a href="index.php">Home</a>
                <?php if (isset($_SESSION['user_id'])): ?>
                    <a href="profile.php">Profile</a>
                    <a href="logout.php">Logout</a></li>
                <?php else: ?>
                    <a href="login.php">Login</a>
                    <a href="register.php">Register</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </header>   
</body>
</html>