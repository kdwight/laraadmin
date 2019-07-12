<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
	<title>Upload an image/pdf</title>
	<script type="text/javascript" src="js/dialog-v4.js"></script>
	<link href="css/dialog-v4.css" rel="stylesheet" type="text/css">
</head>
<body>

	<?php
	$base_url    = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ? "https" : "http");
	$base_url   .= "://" . $_SERVER['HTTP_HOST'];
	$base_url   .= str_replace(basename($_SERVER['SCRIPT_NAME']), "", $_SERVER['SCRIPT_NAME']);
	$target_url  = str_ireplace('js/tinymce/plugins/jbimages/', '', $base_url);
	?>

	<form class="form-inline" id="upl" name="upl" action="<?=$target_url?>uploader/upload" method="post" enctype="multipart/form-data" target="upload_target" onsubmit="jbImagesDialog.inProgress();" accept="image/*">

		<div id="upload_in_progress" class="upload_infobar"><img src="img/spinner.gif" width="16" height="16" class="spinner">Upload in progress&hellip; <div id="upload_additional_info"></div></div>
		<div id="upload_infobar" class="upload_infobar"></div>

		<p id="upload_form_container">
			<input id="uploader" name="userfile" type="file" class="jbFileBox" onChange="document.upl.submit(); jbImagesDialog.inProgress();">
		</p>

		<!-- <p id="the_plugin_name"><a href="http://justboil.me/" target="_blank" title="JustBoil.me &mdash; a TinyMCE Images Upload Plugin">JustBoil.me Plugin</a></p> -->

	</form>

	<iframe id="upload_target" name="upload_target" src="<?=$target_url?>uploader/blank"></iframe>

</body>
</html>