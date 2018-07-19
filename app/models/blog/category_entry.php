<?php include(TEMPLATE_PATH."/template_head.php"); ?>
<form method="POST" class="form-horizontal form-bordered" id="mainform" enctype="multipart/form-data">
	<!-- begin panel -->
	<div class="panel panel-inverse">
		<!-- begin panel-body -->
		<div class="panel-body panel-form">
			<div class="form-group row">
				<label class="col-md-2 col-form-label">カテゴリー名</label>
				<div class="col-md-10">
					<input name="category_name" type="text" class="form-control " value="" />
					<div class="invalid-feedback"></div>
				</div>
			</div>
			<div class="form-group row">
				<label class="col-md-2 col-form-label">スラッグ</label>
				<div class="col-md-10">
					<input name="blog_category_slug" type="text" class="form-control " value="" />
					<div class="invalid-feedback"></div>
				</div>
			</div>
			<div class="form-group row">
				<label class="col-md-2 col-form-label">表示順序</label>
				<div class="col-md-10">
					<input name="sort_order" type="text" class="form-control " value="" />
					<div class="invalid-feedback"></div>
				</div>
			</div>

		</div>
		<!-- end panel-body -->
	</div>
	<!-- end panel -->

	<!-- begin wrapper -->
	<div class="wrapper bg-silver text-right">
		<a href="/blog/category/"><button type="button" class="btn btn-white p-l-40 p-r-40 m-r-5">キャンセル</button></a>
		<button type="submit" class="btn btn-primary p-l-40 p-r-40" onclick="mainform.submit();">登録</button>
	</div>
	<!-- end wrapper -->

	<input type="hidden" name="code" value="" />
	<input type="hidden" name="MAX_FILE_SIZE" value="5242880" />
	<input type="hidden" name="FLUXDEMOTOKEN" value="581feb5f7f0b3306077a4e2d1558cafd5a42fe6b" />
</form>
<?php include(TEMPLATE_PATH."/template_bottom.php"); ?>
