<html>
<head>
<title>Upload Form</title>
</head>
<body>

<?php echo $error;
	$sample1 = 2;
?>

<?php echo form_open_multipart('upload/do_upload/'.$sample1);?>

<input type="file" name="userfile" size="20" />

<br /><br />

<input type="submit" value="upload" />

</form>

</body>
</html>