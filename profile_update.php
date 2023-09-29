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

  <nav>
      <input type="checkbox" id="check">
      <label for="check" class="checkbtn">
        <i class="fa fa-bars"></i>
      </label>
      <label class="logo">WurkBee</label>
      <ul>
        <li><a href="profile.php?id=<?php echo $login_username; ?>">My profile</a></li>
        <li><a class="active" href="profile_update.php">Edit profile</a></li>
        <li><a href="logout.php">Logout</a></li>
      </ul>
    </nav>
      <div class="login-form">
      <h4 class="text-center"><b style="text-transform: capitalize;"><?php echo $login_type ?></b> Account Update</h4>
    
    <?php if($login_type == 'employer') {?>
    <form action="" method="POST">
      <div class="row">
        <div class="col-lg-8 col-lg-offset-2">
            <input type="input" name="full_name_enter" id="full_name" class="form-control" placeholder="Full Name *" value="<?php echo$full_name; ?>">
        </div>
      </div><br/>
      <div class="row">
        <div class="col-lg-8 col-lg-offset-2">
            <input type="input" name="work_type_enter" id="work_type" class="form-control" placeholder="Work Type *" value="<?php echo$work_type_enter; ?>">
        </div>
      </div><br/>
      <div class="row">
        <div class="col-lg-8 col-lg-offset-2">
        <input type="number"class="form-control" pattern="/^-?\d+\.?\d*$/" name="pincode_enter" id="pincode" placeholder="Pincode *" onKeyPress="if(this.value.length == 6) return false;" value="<?php echo$pincode_enter; ?>" />	
        </div>
      </div><br/>
      <div class="row">
        <div class="col-lg-6 col-lg-offset-3 text-center">
           <input type="submit" name="submit_employer" class="btn btn-login btn-readOnly" value="Update">
        </div>
      </div>
    </form>

  <?php } 
if(isset($_POST['submit_employer'])){

  $full_name_enter = $_POST['full_name_enter'];
  $work_type_enter = $_POST['work_type_enter'];
  $pincode_enter = $_POST['pincode_enter'];
$query = mysqli_query($con, "UPDATE users SET full_name='$full_name_enter' WHERE id='$id' ");
$query2 = mysqli_query($con, "INSERT INTO employer(user_id, pincode, work_type) VALUES('$id','$pincode_enter','$work_type_enter')");
header("Location: index.php");

}
  ?>
<?php if($login_type == 'employee') {?>
  <form action="" method="POST">
      <div class="row">
        <div class="col-lg-8 col-lg-offset-2">
            <input type="input" name="full_name_enter" id="full_name" class="form-control" placeholder="Full Name *" value="<?php echo$full_name; ?>">
        </div>
      </div><br/>
      <div class="row">
        <div class="col-lg-8 col-lg-offset-2">
            <input type="input" name="work_type_enter" id="work_type" class="form-control" placeholder="Work Type *" value="<?php echo$work_type_enter; ?>">
        </div>
      </div><br/>
      <div class="row">
        <div class="col-lg-8 col-lg-offset-2">
        <input type="number"class="form-control" pattern="/^-?\d+\.?\d*$/" name="pincode_enter" id="pincode" placeholder="Pincode *" onKeyPress="if(this.value.length == 6) return false;" value="<?php echo$pincode_enter; ?>" />	
        </div>
      </div><br/>
      <div class="row">
        <div class="col-lg-6 col-lg-offset-3 text-center">
           <input type="submit" name="submit_employer" class="btn btn-login btn-readOnly" value="Update">
        </div>
      </div>
    </form>

    </div>
  <?php } 
if(isset($_POST['submit'])){
  $full_name_enter = $_POST['full_name_enter'];
  $work_type_enter = $_POST['work_type_enter'];
  $pincode_enter = $_POST['pincode_enter'];
$query = mysqli_query($con, "UPDATE users SET full_name='$full_name_enter' WHERE id='$id' ");
$query2 = mysqli_query($con, "INSERT INTO employee(user_id, pincode, work_type) VALUES('$id','$pincode_enter','$work_type_enter')");
header("Location: index.php");
}
  ?>
  </body>

</html>
<script>
   $(document).ready(function() {
    
        $("#full_name,#work_type,#pincode").keypress(function(){
            var full_name = $("#full_name").val();
            var worktype = $("#work_type").val();
            var pincode = $("#pincode").val();
           
            if(full_name != "" && worktype != "" && pincode != "")
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
