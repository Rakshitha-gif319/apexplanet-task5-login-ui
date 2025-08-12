<?php
include 'db.php';
$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    if (empty($username) || empty($email) || empty($password)) {
        $message = "All fields are required!";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message = "Invalid email format!";
    } elseif (strlen($password) < 6) {
        $message = "Password must be at least 6 characters!";
    } else {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $username, $email, $hashed_password);

        if ($stmt->execute()) {
            $message = "Registration successful! <a href='login.php'>Login here</a>";
        } else {
            $message = "Error: " . $stmt->error;
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
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
            background: linear-gradient(45deg, #00c6ff, #0072ff);
            color: white;
            cursor: pointer;
            transition: 0.3s;
        }
        input[type="submit"]:hover {
            transform: scale(1.05);
        }
        p {
            color: #ffeb3b;
            font-size: 14px;
        }
        a {
            color: #fff;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Create Account</h2>
        <p><?php echo $message; ?></p>
        <form method="POST">
            <input type="text" name="username" placeholder="Username">
            <input type="email" name="email" placeholder="Email">
            <input type="password" name="password" placeholder="Password">
            <input type="submit" value="Register">
        </form>
        <p>Already have an account? <a href="login.php">Login</a></p>
    </div>
</body>
</html>
