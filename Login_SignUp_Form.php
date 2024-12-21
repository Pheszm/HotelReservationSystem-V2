<?php
include 'db.php'; // Include your database configuration file
session_start();
// Signup handling
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['signup'])) {
    $name = $_POST['txt'];
    $email = $_POST['email'];
    $phone = $_POST['broj'];
    $passwordHash = password_hash($_POST['pswd'], PASSWORD_DEFAULT); // Hash the password

    try {
        $sql = "INSERT INTO Users (Username, Email, PasswordHash, Role, Phone) VALUES (:username, :email, :passwordHash, 'User', :phone)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            'username' => $name,
            'email' => $email,
            'passwordHash' => $passwordHash,
            'phone' => $phone
        ]);
        echo "Signup successful!";
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

// Login handling
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['pswd'];

    try {
        $sql = "SELECT * FROM Users WHERE Email = :email";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['email' => $email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['PasswordHash'])) {
            // Start session and store user information
            session_start();
            $_SESSION['user_id'] = $user['UserID'];
            $_SESSION['username'] = $user['Username']; // Store username in session
            header("Location:Dashboard.php");
            exit;
        } else {
            echo "Invalid login credentials!";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="CSS/Login_SignUp_Form.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HMS | Login or Signup</title>
    <link rel="icon" type="image/x-icon" href="assets/img/logos/HMS_LOGO.png" />
</head>
<body>
    <div id="BodyAreaaa">
        <div class="main">   
            <input type="checkbox" id="chk" aria-hidden="true">
    
            <div class="signup">
                <a id="returnbtn">Return</a>
                <form method="POST">
                    <label for="chk" aria-hidden="true">Sign up</label>
                    <input type="text" name="txt" placeholder="Username.." required="">
                    <input type="email" name="email" placeholder="Email.." required="">
                    <input type="number" name="broj" placeholder="Telephone No.." required="" maxlength="12">
                    <input type="password" name="pswd" placeholder="Password.." required="">
                    <button type="submit" name="signup">Sign up</button>
                </form>
            </div>
    
            <div class="login">
                <form method="POST">
                    <label for="chk" aria-hidden="true">Login</label>
                    <input type="email" name="email" placeholder="Email.." required="">
                    <input type="password" name="pswd" placeholder="Password.." required="">
                    <button type="submit" name="login"><a id="LoginBtn">Login</a></button>
                </form>
            </div>
        </div>
    </div>
    <script src="JS/Login_SignUp_Form.js"></script>
</body>
</html>
