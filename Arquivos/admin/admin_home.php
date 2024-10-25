<?php
    session_start();

    include '../connection.php';

    if (!isset($_SESSION['username']) || $_SESSION['role'] != 'admin') {
        header("Location: ../login.php");
        exit();
    }

    $username = $_SESSION['username'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<h2>Welcome, <?php echo $username; ?>!</h2>
<p><a href="../logout.php">Logout</a></p>

</body>
</html>
