<!DOCTYPE html>
<html>
<head>
	<title>CRUD Application -View Users</title>
	<link href="<?php echo base_url();?>assets/css/bootstrap.min.css "  rel="stylesheet">
	<script src="<?php echo base_url();?>assets/js/jquery.js"></script>

	<script src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>
</head>
<body>
<h3><center><font color="blue">Import excel  data to database</font></center> </h3>
	<div class ="navbar  navbar-dark bg-dark">
		<div class ="container">

			<a href ="#" class="navbar-brand">CRUD APPLICATION </a>
	</div>
</div>

<div class="container"  style="padding-top: 10px;">


	<div class="row">
		<div class="col-md-10">
			<?php
			$success=$this->session->userdata('success');
			if($success != ""){
				?>
			
			<div class ="alert alert-success"><?php echo $success;?></div>
			<?php
		}
		?>
		<?php
			$failure=$this->session->userdata('failure');
			if($failure != ""){
				?>
			
			<div class ="alert alert-success"><?php echo $failure;?></div>
			<?php
		}
		?>
	</div>
</div> 
	<div class="row">
		<div class ="col-md-10">
			<div class="row">
				<div class="col-6" ><h2> View Users</h2></div>
				<div class="col-6 	text-right">
				<a href="<?php echo base_url().'index.php/user_excel_import/create';?>"class ="btn btn-primary">Create</a>	 	
			</div>
		</div>
		<hr>
	</div>
</div>
	
	<div class="row">
		<div class ="col-md-8">
		<table class="table table-striped">
			<tr>
				<th>ID</th>
				<th>Username </th>
				<th>Email</th>
				<th>Address</th>
				<th>Gender</th>
				<th>Qualification</th>
				<th width="100">Edit</th>
				<th width="100">Delete</th>
			</tr>
			
			<?php if(!empty($users)) {foreach($users as $user){?>
			<tr>
				<td> <?php echo $user["id"]?></td>
				<td> <?php echo $user["username"]?></td>
				<td> <?php echo $user["email_id"]?></td>
				<td> <?php echo $user["address"]?></td>
				<td> <?php echo $user["gender"]?></td>
				<td> <?php echo $user["qualification"]?></td>
				<td>
					<a href ="<?php echo base_url().'index.php/user_excel_import/edit/'.$user['id']?>" class="btn btn-primary">Edit</a>
				</td>
				<td>
					<a href ="<?php echo base_url().'index.php/user_excel_import/delete/'.$user['id']?>" class="btn btn-primary">Delete</a>
				</td>


			</tr>
		<?php   } } else {?>
		<tr>
			<td colspan ="5">Records not found</td>
		</tr>
		<?php }?>
	</table>
		</div>
</div>
</div>









</body>
</html>
