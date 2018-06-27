<?php
// URLマッピングファイル呼び出し
require_once(dirname(__FILE__).'/url_list.php');
// 共通ファンクション参照
require_once(dirname(__FILE__).'/../functions/require.php');

try {
	session_start();
	$request_path = $_REQUEST['path'];

	if (isset($url_list[$request_path])) {
		// アクセスされたURLのプログラムに処理を移譲
		include(dirname(__FILE__).$url_list[$request_path]);
	}
} catch (Exception $e) {
	exit;
}
