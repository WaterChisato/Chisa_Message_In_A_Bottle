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
body { font-family:"Microsoft YaHei"; background:linear-gradient(135deg,#89f7fe,#66a6
