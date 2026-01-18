



# 🌊 漂流瓶 (Drift Bottle) 

一个基于 PHP + MySQL 的漂流瓶网站，同时支持  
用户可以在网页端 中扔瓶子、捡瓶子，管理员可以在后台管理瓶子和账号。  

---

## ✨ 功能特性

- 前台：
  - 扔瓶子（普通用户每天最多 3 次，管理员无限制）
  - 捡瓶子（随机获取一个瓶子）
- 后台：
  - 管理员登录 / 修改账号密码 / 退出登录
  - 管理漂流瓶（查看、删除）


---

### 📂 项目结构

~~~ 
drift-bottle/
├── config.php              # 数据库连接 + 初始化
├── index.php               # 前台首页
├── throw.php               # 扔瓶子
├── pick.php                # 捡瓶子
├── admin-login.php         # 管理员登录
├── admin.php               # 后台首页
├── change_credentials.php  # 修改管理员账号
├── manage_bottles.php      # 管理漂流瓶
├── logout.php              # 退出登录
~~~

---

⚙️ 安装部署

1. 克隆项目到服务器：
   `bash
   git clone https://github.com/yourname/drift-bottle.git
   cd drift-bottle
   `

2. 配置数据库：
 ~~~
   - 创建数据库 
   - 修改 config.php 中的数据库账号和密码
   - 首次运行时会自动建表并插入默认管理员账号：
     - 用户名：admin
     - 密码：114514

4. 部署到 Web 服务器 (Nginx/Apache)，确保支持 PHP 和 MySQL。
~~~
---

🖥️ 使用方法

前台
- 打开 index.php，即可进入首页。
- 点击 扔瓶子 / 捡瓶子 按钮体验功能。

后台
- 打开 admin-login.php，输入管理员账号密码登录。
- 登录后可进入后台首页，管理漂流瓶或修改账号。

Telegram Bot
1. 在 BotFather 创建机器人，获取 API Token。
2. 修改 polling.php 中的 $token 为你的 Token。
3. 在服务器运行：
   `bash
   php polling.php
   `
4. 在 Telegram 中使用：
   - /start 查看帮助
   - /throw 我今天很开心
   - /pick

---

📜 License

本项目采用 MIT License，可自由使用、修改和分发。  

---

🤝 贡献

欢迎提交 Issue 或 Pull Request，一起完善这个项目
