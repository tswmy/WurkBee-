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


    <title></title>
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
  <?php include('menu.php'); ?>
  <div class="login-form">
				<h4 class="text-center">Select Your Profile</h4>
        <div class="row">
        <div class="col-lg-8 form-group">
      <form method="POST" action="">
          <select name="user_type"id="user_type" class="form-control">
          <option value="">Select one</option>
          <option value="employee">Employee</option>
          <option value="employer">Employer</option>
          </select>
			</div>
      <div class="col-lg-4 form-group">
      <input type="submit" name="submit" class="btn btn-login btn-readOnly" value="Go">
</form>
        </div>

      
</div>
</div>
</body>
</html>
<?php 
if(isset($_POST['submit'])){
    $user_type = $_POST['user_type'];

    
    if($user_type == 'employee'){
$query = mysqli_query($con, "UPDATE users SET login_type='$user_type', employee_status='1' WHERE id='$id' ");
    $query_validate = mysqli_query($con, "SELECT * FROM users WHERE id='$id'");
    $fetch_validate = mysqli_fetch_array($query_validate);
    $full_name = $fetch_validate['full_name'];

$query_validate1 = mysqli_query($con, "SELECT * FROM employee WHERE user_id='$id'");
    $fetch_validate1 = mysqli_fetch_array($query_validate1);
    $work_type = $fetch_validate1['work_type'];
    $pincode = $fetch_validate1['pincode'];
    if($full_name == NULL || $work_type == NULL || $pincode ==NULL){
header("Location: profile_update.php");
}
else{
  header("Location: index.php");
}
    }


    elseif($user_type == 'employer')
    {


$query = mysqli_query($con, "UPDATE users SET login_type='$user_type', employer_status='1' WHERE id='$id' ");
    $query_validate = mysqli_query($con, "SELECT * FROM users WHERE id='$id'");
    $fetch_validate = mysqli_fetch_array($query_validate);
    $full_name = $fetch_validate['full_name'];

$query_validate1 = mysqli_query($con, "SELECT * FROM employer WHERE user_id='$id'");
    $fetch_validate1 = mysqli_fetch_array($query_validate1);
    $work_type = $fetch_validate1['work_type'];
    $pincode = $fetch_validate1['pincode'];
    if($full_name == NULL || $work_type == NULL || $pincode ==NULL){
header("Location: profile_update.php");
}
else{
  header("Location: index.php");
}

    }


    else{
      if($user_type == 'employee'){
      $query = mysqli_query($con, "UPDATE users SET login_type='$user_type', employee_status='1' WHERE id='$id' ");
      }
      else{
        $query = mysqli_query($con, "UPDATE users SET login_type='$user_type', employer_status='1' WHERE id='$id' ");
      }
      header("Location: profile_update.php");

    }
}
    ?>
  <script>
   $( document ).ready(function() {
        $("#user_type").change(function(){
            var userType = $("#user_type").val();
            if(userType != "")
            {
                $(".btn-login").removeClass("btn-readOnly");
            }
            else
            {
              $(".btn-login").addClass("btn-readOnly");
            }
        });
});
</script>
