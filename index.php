<?php 
include('inc/header.php');
include"config.php";
if(!isset($_SESSION['id'])){
    header('Location: login.php');
}
 ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />


    <title>WurkBee</title>
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta content="" name="keywords">
  <meta content="" name="description">


<link href="vk.png" rel="icon">
<link rel="icon" type="image/x-icon" href="vk.png">
  <link href="vk.png" rel="apple-touch-icon">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">  
    <script src="https://unpkg.com/feather-icons@4.28.0/dist/feather.min.js"></script>
  </head>
  <body>
  <nav>
      <input type="checkbox" id="check">
      <label for="check" class="checkbtn">
        <i class="fa fa-bars"></i>
      </label>
      <label class="logo">WurkBee</label>
      <ul>
        <li><a class="active" href="#">Home</a></li>
        <li><a href="profile.php?id=<?php echo $login_username; ?>">My profile</a></li>
        <li><a href="logout.php">Logout</a></li>
      </ul>
    </nav>
    <div class="container">
    <div class="row">
    		<div class="col-lg-6 col-lg-offset-3 col-md-8 col-md-offset-2 col-sm-8 col-sm-offset-2 col-xs-12">
    			<div class="card-form">
	<div class="row">
	<div class="col-lg-12 form-group">
	<?php if($login_type == 'employer') {?>
    <h2 class="text-center heading">Employeer Account Search for workers</h2>
    <form action="" method="POST">
	<div class="row">
			<div class="col-lg-8 col-lg-offset-2">
			<input type="number"class="form-control" pattern="/^-?\d+\.?\d*$/" name="pincode" id="pincode" placeholder="Pincode *" onKeyPress="if(this.value.length == 6) return false;" autocomplete="off" />
		</div><br/><br/>
			<div class="col-lg-8 col-lg-offset-2">
			<input type="search" name="search" id="search" placeholder="* Cashier, Accountant and etc..." class="form-control">
			</div><br/><br/>
			<div class="col-lg-6 col-lg-offset-3">
			<input type="submit" name="submit" class="btn btn-login w-25 btn-readOnly" value="Search">
			</div>
		</div>
    </form>

  <?php } 

  ?>




<?php if($login_type == 'employee') {?>
  <h6 class="text-center heading">Employee Account Search for job</h6>
    <form action="" method="POST">
		
		<div class="row">
			<div class="col-lg-8 col-lg-offset-2">
			<input type="number"class="form-control" pattern="/^-?\d+\.?\d*$/" name="pincode" id="pincode" placeholder="Pincode *" onKeyPress="if(this.value.length == 6) return false;" autocomplete="off" />
		</div><br/><br/>
			<div class="col-lg-8 col-lg-offset-2">
			<input type="search" name="search" id="search" placeholder="* Cashier, Accountant and etc..." class="form-control">
			</div><br/><br/>
			<div class="col-lg-6 col-lg-offset-3">
			<input type="submit" name="submit" class="btn btn-login w-25 btn-readOnly" value="Search">
			</div>
		</div>
	  
    </form>

  <?php } 
  ?>
	</div>
	</div>
</div>
  </div>
  <div class="col-lg-6 col-lg-offset-3 col-md-8 col-md-offset-2 col-sm-8 col-sm-offset-2 col-xs-12">
    				<div class="card-form" style="height:80vh;overflow-x: scroll;">
    					<?php
    						if(isset($_POST['submit_employee'])){
  $pincode = $_POST['pincode'];
  $search = $_POST['search'];
$query = mysqli_query($con, "SELECT * FROM users WHERE employee_status='1'");
$slno=1;
while($query_fetch = mysqli_fetch_array($query)){

$employee_id = $query_fetch['id'];
$full_name = $query_fetch['full_name'];
$ph_num = $query_fetch['ph_num'];
$username = $query_fetch['username'];
$employee_query = mysqli_query($con, "SELECT * FROM employee WHERE user_id='$employee_id' AND pincode='$pincode' AND work_type='$search'");

$employee_fetch = mysqli_fetch_array($employee_query);


if(mysqli_num_rows($employee_query) >0){
$image = $employee_fetch['images'];
$work_type=$employee_fetch['work_type'];
$employee_pincode=$employee_fetch['pincode'];
?>

<div class="card-form">
	<div class="row text-primary">
			<div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
				<?php echo "$slno"; ?><a href="profile.php?id=<?php echo$username ?>">
			</div>
			<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
				<img width="100%" style="border-radius:50%" src="images/<?php echo"$image"; ?>">
			</div>
			<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
				<?php echo "$full_name"; ?>
			</div>	
	</div>
	<div class="row text-primary">
		<div class="col-lg-12">
				<p><?php echo "$work_type"; ?></p>
			</div>
			<div class="col-lg-12">
			<a href="tel:<?php echo "$ph_num"; ?>">Call</a>
			</div>
	</div>
</div>
<div>
</a>
</div>
<hr>
<?php
$slno++;
}

}

}
    					?>
    					<?php
    					if(isset($_POST['submit'])){
  $pincode = $_POST['pincode'];
  $search = $_POST['search'];
$query = mysqli_query($con, "SELECT * FROM users WHERE employer_status='1'");
$slno=1;
while($query_fetch = mysqli_fetch_array($query)){

$employer_id = $query_fetch['id'];
$full_name = $query_fetch['full_name'];
$ph_num = $query_fetch['ph_num'];
$username = $query_fetch['username'];
$employer_query = mysqli_query($con, "SELECT * FROM employer WHERE user_id='$employer_id' AND pincode='$pincode' AND work_type='$search'");

$employer_fetch = mysqli_fetch_array($employer_query);


if(mysqli_num_rows($employer_query) >0){
$image = $employer_fetch['images'];
$work_type=$employer_fetch['work_type'];
$employer_pincode=$employer_fetch['pincode'];
?>
<div class="card-form">
	<div class="row text-primary">
			<div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
				<?php echo "$slno"; ?><a href="profile.php?id=<?php echo$username ?>">
			</div>
			<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
				<img width="100%" style="border-radius:50%" src="images/<?php echo"$image"; ?>">
			</div>
			<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
				<?php echo "$full_name"; ?>
			</div>	
	</div>
	<div class="row text-primary">
		<div class="col-lg-12">
				<p><?php echo "$work_type"; ?></p>
			</div>
			<div class="col-lg-12">
			<a href="tel:<?php echo "$ph_num"; ?>">Call</a>
			</div>
	</div>
</div>
<hr>
<?php
$slno++;
}

}

}
    					?>
    				</div>
    		</div>
    </div>
  </div>
	</body>

</html>
<script>
   $(document).ready(function() {
    
        $("#search,#pincode").keypress(function(){
            var pincode = $("#pincode").val();
            var search = $("#search").val();
           
            if(search != "" && pincode != "")
            {
                $(".btn-login").removeClass("btn-readOnly");
            }
            else
            {
              $(".btn-login").addClass("btn-readOnly");
            }
        });
		 window.addEventListener("keydown", function(e){
                if(e.keyCode === 8 && document.activeElement !== 'text') {
                    $(".btn-login").addClass("btn-readOnly");
                }
			});
});
</script>
