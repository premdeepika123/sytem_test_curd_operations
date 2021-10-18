<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Import excel data in database</title>
	<link rel="stylesheet" href="<?php echo base_url();?>assets/css/style.css">
	<link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap.min.css">
  <script src="<?php echo base_url();?>assets/js/jquery.min.js"></script>
  <script src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>
  <script src="<?php echo base_url();?>assets/js/script.js"></script>

</head>
<body>

  <center><h2 style="color: gray;">Excel Data Import in Mysql Table </h2></center>

  <?php if($this->session->flashdata('succmsg')!=''){ ?>
	<center><div class="alert alert-success" style="margin-top: 10px;">
    <?php echo $this->session->flashdata('succmsg'); ?>
    	
    </div></center> 
  <?php } ?>

 <?php if($this->session->flashdata('errmsg')!=''){ ?>
  <center><div class="alert alert-danger">
    <?php echo $this->session->flashdata('errmsg'); ?>
  </div></center>

 <?php } ?>


 <form method="post" class="file-uploader" action="<?php echo base_url('index.php/excel_data_import/import1/');?>" enctype="multipart/form-data">
  <div class="file-uploader__message-area">
    <p>Select a file to upload</p>
  </div>
  <div class="file-chooser">
    <input class="file-chooser__input" type="file" name="file_name">
  </div>
  <input class="file-uploader__submit-button btn-info" type="submit" value="Upload" name="submit" value="Submit">
</form>

</body>
</html>