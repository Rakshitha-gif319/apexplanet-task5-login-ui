<?php
session_start();
include 'db.php';
$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['user'] = $user['username'];
            header("Location: dashboard.php");
            exit();
        } else {
            $message = "Invalid password!";
        }
    } else {
        $message = "User not found!";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: url('https://images.unsplash.com/photo-1446776811953-b23d57bd21aa') no-repeat center center/cover;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
            color: white;
        }
        body::before {
            content: "";
            position: absolute;
            top: 0; left: 0;
            width: 100%; height: 100%;
            background: rgba(0, 0, 0, 0.5);
        }
        .container {
            position: relative;
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(15px);
            padding: 40px;
            border-radius: 20px;
            width: 350px;
            text-align: center;
            box-shadow: 0 8px 32px rgba(0,0,0,0.3);
        }
        h2 {
            font-size: 28px;
            margin-bottom: 20px;
        }
        input {
            width: 90%;
            padding: 12px;
            margin: 8px 0;
            border: none;
            border-radius: 25px;
            outline: none;
            font-size: 16px;
        }
        input[type="submit"] {
            background: linear-gradient(45deg, #ff4b2b, #ff416c);
            color: white;
            cursor: pointer;
            transition: 0.3s;
        }
        input[type="submit"]:hover {
            transform: scale(1.05);
        }
        p {
            color: yellow;
            font-size: 14px;
        }
        a {
            color: #fff;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Login</h2>
        <p><?php echo $message; ?></p>
        <form method="POST">
            <input type="email" name="email" placeholder="Email">
            <input type="password" name="password" placeholder="Password">
            <input type="submit" value="Login">
        </form>
        <p>Don't have an account? <a href="register.php">Register</a></p>
    </div>
</body>
</html>
