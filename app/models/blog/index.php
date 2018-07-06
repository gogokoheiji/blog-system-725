<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<head>
	<!-- head_tag -->
	<?php include(TEMPLATE_PATH."/head_tag.php"); ?>
</head>
<body>
	<!-- #page-loader -->
	<?php include(TEMPLATE_PATH."/page_loader.php"); ?>

	<!-- begin #page-container -->
	<div id="page-container" class="page-container fade page-sidebar-fixed page-header-fixed">

		<!-- #header -->
		<?php include(TEMPLATE_PATH."/header.php"); ?>

		<!-- #sidebar -->
		<?php include(TEMPLATE_PATH."/sidebar.php"); ?>

		<!-- begin #content -->
		<div id="content" class="content">
			<!-- breadcrumb -->
			<?php include(TEMPLATE_PATH."/breadcrumb.php"); ?>
			<!-- begin page-header -->
			<h1 class="page-header">Blank Page <small>header small text goes here...</small></h1>
			<!-- end page-header -->

			<!-- begin panel -->
			<div class="panel panel-inverse">
				<div class="panel-heading">
					<div class="panel-heading-btn">
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a>
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
					</div>
					<h4 class="panel-title">Panel Title here</h4>
				</div>
				<div class="panel-body">
					Panel Content Here
				</div>
			</div>
			<!-- end panel -->
		</div>
		<!-- end #content -->

		<!-- scroll to top btn -->
		<?php include(TEMPLATE_PATH."/scroll_top.php"); ?>
	</div>
	<!-- end page container -->

	<!-- scripts -->
	<?php include(TEMPLATE_PATH."/scripts.php"); ?>
</body>
</html>
