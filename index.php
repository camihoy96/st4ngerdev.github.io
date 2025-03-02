<?php
session_start(); // Start the session
require('dbconn.php'); // Ensure database connection
?>

<!DOCTYPE html>
<html>
<head>
    <title>Library Management</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="keywords" content="Library Member Login Form, Responsive Web Template, Login System">
    <link rel="stylesheet" href="css/style.css?v=1.0">
    <link href="//fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900" rel="stylesheet">
</head>
<body>

<header>
    <section class="logo-container">
        <div class="left-logo">
            <img src="images/mdc.logo.png" alt="MDC Logo">
        </div>
    </section>
</header>

<h1>WELCOME TO MDC LIBRARY</h1>

<div class="container">
    <div class="login">
        <h2>Sign In</h2>
        <form action="" method="post"> <!-- Keep action empty to post to the same page -->
            <input type="text" name="RollNo" placeholder="ID number" required>
            <input type="password" name="Password" placeholder="Password" required>
            <div class="send-button">
                <input type="submit" name="signin" value="Sign In">
            </div>
        </form>
    </div>
</div>

<?php
if (isset($_POST['signin'])) {
    $u = trim($_POST['RollNo']);
    $p = trim($_POST['Password']);

    if (!empty($u) && !empty($p)) {
        $sql = "SELECT * FROM LMSC.user WHERE RollNo = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $u);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $hashedPassword = $row['Password']; // Get hashed password
            $user_type = $row['Type'];

            if (password_verify($p, $hashedPassword)) { // Check password
                $_SESSION['RollNo'] = $u;

                if ($user_type == 'Admin' || $user_type == 'Librarian') {
                    echo "<script>alert('Welcome, " . htmlspecialchars($u) . "!'); window.location.href='Admin2/home.php';</script>";
                } else {
                    echo "<script>alert('Access Denied');</script>";
                }
                exit;
            } else {
                echo "<script>alert('Incorrect RollNo or Password');</script>";
            }
        } else {
            echo "<script>alert('User not found');</script>";
        }
    } else {
        echo "<script>alert('Please fill in all fields');</script>";
    }
}
?>

<div class="footer">
    <p>&copy; St4nger's Group 2024-2025</p>
</div>

</body>
</html>
