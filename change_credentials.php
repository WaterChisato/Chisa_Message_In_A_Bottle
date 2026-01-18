<?php
session_start();
include 'config.php';
if (!isset($_SESSION['admin'])) {
    header("Location: admin-login.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $new_username = trim($_POST['username']);
    $new_password = trim($_POST['password']);

    if (!empty($new_username) && !empty($new_password)) {
        $hash = password_hash($new_password, PASSWORD_BCRYPT);
        $stmt = $conn->prepare("UPDATE pl_admins SET username=?, password=? WHERE username=?");
        $stmt->bind_param("sss", $new_username, $hash, $_SESSION['admin']);
        if ($stmt->execute()) {
            $_SESSION['admin'] = $new_username;
            setcookie("admin", "true", time()+3600*24, "/");
            $msg = "✅ 修改成功！";
        } else {
            $msg = "❌ 修改失败";
        }
    } else {
        $msg = "⚠️ 用户名和密码不能为空";
    }
}
?>
<!DOCTYPE html>
<html lang="zh">
<head>
<meta charset="UTF-8">
<title>修改管理员账号</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<style>
body { font-family:"Microsoft YaHei"; background:linear-gradient(135deg,#f0f4f8,#d9e4f5); margin:0; padding:0; }
.container { max-width:500px; margin:60px auto; background:#fff; padding:25px; border-radius:12px; box-shadow:0 6px 12px rgba(0,0,0,0.1); }
h2 { text-align:center; color:#0078ff; }
input { width:100%; padding:12px; margin:10px 0; border:1px solid #ccc; border-radius:8px; font-size:16px; }
button { width:100%; padding:12px; background:#0078ff; color:#fff; border:none; border-radius:8px; font-size:16px; cursor:pointer; }
button:hover { background:#005fcc; }
.msg { text-align:center; font-weight:bold; margin:10px 0; }
@media (max-width:600px) { .container { width:90%; margin:30px auto; } }
</style>
</head>
<body>
<div class="container">
    <h2>🔐 修改管理员账号</h2>
    <?php if(isset($msg)) echo "<p class='msg'>$msg</p>"; ?>
    <form method="post">
        <input type="text" name="username" placeholder="新用户名" required>
        <input type="password" name="password" placeholder="新密码" required>
        <button type="submit">保存修改</button>
    </form>
    <p style="text-align:center;margin-top:15px;"><a href="admin.php">返回后台首页</a></p>
</div>
</body>
</html>
