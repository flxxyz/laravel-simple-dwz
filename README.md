# laravel-simple-dwz
基于laravel5.4构造短网址程序

### 介绍
去年的暑假完成了这个简单的短网址程序，主要的缩短功能是ojbk的，我根据个人想法实现出排行榜机制，方便查看"点击"，"生成"，由于laravel框架的限制性，是对小白用户拒绝的，但是呢，有人问我了，那就把部署文档完整写出来，分享自己的小成果。

### 特点
- 基于laravel框架的健壮性与可扩展性
- 排行榜机制
- 还算漂亮的UI界面

## 要求
由于使用laravel框架的原因，请使用PHP版本大于等于5.6.4的版本。详细访问[PHP.net](https://secure.php.net/)

而且已经8012年了，不用php7吗？

### 起步
1. 到[Releases](https://github.com/flxxyz/laravel-simple-dwz/releases)页面选择合适的版本，下载，解压

2. 进入根目录，执行
   // 注意请在命令行界面操作
   ```bash
   cp .env.example .env
   ```
   
   这一步的操作有可能会肥肠肥肠的慢，请自备高速梯子使用或[composer中文网](https://pkg.phpcomposer.com)
   ```bash
   composer update
   ```
   
   生成项目的key，优化项目init速度
   ```bash
   php artisan key:generate
   php artisan route:cache
   php artisan optimize --force
   ```

   给日志与缓存目录设置权限
   ```bash
   chmod -R 777 bootstrap/cache
   chmod -R 777 storage
   ```
   
3. 开始导入数据表
   ```bash
   php artisan migrate --force
   ```

4. 在**apache**或**nginx**的站点配置文件中，将 `public` 设置为根目录
   
   **nginx的栗子**
   ```
   server
   {
       listen 80;
       server_name 你的域名;
       index index.php index.html index.htm;
       root /站点目录/public;
             
       location / {
           try_files $uri $uri/ /index.php$is_args$query_string;  
       }
   }
   ```
   apache请自行对照nginx编写(其实感觉官方不推荐使用nginx)
   
5. 可以启动站点访问了
   

### 感谢
[PHP.net](https://secure.php.net), [Laravel](https://laravel.com/), [bulma.io](https://bulma.io/), [jquery.com](http://jquery.com/)

### License
采用[MIT](./LICENSE)许可证