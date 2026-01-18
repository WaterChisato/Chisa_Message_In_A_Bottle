<?php
session_start();
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    $stmt = $conn->prepare("SELECT * FROM pl_admins WHERE username=?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        if (password_verify($password, $row['password'])) {
            $_SESSION['admin'] = $row['username'];
            setcookie("admin", "true", time()+3600*24, "/");
            header("Location: admin.php");
            exit;
        } else {
            $msg = "❌ 密码错误";
        }
    } else {
        $msg = "❌ 用户不存在";
    }
}
?>
<!DOCTYPE html>
<html lang="zh">
<head>
<meta charset="UTF-8">
<title>管理员登录</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<style>
body { font-family:"Microsoft YaHei"; background:linear-gradient(135deg,#89f7fe,#66a6ff); margin:0; padding:0; }
.container { max-width:400px; margin:80px auto; background:#fff; padding:25px; border-radius:12px; box-shadow:0 6px 12px rgba(0,0,0,0.1); }
h2 { text-align:center; color:#0078ff; }
input { width:100%; padding:12px; margin:10px 0; border:1px solid #ccc; border-radius:8px; font-size:16px; }
button { width:100%; padding:12px; background:#0078ff; color:#fff; border:none; border-radius:8px; font-size:16px; cursor:pointer; }
button:hover { background:#005fcc; }
.msg { color:red; text-align:center; font-weight:bold; }
@media (max-width:600px) { .container { margin:40px auto; width:90%; } }
</style>
</head>
<body>
<div class="container">
    <h2>🔑 管理员登录</h2>
    <?php if(isset($msg)) echo "<p class='msg'>$msg</p>"; ?>
    <form method="post">
        <input type="text" name="username" placeholder="用户名" required>
        <input type="password" name="password" placeholder="密码" required>
        <button type="submit">登录</button>
    </form>
</div>
</body>
</html>
