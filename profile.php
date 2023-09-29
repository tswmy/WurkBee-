<?php 
include"config.php";
include('inc/header.php');
if(!isset($_SESSION['id'])){
    header('Location: login.php');
}
if(isset($_GET['id']))
{
    $username = $_GET['id'];
}
 ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />


    <title>Wurkbee</title>
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
        <li><a href="index.php">Home</a></li>
        <li><a class="active" href="select_page.php">Switch Profile</a></li>
        <li><a href="profile_update.php">Edit profile</a></li>
        <li><a href="logout.php">Logout</a></li>
      </ul>
    </nav>
<?php 

$query = mysqli_query($con, "SELECT * FROM users WHERE username='$username'");
$query_fetch = mysqli_fetch_array($query);
$user_id = $query_fetch['id'];
$full_name = $query_fetch['full_name'];
$ph_num = $query_fetch['ph_num'];


if($login_username == $username){
  if($login_type == 'employer'){
?>

<div class="login-form">
    <div class="row">
<h4 class="text-center">Business Owner</h4>
<hr/>
<?php
    $employer_query = mysqli_query($con, "SELECT * FROM employer WHERE user_id='$user_id'");

$employer_fetch = mysqli_fetch_array($employer_query);
$image = $employer_fetch['images'];
$work_type=$employer_fetch['work_type'];
$employer_pincode=$employer_fetch['pincode'];
if($image == "")
{
  $image = "1.jpg";
}
  ?>
   <div class="col-lg-12 text-danger">
        <div class="row">
          <div class="col-lg-4">
            <img style="width:100%;" src="images/<?php echo"$image"; ?>"/>
          </div>
          <div class="col-lg-8">
            <h5><b><?php echo "$full_name"; ?></b></h5>
          </div>
        </div>
          <p>I am:&nbsp;<?php echo "$work_type"; ?></p>
          <p>My Pincode:&nbsp;<?php echo "$employer_pincode"; ?></p>
      </div>
</div>
</div>
  <?php }
  else{
    ?>
<div class="login-form">
    <div class="row">
    <h4 class="text-center">Job seeker</h4>
    <hr/>
    <?php
    $employee_query = mysqli_query($con, "SELECT * FROM employee WHERE user_id='$user_id'");

$employee_fetch = mysqli_fetch_array($employee_query);
$image = $employee_fetch['images'];
$work_type=$employee_fetch['work_type'];
$employee_pincode=$employee_fetch['pincode'];
if($image == "")
{
  $image = "1.jpg";
}
?>
      <div class="col-lg-12 text-danger">
        <div class="row">
          <div class="col-lg-4">
            <img style="width:100%;"class="prof-img-width" src="images/<?php echo"$image"; ?>"/>
          </div>
          <div class="col-lg-8">
            <h5><b><?php echo "$full_name"; ?></b></h5>
          </div>
        </div>
          <p>I am:&nbsp;<?php echo "$work_type"; ?></p>
          <p>My Pincode:&nbsp;<?php echo "$employee_pincode"; ?></p>
      </div>
    </div>
  </div>
    <div>
<div>
</div>
<?php 
}
}
else{
  if($login_type=='employee'){
$employer_query = mysqli_query($con, "SELECT * FROM employer WHERE user_id='$user_id'");

$employer_fetch = mysqli_fetch_array($employer_query);
$image = $employer_fetch['images'];
$work_type=$employer_fetch['work_type'];
$employer_pincode=$employer_fetch['pincode'];


 ?>
 <div><h2>Business Owner</h2>

<img width="5%" style="border-radius:50%" src="images/<?php echo"$image"; ?>">
<?php echo "$full_name"; ?>

<p>Looging for: <?php echo "$work_type"; ?></p>
<a href="tel:<?php echo "$ph_num"; ?>">Call</a>

</div><br>
<?php }
else{
  ?>
  <div class="login-form">
    <div class="row">
    <h4 class="text-center">Job seeker</h4>
    <hr/>
    <?php
    $employee_query = mysqli_query($con, "SELECT * FROM employee WHERE user_id='$user_id'");

$employee_fetch = mysqli_fetch_array($employee_query);
$image = $employee_fetch['images'];
$work_type=$employee_fetch['work_type'];
$employee_pincode=$employee_fetch['pincode'];
if($image == "")
{
  $image = "1.jpg";
}
?>
      <div class="col-lg-12 text-danger">
        <div class="row">
          <div class="col-lg-4">
            <img style="width:100%;" class="prof-img-width" src="images/<?php echo"$image"; ?>"/>
          </div>
          <div class="col-lg-8">
            <h5><b><?php echo "$full_name"; ?></b></h5>
          </div>
        </div>
            <p><?php echo "$work_type"; ?></p>
  <a href="tel:<?php echo "$ph_num"; ?>">Call</a>
      </div>
    </div>
  </div>
<?php 
}
} ?>
  </body>

</html>
<script>
</script>
