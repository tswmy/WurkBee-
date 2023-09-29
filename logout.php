<?php 

include "config.php";

if(isset($_SESSION['id'])){
	// Delete token 
   

    // Destroy session
    session_destroy();
    header('Location: login.php');
}else{
	header('Location: login.php');
}
ob_end_flush();
?>