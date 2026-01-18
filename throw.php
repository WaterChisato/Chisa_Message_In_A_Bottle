<?php
session_start();
include 'config.php';

$isAdmin = isset($_SESSION['admin']) || (isset($_COOKIE['admin']) && $_COOKIE['admin'] === 'true');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $content = trim($_POST['content']);
    $ip = $_SERVER['REMOTE_ADDR'];

    if (!$isAdmin) {
        $stmt = $conn->prepare("SELECT COUNT(*) as cnt FROM pl_indexse WHERE ip_address=? AND DATE(created_at)=CURDATE()");
        $stmt->bind_param("s", $ip);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        if ($row['cnt'] >= 3) {
            $msg = "⚠️ 今天你已经扔过 3 次瓶子了，明天再来吧！";
        }
    }

    if (!empty($content) && !isset($msg)) {
        $stmt = $conn->prepare("INSERT INTO pl_indexse (content, ip_address) VALUES (?, ?)");
        $stmt->bind_param("ss", $content, $ip);
        $stmt->execute();
        $msg = "✅ 瓶子已成功扔出！";
    }
}
?>
<!DOCTYPE html>
<html lang="zh">
<head>
<meta charset="UTF-8">
<title>扔瓶子</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<style>
body { font-family:"Microsoft YaHei"; background:#f0f4f8; }
.container { max-width:600px; margin:40px auto; background:#fff; padding:20px; border-radius:10px; box-shadow:0 4px 8px rgba(0,0,0,0.1); }
textarea { width:100%; height:120px; border-radius:8px; border:1px solid #ccc; padding:10px; font-size:16px; }
button { margin-top:15px; width:100%; padding:12px; background:#0078ff; color:#fff; border:none; border-radius:8px; font-size:16px; cursor:pointer; }
button:hover { background:#005fcc; }
.msg { margin:10px 0; font-weight:bold; }
</style>
</head>
<body>
<div class="container">
    <h2>✍️ 扔瓶子</h2>
    <?php if(isset($msg)) echo "<p class='msg'>$msg</p>"; ?>
    <form method="post">
        <textarea name="content" placeholder="写下你的漂流瓶内容..."></textarea><br>
        <button type="submit">扔瓶子</button>
    </form>
</div>
</body>
</html>
