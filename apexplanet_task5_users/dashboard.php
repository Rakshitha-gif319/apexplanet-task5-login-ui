<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: url('https://images.unsplash.com/photo-1446776811953-b23d57bd21aa') no-repeat center center/cover;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            color: white;
            position: relative;
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
            text-align: center;
            background: rgba(255,255,255,0.15);
            backdrop-filter: blur(15px);
            padding: 40px;
            border-radius: 20px;
            width: 400px;
            box-shadow: 0 8px 32px rgba(0,0,0,0.3);
        }
        h2 {
            font-size: 30px;
            margin-bottom: 20px;
        }
        a {
            display: inline-block;
            padding: 12px 25px;
            border-radius: 25px;
            background: linear-gradient(45deg, #00c6ff, #0072ff);
            color: white;
            text-decoration: none;
            transition: 0.3s;
        }
        a:hover {
            transform: scale(1.05);
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Welcome, <?php echo $_SESSION['user']; ?>! 🚀</h2>
        <p>This is your Apex Planet dashboard.</p>
        <a href="logout.php">Logout</a>
    </div>
</body>
</html>
