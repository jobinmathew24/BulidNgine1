<?php
session_start();
if(!isset($_SESSION['loginid']) or !$_SESSION['user']=='user') {
  header('location: login.php');
}

//index.php

include('database_connection.php');

if (isset($_POST['add'])) {
// die("WORKING");
$name=$_POST['result'];
// echo "$name";
$sql="select price,socket from mothertbl where name='$name'";
// echo "$sql";
$con=mysqli_connect("localhost","root","","bulid") or die("connection moonchi");
$result=mysqli_query($con,$sql)or die("query moonchi");
$rows=mysqli_fetch_array($result);
  $price=$rows['price'];
  $socket=$rows['socket'];

$id=$_SESSION['loginid'];
$_SESSION['socket']=$socket;
$sql="insert into ordertbl (loginid, name, category, price, qty, total) VALUES ('$id','$name','Motherboard', $price,1,$price*1)";
// echo $sql;
$result=mysqli_query($con,$sql)or die("query moonchi");
header('location: cpu.php');
} else {

?><!DOCTYPE html>
<html lang="en">

<head>

    <title>Motherboard</title>

    <script src="js/jquery-1.10.2.min.js"></script>
    <script src="js/jquery-ui.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href = "css/jquery-ui.css" rel = "stylesheet">
    <!-- Custom CSS -->
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
  <script type="text/javascript">
  function one(a) {

  document.getElementById('resulte').value=a;
   // document.getElementById("forme").submit();
  }
  </script>

    <!-- Page Content -->
    <div class="container">
        <div class="row">
        	<br />
        	<h2 align="center">Select the Motherboard</h2>
        	<br />
          <form id="forme" action="Motherboard.php" method="post">
              <input type="hidden" name="result" id="resulte">

            <div class="col-md-3">
				<div class="list-group">
					<h3>Price</h3>
					<input type="hidden" id="hidden_minimum_price" value="2850" />
                    <input type="hidden" id="hidden_maximum_price" value="46000" />


                    <p id="price_show">2850 - 46000</p>
                    <div id="price_range"></div>
                </div>
                <div class="list-group">
					<h3>Brand</h3>
                    <div style="height: 180px; overflow-y: auto; overflow-x: hidden;">
					<?php

                    $query = "select distinct(`company`) from `mothertbl` order by `company` desc";
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
                </div>
                <div class="list-group">
          <h3>Purpose</h3>
                    <div style="height: 180px; overflow-y: auto; overflow-x: hidden;">
          <?php

                    $query = "select distinct(`purpose`) from `mothertbl` order by `purpose` desc";
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
                </div>

				<div class="list-group">
					<h3>Socket</h3>
                      <div style="height: 180px; overflow-y: auto; overflow-x: hidden;">
                    <?php

                    $query = "select distinct(`socket`) from `mothertbl` order by `socket` desc";
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
                  </div>
                <div class="list-group">
                  <h3>Ram Type</h3>
                                <div style="height: 180px; overflow-y: auto; overflow-x: hidden;">
                            <?php

                            $query = "select distinct(`ram_type`) from `mothertbl` order by `ram_type` desc";
                            $statement = $connect->prepare($query);
                            $statement->execute();
                            $result = $statement->fetchAll();
                            foreach($result as $row)
                            {
                            ?>
                            <div class="list-group-item checkbox">
                                <label><input type="checkbox" class="common_selector ram_type" value="<?php echo $row['ram_type']; ?>" > <?php echo $row['ram_type']; ?> </label>
                            </div>
                            <?php
                            }

                            ?>
                        </div>
                        </div>
                        <div class="list-group">
                          <h3>Max RAM</h3>
                                        <div style="height: 180px; overflow-y: auto; overflow-x: hidden;">
                                    <?php

                                    $query = "select distinct(`max_ram`) from `mothertbl` order by `max_ram` desc";
                                    $statement = $connect->prepare($query);
                                    $statement->execute();
                                    $result = $statement->fetchAll();
                                    foreach($result as $row)
                                    {
                                    ?>
                                    <div class="list-group-item checkbox">
                                        <label><input type="checkbox" class="common_selector max_ram" value="<?php echo $row['max_ram']; ?>" > <?php echo $row['max_ram']; ?> GB</label>
                                    </div>
                                    <?php
                                    }

                                    ?>
                                </div>
                                </div>
				<div class="list-group">
					<h3>M.2 Support</h3>
                              <div style="height: 180px; overflow-y: auto; overflow-x: hidden;">
					<?php
                    $query = "select distinct(`m2_count`) from `mothertbl` order by `m2_count` desc";
                    $statement = $connect->prepare($query);
                    $statement->execute();
                    $result = $statement->fetchAll();
                    foreach($result as $row)
                    {
                    ?>
                    <div class="list-group-item checkbox">
                        <label><input type="checkbox" class="common_selector m2_count" value="<?php echo $row['m2_count']; ?>"  > <?php echo $row['m2_count']; ?> Nos</label>
                      </div>
                    <?php
                    }
                    ?>
                </div>
                </div>
            </div>

            <div class="col-md-9">
            	<br />
                <div class="row filter_data">

                </div>
            </div>
          </form>
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
        var ram_type = get_filter('ram_type');
        var max_ram = get_filter('max_ram');
        var m2_count = get_filter('m2_count');
        $.ajax({
            url:"fetch_data_mother.php",
            method:"POST",
            data:{action:action, minimum_price:minimum_price, maximum_price:maximum_price, company:company, purpose:purpose, socket:socket, ram_type:ram_type, max_ram:max_ram,m2_count:m2_count },
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
        min:2850,
        max:46000,
        values:[2850, 46000],
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
</body>

</html>
<?php } ?>
