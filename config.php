<?php
error_reporting(E_ALL & ~E_NOTICE);

ini_set("date.timezone", "Asia/Tokyo");

mb_language("japanese");
mb_internal_encoding("UTF-8");

// コンテンツサーバーURL
define('CONTENTS_SERVER_URL', 'http://c.blog-system-725.localhost');
// テンプレートファイルパス
define('TEMPLATE_PATH', 'C:/Dropbox/develop/blog-system-725/app/templates');
// フッター
define('COPYRIGHT', '&copy;'.date("Y").' SENSE SHARE All Rights Reserved.');
// サイトURL
define('SITE_URL', 'http://blog-system-725.localhost');
// cookie格納場所
define('COOKIE_PATH', '/dev/blogsystem725/web');
