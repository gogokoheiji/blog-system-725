<?php
// URLマッピングファイル呼び出し
require_once(dirname(__FILE__).'/url_list.php');
// 共通ファンクション参照
require_once(dirname(__FILE__).'/../functions/require.php');

try {
	session_start();
	$request_path = $_REQUEST['path'];

	// DB接続
	$pdo = connectDb();

	// サインアップページの場合はログインチェック無し
	if ($request_path == '/signup/') {
		include(dirname(__FILE__).'/models/client/signup.php');
	} else {
		// ログインチェック
		if (check_client_login($pdo,$user['mail_address'],$user['password'])) {
			header('Location:'.SITE_URL.'/blog/');
		} else {
			if (isset($url_list[$request_path])) {
				// アクセスされたURLのプログラムに処理を移譲
				include(dirname(__FILE__).$url_list[$request_path]);
			}
		}
	}
	unset($pdo);
} catch (Exception $e) {
	exit;
}
