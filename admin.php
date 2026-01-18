<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: admin-login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="zh">
<head>
<meta charset="UTF-8">
<title>后台管理</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<style>
body { font-family:"Microsoft YaHei"; background:#f0f4f8; margin:0; padding:0; }
.container { max-width:800px; margin:40px auto; background:#fff; padding:25px; border-radius:12px; box-shadow:0 6px 12px rgba(0,0,0,0.1); }
h1 { text-align:center; color:#0078ff; }
.menu { display:flex; flex-wrap:wrap; justify-content:center; margin-top:20px; }
.menu a { flex:1 1 200px; margin:10px; text-align:center; text-decoration:none; background:#0078ff; color:#fff; padding:15px; border-radius:10px; font-size:16px; transition:0.3s; }
.menu a:hover { background:#005fcc; transform:scale(1.05); }
@media (max-width:600px) { .menu a { font-size:14px; padding:12px; } }
</style>
</head>
<body>
<div class="container">
    <h1>⚙️ 后台管理</h1>
    <p style="text-align:center;">欢迎，<?php echo htmlspecialchars($_SESSION['admin']); ?>！</p>
    <div class="menu">
        <a href="manage_bottles.php">🗑 管理漂流瓶</a>
        <a href="change_credentials.php">🔐 修改用户名/密码</a>
        <a href="logout.php">🚪 退出登录</a>
    </div>
</div>
</body>
</html>
