<?php
// 特殊文字をhtmlエンティティに変換
function h($original_str) {
	return htmlspecialchars($original_str, ENT_QUOTES, "UTF-8");
}

// データベースに接続
function connectDb() {
    $param = "mysql:dbname=".DB_NAME.";host=".DB_HOST;

    try {
        $pdo = new PDO($param, DB_USER, DB_PASSWORD);
        $pdo->query('SET NAMES utf8;');
        return $pdo;
    } catch (PDOException $e) {
        echo $e->getMessage();
        exit;
    }
}

// トークンを発行する
function setToken() {
	$token = sha1(uniqid(mt_rand(), true));
	$_SESSION['sstoken'] = $token;
}

// トークンをチェックする
function checkToken() {
	if (empty($_SESSION['sstoken']) || ($_SESSION['sstoken'] != $_POST['token'])) {
		echo '<html><head><meta charset="utf-8"></head><body>不正アクセスです。</body></html>';
		exit;
	}
}

// データベース（clientテーブル）メール重複チェック
function checkEmail($pdo,$mail_address) {
	$sql = "select COUNT(*) from client where mail_address = ?";
	$stmt = $pdo->prepare($sql);

	$stmt->bindValue(1, $mail_address, PDO::PARAM_STR);

	$stmt->execute();

	return $stmt->fetchColumn();

}
// データベース（clientテーブル）に新規登録する。
function createUser($pdo, $user) {
	$sql = "insert into client
	(client_name, mail_address, password, created_at, updated_at)
	values
	(:client_name, :mail_address, :password, now(), now())";

	$stmt = $pdo->prepare($sql);

	$stmt->bindValue(':client_name', $user['client_name'], PDO::PARAM_STR);
	$stmt->bindValue(':mail_address', $user['mail_address'], PDO::PARAM_STR);
	$stmt->bindValue(':password', $user['password'], PDO::PARAM_STR);

	$stmt->execute();
}

// データベース（blogテーブル）に新規登録する。
function createBlogId($pdo, $blog_id) {
	$sql = "insert into blog
	(client_id, created_at, updated_at)
	values
	(:client_id, now(), now())";

	$stmt = $pdo->prepare($sql);

	$stmt->bindValue(':client_id', $blog_id, PDO::PARAM_INT);

	$stmt->execute();
}

// メール送信機能
function sendMail($array_mail, $flag) {
	mb_language("japanese");
	mb_internal_encoding("UTF-8");

	// 新規ユーザー登録時のめーる
	if ($flag == 0) {
		/* 管理者へのメール start */
		$mail_title = '【ブログ】新規ユーザ登録がありました。';
		$mail_body = '新規ユーザーの登録がありました。'.PHP_EOL;
		$mail_body .= 'アカウント：'.$array_mail['client_name'].PHP_EOL;
		$mail_body .= 'メールアドレス：'.$array_mail['mail_address'].PHP_EOL;
		$mail_body .= '招待コード：'.$array_mail['secret_code'];
		mb_send_mail(ADMIN_MAIL_ADDRESS, $mail_title, $mail_body);
		/* 管理者へのメール end*/
		/* ユーザーへのメール start */
		$mail_title = '【ブログ】ご登録ありがとうございます。';
		$mail_body = 'アカウント：'.$array_mail['client_name'].PHP_EOL;
		$mail_body .= 'メールアドレス：'.$array_mail['mail_address'].PHP_EOL;
		$mail_body .= '招待コード：'.$array_mail['secret_code'].PHP_EOL;
		$mail_body .= 'それでは、引き続きよろしくお願いします。';
		mb_send_mail($array_mail['mail_address'], $mail_title, $mail_body, $from);
		/* ユーザーへのメール end */
	// ユーザー情報更新時のメール
	} elseif ($flag == 1) {

	}

}
