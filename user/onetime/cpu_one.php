<?php
session_start();
if(!isset($_SESSION['loginid']) or !$_SESSION['user']=='user') {
  header('location: ../../login.php');
}


include('../../database/connection.php');

$ide=$_SESSION['loginid'];

$sql2="select Count(*) from ordertbl where loginid='$ide' and status=1 and save=0 and buy=0";
// echo $sql2;

$result1=mysqli_query($con,$sql2)or die("number query moonchi");
$row=mysqli_fetch_array($result1);
$cart=$row['Count(*)'];

$sql3="select MIN(price) as min, MAX(price) as max from cpu_tbl where Verified =1 and status=1";
$result2=mysqli_query($con,$sql3)or die("price query moonchi");
$row=mysqli_fetch_array($result2);
$min=$row['min'];
$max=$row['max'];

if (isset($_POST['submit'])) {

$name=$_POST['result'];
// echo "$name";
$sql="select price from cpu_tbl where name='$name'";
// echo "$sql";


$result=mysqli_query($con,$sql)or die("query moonchi");
while ($rows=mysqli_fetch_array($result)) {
  $price=$rows['price'];
}
$sql="insert into ordertbl (loginid, name, category, price, qty, total) VALUES ('$ide','$name','CPU', $price,1,$price*1)";
// echo $sql;
$result=mysqli_query($con,$sql)or die("query moonchi");
  header('location: ../cart.php');
}
else {


?>

<!DOCTYPE html>
<html lang="en">

<head>

    <title>CPU</title>

    <script src="../../js/jquery-1.10.2.min.js"></script>
    <script src="../../js/jquery-ui.js"></script>
    <script src="../../js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="../../css/bootstrap.min.css">
    <link rel="stylesheet" href="../../css/top.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href = "../../css/jquery-ui.css" rel = "stylesheet">

</head>

<body>
  <?php
  include('../../php/pdts_header_one.php');
   ?>
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
        	<h2 align="center">Select the CPU</h2>
        	<h4 align="center">If you want to know how to choose a CPU, you need to consider cores and threads.
            Cores are like individual processors of their own, all packed together on the same chip. Traditionally,
            they can perform one task each at a time, meaning that more cores make a processor better at multitasking.
           </h4>

        	<br />
          <form id="forme" action="" method="post">
              <input type="hidden" name="result" id="resulte">

            <div class="col-md-3">
              <div class="list-group">
      					<h3>Price</h3>
      					<input type="hidden" id="hidden_minimum_price" value="<?php echo( $min) ?>" />
                          <input type="hidden" id="hidden_maximum_price" value="<?php echo( $max) ?>" />


                          <p id="price_show"><?php echo( $min) ?> - <?php echo( $max) ?></p>
                          <div id="price_range"></div>
                      </div>
                <div class="list-group">
					<h3>Brand</h3>
					<?php

                    $query = "select distinct(`company`) from `cpu_tbl` where Verified =1  order by `company` desc";
                    $statement = $connect->prepare($query);
                    $statement->execute();
                    $result = $statement->fetchAll();
                    foreach($result as $row)
                    {
                    ?>
                    <div class="list-group-item checkbox">
                        <label><input type="checkbox" class="common_selector company" value="<?php echo $row['company']; ?>"  > <?php echo $row['company']; ?></label>
                    </div>
                    <?php
                    }

                    ?>
                </div>
                <div class="list-group">
          <h3>Purpose</h3>
          <?php

                    $query = "select distinct(`purpose`) from `cpu_tbl` where Verified =1 order by `purpose` desc";
                    $statement = $connect->prepare($query);
                    $statement->execute();
                    $result = $statement->fetchAll();
                    foreach($result as $row)
                    {
                    ?>
                    <div class="list-group-item checkbox">
                        <label><input type="checkbox" class="common_selector purpose" value="<?php echo $row['purpose']; ?>"  > <?php echo $row['purpose']; ?></label>
                    </div>
                    <?php
                    }

                    ?>
                </div>
                <div class="list-group">
                  <h3>Socket</h3>
                            <?php

                            $query = "select distinct(`socket`) from `cpu_tbl` where Verified =1 order by `socket` desc";
                            $statement = $connect->prepare($query);
                            $statement->execute();
                            $result = $statement->fetchAll();
                            foreach($result as $row)
                            {
                            ?>
                            <div class="list-group-item checkbox">
                                <label><input type="checkbox" class="common_selector socket" value="<?php echo $row['socket']; ?>" > <?php echo $row['socket']; ?></label>
                            </div>

                            <?php
                            }

                            ?>
                          </div>
				<div class="list-group">
					<h3>Core Count</h3>
                    <?php

                    $query = "select distinct(`core_count`) from `cpu_tbl` where Verified =1  order by `core_count` desc";
                    $statement = $connect->prepare($query);
                    $statement->execute();
                    $result = $statement->fetchAll();
                    foreach($result as $row)
                    {
                    ?>
                    <div class="list-group-item checkbox">
                        <label><input type="checkbox" class="common_selector core" value="<?php echo $row['core_count']; ?>" > <?php echo $row['core_count']; ?> Nos</label>
                    </div>
                    <?php
                    }

                    ?>
                </div>

                        <div class="list-group">
                          <h3>GPU</h3>
                                    <?php

                                    $query = "select distinct(`igpu`) from `cpu_tbl` where Verified =1 order by `igpu` desc";
                                    $statement = $connect->prepare($query);
                                    $statement->execute();
                                    $result = $statement->fetchAll();
                                    foreach($result as $row)
                                    {
                                    ?>
                                    <div class="list-group-item checkbox">
                                        <label><input type="checkbox" class="common_selector igpu" value="<?php echo $row['igpu']; ?>" > <?php echo $row['igpu']; ?> </label>
                                    </div>
                                    <?php
                                    }

                                    ?>
                                </div>

            </div>

            <div class="col-md-9">
            	<br />
                <div class="row filter_data">

                </div>
            </div>
        </div>

    </div>
<style>
#loading
{
	text-align:center;
	background: url('loader1.gif') no-repeat center;
	height: 150px;
}
</style>

<script type="text/javascript">



$(document).ready(function(){

    filter_data();

    function filter_data()
    {
        $('.filter_data').html('<div id="loading" style="" ></div>');
        var action = 'fetch_data';
        var minimum_price = $('#hidden_minimum_price').val();
        var maximum_price = $('#hidden_maximum_price').val();
        var company = get_filter('company');
        var purpose = get_filter('purpose');
        var socket = get_filter('socket');
        var core = get_filter('core');
        var cache = get_filter('cache');
        var igpu = get_filter('igpu');
        // var m2_count = get_filter('m2_count');
        $.ajax({
            url:"fetch_data_cpu_one.php",
            method:"POST",
            data:{action:action, minimum_price:minimum_price, maximum_price:maximum_price, company:company, purpose:purpose, socket:socket, core:core, cache:cache, igpu:igpu },
            success:function(data){
                $('.filter_data').html(data);
            }
        });
    }

    function get_filter(class_name)
    {
        var filter = [];
        $('.'+class_name+':checked').each(function(){
            filter.push($(this).val());
        });
        return filter;
    }

    $('.common_selector').click(function(){
        filter_data();
    });

    $('#price_range').slider({
        range:true,
        min:<?php echo( $min) ?>,
        max:<?php echo( $max) ?>,
        values:[<?php echo( $min) ?>, <?php echo( $max) ?>],
        step:50,
        stop:function(event, ui)
        {
            $('#price_show').html(ui.values[0] + ' - ' + ui.values[1]);
            $('#hidden_minimum_price').val(ui.values[0]);
            $('#hidden_maximum_price').val(ui.values[1]);
            filter_data();
        }
    });

});
</script>
<?php
include('../../php/footer.php');
 ?>

</body>

</html>
<?php } ?>
