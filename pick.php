<?php
include 'config.php';
$result = $conn->query("SELECT * FROM pl_indexse ORDER BY RAND() LIMIT 1");
?>
<!DOCTYPE html>
<html lang="zh">
<head>
<meta charset="UTF-8">
<title>捡瓶子</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<style>
body { font-family:"Microsoft YaHei"; background:#f0f4f8; }
.container { max-width:600px; margin:40px auto; background:#fff; padding:20px; border-radius:10px; box-shadow:0 4px 8px rgba(0,0,0,0.1); }
.bottle { border:1px solid #ccc; border-radius:8px; padding:15px; margin-top:20px; background:#fafafa; }
small { color:#666; }
</style>
</head>
<body>
<div class="container">
    <h2>🧾 捡瓶子</h2>
    <?php
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo "<div class='bottle'>";
        echo "<p>" . nl2br(htmlspecialchars($row['content'])) . "</p>";
        echo "<small>时间：" . $row['created_at'] . "</small>";
        echo "</div>";
    } else {
        echo "<p>海里还没有瓶子哦，快去扔一个吧！</p>";
    }
    ?>
</div>
</body>
</html>
