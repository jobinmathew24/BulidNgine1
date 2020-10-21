<?php
session_start();
if(!isset($_SESSION['loginid']) or !$_SESSION['user']=='user') {
  header('location: ../login.php');
}
include('../database/database_connection.php');

$ide=$_SESSION['loginid'];
$sql2="select Count(*) from ordertbl where loginid='$ide' and status=1";
$sql4="select sum(price) as total from ordertbl where loginid='$ide' and status=1";
// echo $sql2;
$con=mysqli_connect("localhost","root","","bulid") or die("connection moonchi");
$result1=mysqli_query($con,$sql2)or die("number query moonchi");
$result3=mysqli_query($con,$sql4)or die("number query moonchi");
$row=mysqli_fetch_array($result1);
$rows=mysqli_fetch_array($result3);
$cart=$row['Count(*)'];
$total=$rows['total'];
$sql3="select * from ordertbl where loginid='$ide' and status=1";
$result2=mysqli_query($con,$sql3)or die("number query moonchi");

if (isset($_POST['submite'])) {
$sql3="update ordertbl set status=0 where loginid='$ide' ";
$result2=mysqli_query($con,$sql3)or die("number query moonchi");
header('location:users.php');

}
if (isset($_POST['submit'])) {

$name=$_POST['result'];
// echo "$name";
// $sql="select price from cpu_fan_tbl where name='$name'";
// echo "$sql";

//
// $result=mysqli_query($con,$sql)or die("query moonchi");
// while ($rows=mysqli_fetch_array($result)) {
//   $price=$rows['price'];
// }
// $sql="insert into ordertbl (loginid, name, category, price, qty, total) VALUES ('$ide','$name','CPU FAN', $price,1,$price*1)";
// // echo $sql;
// $result=mysqli_query($con,$sql)or die("query moonchi");
// header('location:cabinet.php');
}
else {


?>

<!DOCTYPE html>
<html lang="en">

<head>

    <title>CART</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="../js/jquery-1.10.2.min.js"></script>
    <script src="../js/jquery-ui.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/top.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href = "../css/jquery-ui.css" rel = "stylesheet">
    <!-- Custom CSS -->
    <!-- <link href="../css/style.css" rel="stylesheet"> -->
</head>

<body>
  <div class="navbare">
  <a href="logout.php">Logout</a>
    <a href="cart.php"><i class="fa fa-shopping-cart"></i> CART <span class="numbe"><?php echo($cart)?></span></a>
  <div class="dropdowne">
    <button class="dropbtn">Buy a product
      <i class="fa fa-caret-down"></i>
    </button>
    <div class="dropdowne-content">
      <a href="motherboard_one.php">Motherboard</a>
      <a href="cpu_one.php">CPU</a>
      <a href="gpu_one.php">GPU</a>
      <a href="ram_one.php">RAM</a>
      <a href="mem_one.php">Memory</a>
      <a href="mem_m2_one.php">Memory M.2</a>
      <a href="smps_one.php">SMPS</a>
      <a href="cpu_fan_one.php">CPU Fan</a>
      <a href="cabinet_one.php">Cabinet</a>
    </div>
  </div>
  <a>welcome <?php echo($_SESSION['loginid'] )?></a>

        <a href="users.php">Home</a>
</div>

  <script type="text/javascript">
  function one(a) {

  document.getElementById('resulte').value=a;
  // alert(a);
  // document.getElementById("forme").submit();
  }
  </script>

    <!-- Page Content -->
    <div class="container">
        <div class="row">
        	<br />
        	<h2 align="center">Your CART</h2>
        	<br />
          <form id="forme" action="" method="post">
              <input type="hidden" name="result" id="resulte">


            <div class="col-md-8">
            	<br />
                <div class="row filter_data">
                <?php

                if ($cart>0) {
                 foreach($result2 as $row)
                		{?>
                    <div class="col-sm-12 col-lg-12 col-md-12">

              				<div style="border:1px solid #ccc; border-radius:5px; padding:16px; margin-bottom:16px; height:170px;">
              					<img  style="float:left;"src="../cart/<?php echo $row['name']  ?>.jpg " width="100px" height="100px" >

                        <div style="float: left;">
                          <h4><strong><?php echo $row['name'] ?></strong></h4>

                          </div>
                      <table  >


                        <tr ><td ><strong> Category</strong></td><td > : <?php echo $row['category'] ?></td></tr>
                        <tr ><td ><strong> Price</strong></td><td > : ₹ <?php echo $row['price'] ?></td></tr>
                        <tr><td ><strong> Quantity</strong></td><td > : <?php echo $row['qty'] ?></td></tr>
                      <tr>
                        <h4  style="text-align:right;" class="text-danger" >₹ <?php echo $row['total'] ?></h4>

                      </tr>

                      </table>
                      <div style="float: right;">
                        <i class="fa fa-shopping-cart"></i>
                        <input type="submit" name="submit" class="btn btn-primary" value="Purchase Now" onclick="one(\''.$row['name'].'\')">

                        </div>



              				</div>

              			</div>
                  <?php
                }
              }else {?>
              <center> <h3>No Data Found</h3></center>
            <?php  }
                ?>

                </div>
            </div>
            <div class="col-md-4">

              <div class="col-sm-12 col-lg-12 col-md-12">
                <br>
                <div style="border:1px solid #ccc; border-radius:5px; padding:16px; margin-bottom:16px; height:170px;">
                  <table>
                    <tr>
                      <td> <h4> <strong> Total Summary</strong> </h4></td>
                    </tr>
                    <tr>
                      <td> <strong>Total items </strong></td>
                      <td> <?php echo $cart ?></td>
                    </tr>
                    <tr>
                      <td> <strong>Total Price </strong></td>
                        <td> ₹ <?php echo $total ?></td>
                    </tr>
                  </table>
                  <br>
                  <div style="float: right;">
                    <i class="fa fa-shopping-cart"></i>
                    <input type="submit" name="submite" class="btn btn-primary" value="Purchase All" onclick="one(\''.$row['name'].'\')">

                    </div>
              </div>
              </div>

        </div>
      </form>

    </div>

</body>

</html>
<?php } ?>