<?php
// 数据库配置
$host = "localhost";
$user = "";
$pass = "";
$dbname = "";

// 连接数据库
$conn = new mysqli($host, $user, $pass, $dbname);
if ($conn->connect_error) {
    die("数据库连接失败: " . $conn->connect_error);
}
$conn->set_charset("utf8mb4");

// 初始化 SQL：建表
$init_sql = "
CREATE TABLE IF NOT EXISTS pl_indexse (
    id INT AUTO_INCREMENT PRIMARY KEY,
    content TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    ip_address VARCHAR(45) DEFAULT NULL
);

CREATE TABLE IF NOT EXISTS pl_admins (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
);
";

if ($conn->multi_query($init_sql)) {
    while ($conn->more_results() && $conn->next_result()) {;}
}

// 检查是否已有管理员账号
$result = $conn->query("SELECT COUNT(*) as cnt FROM pl_admins");
$row = $result->fetch_assoc();
if ($row['cnt'] == 0) {
    $default_hash = password_hash("114514", PASSWORD_BCRYPT);
    $stmt = $conn->prepare("INSERT INTO pl_admins (username, password) VALUES (?, ?)");
    $username = "admin";
    $stmt->bind_param("ss", $username, $default_hash);
    $stmt->execute();
}
?>
