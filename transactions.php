<?php 
include"config.php";
if(!isset($_SESSION['id'])){
    header('Location: login.php');
}
 ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />


    <title>Vishwa Keshav</title>
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
    <form method="POST" action="">
<label>Transaction Type</label>
<select name="tran_type">
    <option value="">Select 1</option>
    <option value="all">ALL</option>
    <option value="withdraw">Withdraw</option>
    <option value="deposit">Deposit</option>
      </select><br><br>
      <label>All Date</label>
      <select name="all_date">
    <option value="">Select date</option>
    <option value="all_date_selected">All Date</option>
      </select><br><br>
      <label>Specific Date</label>
      <input type="date" name="select_date"><br><br>
      <input type="submit" name="submit"><br><br>
    </form>

<hr>

<form method="POST" action="">
<label>Transaction Type</label>
<select name="tran_type">
    <option value="">Select 1</option>
    <option value="all">ALL</option>
    <option value="withdraw">Withdraw</option>
    <option value="deposit">Deposit</option>
      </select><br><br>
      <label>From Date</label>
      <input type="date" name="from_date"><br><br>
      <label>To Date</label>
      <input type="date" name="to_date"><br><br>
      <input type="submit" name="submit123"><br><br>
    </form>

<hr>
    <?php if (isset($_POST['submit'])) { 

    $tran_type = $_POST['tran_type'];
    $select_date = $_POST['select_date'];
    

      ?>
<table>
  <table border="1">
    <thead>
        <tr>
            <th>Sl. No</th>
            <th>Amount</th>
            <th>Transaction Type</th>
            <th>Date Added</th>
        </tr>
    </thead>
    <tbody>
      <?php 
      $sl_no=1;
      $total_amount=0;
      if($select_date == '' OR $select_date == 'NULL'){
      if($tran_type == 'all'){
$query = mysqli_query($con, "SELECT * FROM transactions");
$show = 'both Withdraw and Deposit';
}
else{
 $query = mysqli_query($con, "SELECT * FROM transactions WHERE tran_type='$tran_type' "); 
 $show = "only " .$tran_type;
}
}
else{
$select_date = date("Y-m-d", strtotime($select_date));
  if ($tran_type == 'all') {
    $query = mysqli_query($con, "SELECT * FROM transactions WHERE DATE_FORMAT(date_added, '%Y-%m-%d') = '$select_date'");
$show = 'both Withdraw and Deposit';
} else {
    $query = mysqli_query($con, "SELECT * FROM transactions WHERE tran_type='$tran_type' AND DATE_FORMAT(date_added, '%Y-%m-%d') = '$select_date'");
    $show = "only " .$tran_type;
}
}
while ($fetch = mysqli_fetch_array($query)) {
$amount = $fetch['amount'];
$tran_type = $fetch['tran_type'];
$date_added = $fetch['date_added'];
$date_added = date("d-m-y", strtotime($date_added));



       ?>
        <tr>
            <td><?php echo "$sl_no"; ?></td>
            <td><?php echo "$amount"; ?></td>
            <td><?php echo "$tran_type"; ?></td>
            <td><?php echo "$date_added"; ?></td>
        </tr>
<?php $sl_no++;
if ($tran_type == "withdraw") {
        // If it's a "withdraw" transaction, add the amount to the total
        $total_amount += $amount;
    } else {
        // For other transaction types, subtract the amount from the total
        $total_amount -= $amount;
    }

} 

?>
        <!-- Add more rows here -->
    </tbody>
</table>

</table>
<?php


if($total_amount > 0){

$total_amount = moneyFormatIndia($total_amount);  

}
else{
   $total_amount = moneyFormatIndia1($total_amount);   
}

 echo"


Total Amount: ₹$total_amount"; ?>
    <br>
<?php 
if($select_date == '' OR $select_date == 'NULL'){
  echo "Showing All dates and transactions of $show";
}
else{
  $select_date1 = date("d-m-Y", strtotime($select_date));
echo "Only Showing date of $select_date1 and transactions of $show";
}

} ?>










<?php if (isset($_POST['submit123'])) { 

    $tran_type = $_POST['tran_type'];
    $from_date = $_POST['from_date'];
    $from_date = date("Y-m-d", strtotime($from_date));
    $to_date = $_POST['to_date'];
    $to_date = date("Y-m-d", strtotime($to_date));
    

      ?>
<table>
  <table border="1">
    <thead>
        <tr>
            <th>Sl. No</th>
            <th>Amount</th>
            <th>Transaction Type</th>
            <th>Date Added</th>
        </tr>
    </thead>
    <tbody>
      <?php 
      $sl_no=1;
      $total_amount=0;

      if($tran_type == 'all'){
$query = mysqli_query($con, "SELECT * FROM transactions WHERE DATE_FORMAT(date_added, '%Y-%m-%d') BETWEEN '$from_date' AND '$to_date'");
$show = 'both Withdraw and Deposit';
}
else{
 $query = mysqli_query($con, "SELECT * FROM transactions WHERE tran_type='$tran_type' AND DATE_FORMAT(date_added, '%Y-%m-%d') BETWEEN '$from_date' AND '$to_date'"); 
 $show = "only " .$tran_type;
}


while ($fetch = mysqli_fetch_array($query)) {
$amount = $fetch['amount'];
$tran_type = $fetch['tran_type'];
$date_added = $fetch['date_added'];
$date_added = date("d-m-y", strtotime($date_added));



       ?>
        <tr>
            <td><?php echo "$sl_no"; ?></td>
            <td><?php echo "$amount"; ?></td>
            <td><?php echo "$tran_type"; ?></td>
            <td><?php echo "$date_added"; ?></td>
        </tr>
<?php $sl_no++;
if ($tran_type == "withdraw") {
        // If it's a "withdraw" transaction, add the amount to the total
        $total_amount += $amount;
    } else {
        // For other transaction types, subtract the amount from the total
        $total_amount -= $amount;
    }
} 

?>
        <!-- Add more rows here -->
    </tbody>
</table>

</table>
<?php




if($total_amount > 0){

$total_amount = moneyFormatIndia($total_amount);  

}
else{
   $total_amount = moneyFormatIndia1($total_amount);   
} 



 echo"


Total Amount: ₹$total_amount"; ?>
    <br>
<?php 

  $from_date1 = date("d-m-Y", strtotime($from_date));
  $to_date1 = date("d-m-Y", strtotime($to_date));
echo "Only Showing dates from $from_date1 to $to_date1 and transactions of $show";


} ?>

<br><br><br>



<a href="index.php">Home</a>
<br><br>
<a href="logout.php">Logout</a>
  </body>  
</html>

<?php 








 
  
function moneyFormatIndia($num){  
    $explrestunits = "" ;  
    if(strlen($num)>3){  
        $lastthree = substr($num, strlen($num)-3, strlen($num));  
        $restunits = substr($num, 0, strlen($num)-3); // extracts the last three digits  
        $restunits = (strlen($restunits)%2 == 1)?"0".$restunits:$restunits; // explodes the remaining digits in 2's formats, adds a zero in the beginning to maintain the 2's grouping.  
        $expunit = str_split($restunits, 2);  
        for($i=0; $i < sizeof($expunit);  $i++){  
            // creates each of the 2's group and adds a comma to the end  
            if($i==0)  
            {  
                $explrestunits .= (int)$expunit[$i].","; // if is first value , convert into integer  
            }else{  
                $explrestunits .= $expunit[$i].",";  
            }  
        }  
        $thecash = $explrestunits.$lastthree;  
    } else {  
        $thecash = $num;  
    }  


    return $thecash; // writes the final format where $currency is the currency symbol.  
}  


  ?>










  <?php 

function moneyFormatIndia1($num) {
    $formatted = number_format(abs($num), 0, '.', ',');

    // Add a minus sign for negative numbers
    if ($num < 0) {
        $formatted = '-' . $formatted;
    }

    return  str_replace(',', ',', $formatted);
}




   ?>