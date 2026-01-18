<?php
session_start();
include 'config.php';

// 权限检查
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

// 删除操作
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $stmt = $conn->prepare("DELETE FROM pl_indexse WHERE id=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $msg = "瓶子已删除！";
}

// 查询所有瓶子
$result = $conn->query("SELECT * FROM pl_indexse ORDER BY created_at DESC");
?>
<!DOCTYPE html>
<html lang="zh">
<head>
<meta charset="UTF-8">
<title>管理漂流瓶</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<style>
body { font-family:"Microsoft YaHei"; background:#f0f4f8; margin:0; padding:0; }
.container { max-width:800px; margin:40px auto; background:#fff; padding:20px; border-radius:10px; box-shadow:0 4px 8px rgba(0,0,0,0.1); }
h2 { margin-top:0; }
.bottle { border:1px solid #ccc; border-radius:8px; padding:15px; margin-bottom:15px; background:#fafafa; }
small { color:#666; display:block; margin-top:8px; }
a.delete { color:red; text-decoration:none; margin-left:10px; }
a.delete:hover { text-decoration:underline; }
.msg { color:green; font-weight:bold; }
@media (max-width:600px) {
    .container { width:95%; padding:15px; }
    .bottle { font-size:14px; }
}
</style>
</head>
<body>
<div class="container">
    <h2>🗑 漂流瓶管理</h2>
    <p><a href="dashboard.php">返回后台首页</a></p>
    <?php if(isset($msg)) echo "<p class='msg'>$msg</p>"; ?>
    <hr>
    <?php
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<div class='bottle'>";
            echo "<p>" . nl2br(htmlspecialchars($row['content'])) . "</p>";
            echo "<small>时间：" . $row['created_at'] . " | IP：" . $row['ip_address'] . "</small>";
            echo "<a class='delete' href='?delete=" . $row['id'] . "' onclick='return confirm(\"确认删除这个瓶子吗？\")'>删除</a>";
            echo "</div>";
        }
    } else {
        echo "<p>目前没有漂流瓶。</p>";
    }
    ?>
</div>
</body>
</html>
