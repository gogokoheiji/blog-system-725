<!-- ================== BEGIN BASE JS ================== -->
<script src="<?php echo CONTENTS_SERVER_URL ?>/assets/plugins/jquery/jquery-3.2.1.min.js"></script>
<script src="<?php echo CONTENTS_SERVER_URL ?>/assets/plugins/jquery/jquery-migrate-1.1.0.min.js"></script>
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
<!-- ================== BEGIN PAGE LEVEL JS ================== -->
<script src="<?php echo CONTENTS_SERVER_URL ?>/assets/plugins/ckeditor/ckeditor.js"></script>
<script src="<?php echo CONTENTS_SERVER_URL ?>/assets/plugins/bootstrap-wysihtml5/dist/bootstrap3-wysihtml5.all.min.js"></script>
<script src="<?php echo CONTENTS_SERVER_URL ?>/assets/js/demo/form-wysiwyg.demo.min.js"></script>
<!-- DATETIMEピッカー -->
<script src="<?php echo CONTENTS_SERVER_URL ?>/assets/plugins/bootstrap-daterangepicker/moment.js"></script>
<script src="<?php echo CONTENTS_SERVER_URL ?>/assets/plugins/bootstrap-eonasdan-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>
<!-- ON/OFFトグル -->
<script src="//gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
<!-- WISYWIG -->
<script src="<?php echo CONTENTS_SERVER_URL ?>/assets/plugins/summernote/summernote.min.js"></script>
<script src="<?php echo CONTENTS_SERVER_URL ?>/assets/plugins/summernote/lang/summernote-ja-JP.min.js"></script>
<!-- ================== END PAGE LEVEL JS ================== -->
<script>
	$(document).ready(function() {
	// DATETIMEピッカー
	$('#datetimepicker1').datetimepicker({
		format : 'YYYY/MM/DD HH:mm'
	});


	var H2Button = function (context) {
		var ui = $.summernote.ui;
		var button = ui.button({
			contents: '<i class="fa fa-th-list"/>',
			tooltip: '目次',
			click: function () {
				context.invoke('editor.insertText', '[h2 title="見出し文言"]');
			}
		});
		return button.render();
	}

	var H3Button = function (context) {
		var ui = $.summernote.ui;
		var button = ui.button({
			contents: '<i class="fa fa-chevron-right"/>',
			tooltip: '中項目',
			click: function () {
				context.invoke('editor.insertText', '[h3 title="見出し文言"]');
			}
		});
		return button.render();
	}

	var ListButton = function (context) {
		var ui = $.summernote.ui;
		var button = ui.button({
			contents: '<i class="fa fa-bars"/>',
			tooltip: 'リスト',
			click: function () {
				context.invoke('editor.insertText', '[list value="1.あいうえお,2.かきくけこ,3.さしすせそ"]');
			}
		});
		return button.render();
	}

	var ListOkButton = function (context) {
		var ui = $.summernote.ui;
		var button = ui.button({
			contents: '<i class="fa fa-tasks"/>',
			tooltip: 'リスト(チェック)',
			click: function () {
				context.invoke('editor.insertText', '[list-ok value="1.あいうえお,2.かきくけこ,3.さしすせそ"]');
			}
		});
		return button.render();
	}

	var BoxGreenButton = function (context) {
		var ui = $.summernote.ui;
		var button = ui.button({
			contents: '<i class="fa fa-square"/>',
			tooltip: 'ボックス(緑)',
			click: function () {
				context.invoke('editor.insertText', '[success title="緑ボックス"]');
			}
		});
		return button.render();
	}

	var BoxYellowButton = function (context) {
		var ui = $.summernote.ui;
		var button = ui.button({
			contents: '<i class="far fa-square"/>',
			tooltip: 'ボックス(黄)',
			click: function () {
				context.invoke('editor.insertText', '[alert title="黄色ボックス"]');
			}
		});
		return button.render();
	}

	var AuthorCommentButton = function (context) {
		var ui = $.summernote.ui;
		var button = ui.button({
			contents: '<i class="fa fa-comment"/>',
			tooltip: '執筆者コメント',
			click: function () {
				context.invoke('editor.insertText', '[comment title="執筆者コメント"]');
			}
		});
		return button.render();
	}

	var RelationEntryButton = function (context) {
		var ui = $.summernote.ui;
		var button = ui.button({
			contents: '<i class="fa fa-copy"/>',
			tooltip: '別記事リンク',
			click: function () {
				context.invoke('editor.insertText', '[entry id="1"]');
			}
		});
		return button.render();
	}

	var SourceCodeButton = function (context) {
		var ui = $.summernote.ui;
		var button = ui.button({
			contents: '<i class="fa fa-terminal"/>',
			tooltip: 'ソースコード',
			click: function () {
				context.invoke('editor.insertText', '[code]ソースコード(改行可)[/code]');
			}
		});
		return button.render();
	}

	// WISYWIG
	$('.summernote').summernote({
		placeholder: '',
		height: 500,
		toolbar: [
			// [groupName, [list of button]]
			['basic', ['undo', 'redo']],
			['style', ['bold', 'italic', 'underline', 'strikethrough']],
			['fontsize', ['fontsize']],
			['color', ['color']],
			['para', ['paragraph']],
			['table', ['hr', 'table']],
			['insert', ['link', 'relationentry']],
			['media', ['picture', 'video']],
			['custom1', ['h2', 'h3']],
			['custom2', ['list', 'listok']],
			['custom3', ['boxgreen', 'boxyellow']],
			['custom4', ['authorcomment', 'sourcecode']],
			['misc', ['codeview']],
		],
		buttons: {
			h2: H2Button,
			h3: H3Button,
			list: ListButton,
			listok: ListOkButton,
			boxgreen: BoxGreenButton,
			boxyellow: BoxYellowButton,
			authorcomment: AuthorCommentButton,
			relationentry: RelationEntryButton,
			sourcecode: SourceCodeButton,
		},
		fontNames: ["YuGothic","Yu Gothic","Hiragino Kaku Gothic Pro","Meiryo","sans-serif", "Arial","Arial Black","Comic Sans MS","Courier New","Helvetica Neue","Helvetica","Impact","Lucida Grande","Tahoma","Times New Roman","Verdana"],
		lang: "ja-JP",

		callbacks: {
			onImageUpload : function(files, editor, welEditable) {
				for (var i = files.length - 1; i >= 0; i--) {
					sendFile(files[i], this);
				}
			}
		}
	});

	function sendFile(file, el) {
		var formData = new FormData();
		formData.append('mode', 'add_image');
		formData.append('eid', '');
		formData.append('file', file);
		formData.append('FLUXDEMOTOKEN', '8422ee338e4f810ca066e694788bb8b0bf9c7422');

		$.ajax({
			type: "POST",
			url: '/blog/entry/',
			data: formData,
			processData: false,
			contentType: false,
			cache: false,
			success: function(url) {
				$(el).summernote('editor.insertImage', url);
			}
		});
	}
});

// 画像ファイルを選択した際にプレビューを表示する
$('form').on('change', 'input[type="file"]', function(e) {
	var file = e.target.files[0],
	reader = new FileReader(),
	$preview = $(".image-preview");
	t = this;

	// 画像ファイル以外の場合は何もしない
	if (file.type.indexOf("image") < 0) {
		return false;
	}

	// ファイル読み込みが完了した際のイベント登録
	reader.onload = (function(file) {
		return function(e) {
			// 既存のプレビューを削除
			$preview.empty();
			// .prevewの領域の中にロードした画像を表示するimageタグを追加
			$preview.append($('<img>').attr({
				src: e.target.result,
				width: "100%",
				class: "image-preview m-b-5",
				title: file.name
			}));
		};
	})(file);
	reader.readAsDataURL(file);
});

// 新規カテゴリー追加ボタンが押された時の処理
function create_category() {
	var inputVal = $("#new_category_name").val();

	if (inputVal != "") {
		// フォームデータを取得し、追加で送るデータを登録する
		var formData = new FormData();
		formData.append('mode', 'add_category');
		formData.append('category_name', inputVal);
		formData.append('FLUXDEMOTOKEN', '8422ee338e4f810ca066e694788bb8b0bf9c7422');

		$.ajax({
			type: "POST",
			url: "/blog/entry/",
			data: formData,
			processData: false,
			contentType: false,
			success: function(xml) {
				var check_status = $(xml).find("status").text();
				if (check_status == 1) {
					var category_id = $(xml).find("targetId").text();
					$("#category_area").append('<li class="checkbox checkbox-css m-l-15 m-b-5"><input type="checkbox" id="category_'+category_id+'" name="category_id[]" value="'+category_id+'" checked /><label for="category_'+category_id+'">'+inputVal+'</label></li>');
					$("#new_category_name").val('');
				}
			}
		});
	}
}

// プレビューボタンが押された時の処理
$('[data-click="preview"]').click(function(e) {
	var form = document.getElementById("mainform");

	form.action = "/blog/preview/";
	form.target = "_blank";
	form.submit();

	form.action = "";
	form.target = "_self";
});

// SEOディスクリプション文字数カウント（HTMLタグ除去対応）
$(document).ready(function(){
	var str = $("#seo_description").val();
	var tag_remove_str = str.replace(/<("[^"]*"|'[^']*'|[^'">])*>/g,'');
	$("#seo_description_text_count").html(tag_remove_str.length+'文字');
});
$(function(){
	$("#seo_description").on("keyup blur", function(){
		var str = $(this).val();
		var tag_remove_str = str.replace(/<("[^"]*"|'[^']*'|[^'">])*>/g,'');
		$("#seo_description_text_count").html(tag_remove_str.length+'文字');
	});
});
</script>
<!-- ================== END PAGE LEVEL JS ================== -->

<script src="<?php echo CONTENTS_SERVER_URL ?>/assets/plugins/bootstrap-sweetalert/sweetalert.min.js"></script>

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
				url: "/blog/entry/",
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
