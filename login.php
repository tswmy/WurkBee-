<?php
include('inc/header.php');
include "config.php";
?>
<div class="bgimage">
<br/><br/><br/>
<div class="row">
    <div class="col-lg-12 logo-head">
        <h1>WurkBee</h1>
    </div>
</div>
<form method="POST" action="">
		<div class="row login-page">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
				<h1 class="text-center">Login</h1>
			</div>
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
            <input type="number"class="form-control" pattern="/^-?\d+\.?\d*$/" name="ph_num" id="ph_num" placeholder="Mobile Number *" onKeyPress="if(this.value.length==10) return false;" autocomplete="off" />
			</div>
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
			<input type="number"class="form-control" pattern="/^-?\d+\.?\d*$/" name="otp" id="otp" placeholder="OTP *" onKeyPress="if(this.value.length==6) return false;" autocomplete="off" />		
			</div>
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
			<input type="submit" name="submit" class="btn btn-login btn-readOnly" value="Login">	
            <p class="text-danger errormsgreg">Phone number or OTP is incorrect. Try again!</p>	
			</div>
            
        </div>
</form>

</div>        
	</div>
<?php include('inc/footer.php');?>

<?php 
if(isset($_POST['submit'])){
    $ph_num = $_POST['ph_num'];
    $otp = $_POST['otp'];
    if ($ph_num != "" && $otp != ""){
        $sql = "SELECT * FROM users WHERE ph_num=? AND otp=?";
        $stmt = mysqli_prepare($con, $sql);

        // Bind the parameters
        mysqli_stmt_bind_param($stmt, "ss", $ph_num, $otp);

        // Execute the statement
        mysqli_stmt_execute($stmt);

        // Get the results
        $result = mysqli_stmt_get_result($stmt);
$query12345 = mysqli_query($con, "SELECT * FROM users WHERE ph_num='$ph_num'");
        // Check if there is a matching user
        if (mysqli_num_rows($result) > 0) {
            // User found
            $fetch = mysqli_fetch_array($result);
            $_SESSION['id'] = $fetch['id'];
            header('Location: select_page.php');
        }
        elseif (mysqli_num_rows($query12345) == 0) {
            // User found
          function random_strings($length_of_string)
{
 
    // String of all alphanumeric character
    $str_result = '0123456789abcdefghijklmnopqrstuvwxyz';
 
    // Shuffle the $str_result and returns substring
    // of specified length
    return substr(str_shuffle($str_result),
                       0, $length_of_string);
}
 
// This function will generate
// Random string of length 10
$username = random_strings(10);
$query = "INSERT INTO users(ph_num, otp, username) VALUES($ph_num, $otp, '$username')";
$count = mysqli_num_rows($query);
if ($con->query($query) === TRUE) {
    // Get the ID of the last inserted row
    $lastInsertedID = $con->insert_id;

$_SESSION['id'] = $lastInsertedID;
}
            header('Location: select_page.php');
            echo $count;
        }
        else {
            echo "<script type='text/javascript'>
                $('.errormsgreg').show();
            </script>";
        }

        mysqli_stmt_close($stmt);
        mysqli_close($con);
    }
}
?>
<script>
   $( document ).ready(function() {
        $("#otp,#ph_num").keypress(function(e){
            var otp = $("#otp").val();
            var ph_num = $("#ph_num").val();
            if(otp.length >= 5 && ph_num.length >= 9)
            {
                $(".btn-login").removeClass("btn-readOnly");
            }
        });
        window.addEventListener("keydown", function(e){
                if(e.keyCode === 8 && document.activeElement !== 'text') {
                    $(".btn-login").addClass("btn-readOnly");
                }
});
});
</script>