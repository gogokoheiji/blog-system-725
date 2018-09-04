<?php

// 初期化
$err_msg = array();
$user = array();

// Httpリクエスト判定
if ($_SERVER['REQUEST_METHOD'] != 'POST') {
	// 初期表示

	// 初期化

} else {

	// 入力パラメーターの取得
	$user['client_name'] = $_POST['client_name'];
	$user['mail_address'] = $_POST['mail_address'];
	$user['password'] = $_POST['password'];
	$user['password_confirm'] = $_POST['password_confirm'];
	$user['secret_code'] = $_POST['secret_code'];
	$user['agreement'] = $_POST['agreement'];

	$pdo = connectDb();

	// トランザクション処理を開始
	$pdo->beginTransaction();

	// クライアント名入力チェック
	if ($user['client_name'] == '') {
		$err_msg['client_name'] = 'アカウント名を入力してください。';
	} else {
		if (strlen(mb_convert_encoding($user['client_name'], 'SJIS', 'UTF-8')) > 200) {
			$err_msg['client_name'] = 'アカウント名は200文字以内で入力してください。';
		}
	}
	// メールアドレス入力チェック
	if ($user['mail_address'] == '') {
		$err_msg['mail_address'] = 'メールアドレスを入力してください。';
	} else {
		if (!filter_var($user['mail_address'], FILTER_VALIDATE_EMAIL)) {
			$err_msg['mail_address'] = 'メールアドレスが不正です';
		} else {
			// メールアドレス存在チェック
			if (checkEmail($pdo, $user['mail_address']) > 0) {
				$err_msg['mail_address'] = 'このメールアドレスはすでに使用されています。';
			}
		}
	}
	// パスワード入力チェック
	if ($user['password'] == '') {
		$err_msg['password'] = 'パスワードが未入力です';
	} else {
		if (strlen(mb_convert_encoding($user['password'], 'SJIS', 'UTF-8')) < 8) {
			$err_msg['password'] = 'パスワードは8文字以上で入力してください。';
		} else {
			// [パスワード再入力]
			if ($user['password'] != $user['password_confirm']) {
				$err_msg['password_confirm'] = '再入力パスワードが一致しません。';
			}
		}
	}

	// [招待コード]入力チェック
	if ($user['secret_code'] == '') {
		$err_msg['secret_code'] = '招待コードが未入力です';
	} else {

	}
	// [規約ポリシー]チェック
	if ($user['agreement'] != 1) {
		$err_msg['agreement'] = 'アカウントを作成するには同意が必要です。';
	} else {

	}

	// エラー判定
	if (empty($err_msg)) {
		try {
			/* トランザクションを開始する。オートコミットがオフになる */
			$pdo->beginTransaction();

			// if ($result == false) throw new PDOException("beginTransaction failure");
			echo __FILE__ . __LINE__;
			exit;
			try {
				echo __FILE__ . __LINE__;
				exit;
				// クライアント新規登録
				createUser($pdo, $user);

				// INSERTされたデータのIDを取得
				$tran_id = $pdo->lastInsertId();
				// ブログ新規登録
				createBlogId($pdo, $tran_id);
				// トランザクション完了
				$pdo->commit();
			} catch (PDOException $e) {
				echo 'Error!'.$e->getMessage();
				// トランザクション取り消し
				$pdo->rollBack();
				exit;
			}
		} catch (Exception $e) {
			echo 'Error!'.$e->getMessage();
			echo __FILE__ . __LINE__;
			exit;
		}
		unset($pdo);
	}
}
 ?>
<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html lang="ja">
<!--<![endif]-->
<head>
	<meta charset="utf-8" />
	<title>アカウント作成 | BLOG SYSTEM</title>
	<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
	<meta content="Blog System Demonstration" name="description" />
	<meta content="KOHEIJI BLOG" name="author" />

	<!-- ================== BEGIN BASE CSS STYLE ================== -->
	<link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
	<link href="<?php echo CONTENTS_SERVER_URL ?>/assets/plugins/jquery-ui/jquery-ui.min.css" rel="stylesheet" />
	<link href="<?php echo CONTENTS_SERVER_URL ?>/assets/plugins/bootstrap/4.1.0/css/bootstrap.min.css" rel="stylesheet" />
	<link href="<?php echo CONTENTS_SERVER_URL ?>/assets/plugins/font-awesome/5.0/css/fontawesome-all.min.css" rel="stylesheet" />
	<link href="<?php echo CONTENTS_SERVER_URL ?>/assets/plugins/animate/animate.min.css" rel="stylesheet" />
	<link href="<?php echo CONTENTS_SERVER_URL ?>/assets/css/default/style.min.css" rel="stylesheet" />
	<link href="<?php echo CONTENTS_SERVER_URL ?>/assets/css/default/style-responsive.min.css" rel="stylesheet" />
	<link href="<?php echo CONTENTS_SERVER_URL ?>/assets/css/default/theme/default.css" rel="stylesheet" id="theme" />
	<!-- ================== END BASE CSS STYLE ================== -->

	<!-- ================== BEGIN BASE JS ================== -->
	<script src="<?php echo CONTENTS_SERVER_URL ?>/assets/plugins/pace/pace.min.js"></script>
	<!-- ================== END BASE JS ================== -->

	<link rel="icon" type="image/vnd.microsoft.icon" href="https://demo.flu-x.net/contents/img/favicon.ico">
	<link rel="shortcut icon" type="image/vnd.microsoft.icon" href="https://demo.flu-x.net/contents/img/favicon.ico">
	<link rel="apple-touch-icon" sizes="180x180" href="https://demo.flu-x.net/contents/img/apple-touch-icon-180x180.png">

	<style>
	.border-top {border-top: 1px solid #dcdcdc!important;}
	.border-bottom {border-bottom: 1px solid #dcdcdc!important;}
	.border-left {border-left: 1px solid #dcdcdc!important;}
	.border-right {border-right: 1px solid #dcdcdc!important;}
	</style>
</head>
<body class="pace-top bg-white">
	<!-- begin #page-loader -->
	<div id="page-loader" class="fade show"><span class="spinner"></span></div>
	<!-- end #page-loader -->

	<!-- begin #page-container -->
	<div id="page-container" class="fade">
	    <!-- begin register -->
        <div class="register register-with-news-feed">
            <!-- begin news-feed -->
            <div class="news-feed">
                <div class="news-image" style="background-image: url(<?php echo CONTENTS_SERVER_URL ?>/assets/img/login-bg/login-bg-9.jpg)"></div>
                <div class="news-caption">
                    <h4 class="caption-title"><b>BLOG SYSTEM</b></h4>
                    <p>
                        Blog System Demonstration
                    </p>
                </div>
            </div>
            <!-- end news-feed -->
            <!-- begin right-content -->
            <div class="right-content">
                <!-- begin register-header -->
                <h1 class="register-header">
                    アカウント作成
                    <small>Create your FLUX Account.</small>
                </h1>
                <!-- end register-header -->
                <!-- begin register-content -->
                <div class="register-content">
                    <form action="" method="POST" class="margin-bottom-0">
						<label class="control-label">アカウント名 <span class="text-danger">*</span></label>
                        <div class="row m-b-15">
                            <div class="col-md-12">
                                <input type="text" class="form-control <?php if ($err_msg['client_name'] != '') echo 'is-invalid'; ?>" name="client_name" value="" placeholder="" />
								<div class="invalid-feedback"><?php echo $err_msg['client_name']; ?></div>
							</div>
                        </div>
                        <label class="control-label">メールアドレス <span class="text-danger">*</span></label>
                        <div class="row m-b-15">
                            <div class="col-md-12">
                                <input type="email" class="form-control <?php if ($err_msg['mail_address'] != '') echo 'is-invalid'; ?>" name="mail_address" value="" placeholder="" />
								<div class="invalid-feedback"><?php echo $err_msg['mail_address']; ?></div>
                            </div>
                        </div>
                        <label class="control-label">パスワード <span class="text-danger">*</span></label>
                        <div class="row row-space-10">
                            <div class="col-md-6 m-b-15">
                                <input type="password" class="form-control <?php if ($err_msg['password'] != '') echo 'is-invalid'; ?>"  name="password" value="" placeholder="8文字以上" />
								<div class="invalid-feedback"><?php echo $err_msg['password']; ?></div>
							</div>
							<div class="col-md-6 m-b-15">
                                <input type="password" class="form-control <?php if ($err_msg['password_confirm'] != '') echo 'is-invalid'; ?>"  name="password_confirm" value="" placeholder="再入力" />
								<div class="invalid-feedback"><?php echo $err_msg['password_confirm']; ?></div>
                            </div>
                        </div>
                        <label class="control-label">招待コード <span class="text-danger">*</span></label>
                        <div class="row m-b-15">
                            <div class="col-md-12">
                                <input type="text" class="form-control <?php if ($err_msg['secret_code'] != '') echo 'is-invalid'; ?>" name="secret_code" value="" placeholder="招待コードをお持ちの方のみがご登録頂けます。" />
								<div class="invalid-feedback"><?php echo $err_msg['secret_code']; ?></div>
                            </div>
                        </div>
                        <div class="checkbox checkbox-css m-b-30 <?php if ($err_msg['agreement'] != '') echo 'is-invalid'; ?>">
                        	<div class="checkbox checkbox-css m-b-30">
								<input type="checkbox" id="agreement" name="agreement" value="1">
								<label for="agreement">
									<a href="javascript:;">利用規約</a>及び<a href="javascript:;">プライバシーポリシー</a>に同意します。
								</label>
								<div class="m-t-5 text-danger"><?php echo $err_msg['agreement']; ?></div>
							</div>
                        </div>
                        <div class="register-buttons">
                            <button type="submit" class="btn btn-primary btn-block btn-lg">アカウント作成</button>
                        </div>
                        <div class="m-t-20 m-b-40 p-b-40 text-inverse">
                            既にアカウントをお持ちの方は<a href="/login/">こちら</a>
                        </div>
                        <hr />
                        <p class="text-center">
                            &copy;2018 KOHEIJI BLOG All Rights Reserved.
                        </p>
						<input type="hidden" name="FLUXDEMOTOKEN" value="" />
                    </form>
                </div>
                <!-- end register-content -->
            </div>
            <!-- end right-content -->
        </div>
        <!-- end register -->
	</div>
	<!-- end page container -->

	<!-- ================== BEGIN BASE JS ================== -->
	<script src="<?php echo CONTENTS_SERVER_URL ?>/assets/plugins/jquery/jquery-3.2.1.min.js"></script>
	<script src="<?php echo CONTENTS_SERVER_URL ?>/assets/plugins/jquery-ui/jquery-ui.min.js"></script>
	<script src="<?php echo CONTENTS_SERVER_URL ?>/assets/plugins/bootstrap/4.1.0/js/bootstrap.bundle.min.js"></script>
	<!--[if lt IE 9]>
		<script src="<?php echo CONTENTS_SERVER_URL ?>/assets/crossbrowserjs/html5shiv.js"></script>
		<script src="<?php echo CONTENTS_SERVER_URL ?>/assets/crossbrowserjs/respond.min.js"></script>
		<script src="<?php echo CONTENTS_SERVER_URL ?>/assets/crossbrowserjs/excanvas.min.js"></script>
	<![endif]-->
	<script src="<?php echo CONTENTS_SERVER_URL ?>/assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>
	<script src="<?php echo CONTENTS_SERVER_URL ?>/assets/plugins/js-cookie/js.cookie.js"></script>
	<script src="<?php echo CONTENTS_SERVER_URL ?>/assets/js/theme/default.min.js"></script>
	<script src="<?php echo CONTENTS_SERVER_URL ?>/assets/js/apps.min.js"></script>
	<!-- ================== END BASE JS ================== -->

	<script>
		$(document).ready(function() {
			App.init();
		});

		function form_submit(mode, code, message) {
			if (confirm(message)) {
				document.mainform.mode.value = mode;
				document.mainform.code.value = code;
				document.mainform.submit();
			}
		}

		$('[data-click="delete-confirm"]').click(function(e) {
			e.preventDefault();
			swal({
				title: '削除してもよろしいですか？',
				text: '削除したデータは元には戻せません。',
				icon: 'error',
				buttons: {
					cancel: {
						text: 'キャンセル',
						value: null,
						visible: true,
						className: 'btn btn-default',
						closeModal: true,
					},
					confirm: {
						text: '削除',
						value: true,
						visible: true,
						className: 'btn btn-danger',
						closeModal: true
					}
				}
			})
			.then((willDelete) => {
				if (willDelete) {
					var delete_code = $(this).data('id');

					var formData = new FormData(document.getElementById("mainform"));
					formData.append('mode', 'delete');
					formData.append('code', delete_code);

					$.ajax({
						type: "POST",
						url: "/signup",
						data: formData,
						processData: false,
						contentType: false,
						success: function(xml) {
							var check_status = $(xml).find("status").text();
							if (check_status == 1) {
								$("#item_"+delete_code).remove();
							}
						}
					});
				}
			});
		});
	</script>
</body>
</html>
