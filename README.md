Config
============================

Edit config/local.php and config/console.php for database properties set(console and web)

Install
============================

1. Clone project

   ```
   git clone https://github.com/kotaba/test.project.git
   ```

2. Composer 

   ```
   composer up
   ```

3. Migrations

   ```
   php yii migrate
   ```

4. Set web server root directory to {project_path}/web

5. Start Websocket server

   ```
   php yii socket/start-socket &
   ```

6. Done!
