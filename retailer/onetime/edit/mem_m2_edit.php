<?php
session_start();
if(!isset($_SESSION['loginid']) or !$_SESSION['user']=='retailer') {
 header('location: ../../../login.php');
 }
 if (!isset($_SESSION['mem_m2_edit']))
 {
   header('location:../../onetime/mem_m2_one.php');
   }
 include('../../../database/connection.php');
 $id=$_SESSION['loginid'];
$mem_m2_name=$_SESSION['mem_m2_edit'];

  $sql2="select Count(*) from ordertbl where status=1 and save=0";
  // echo $sql2;

  $result1=mysqli_query($con,$sql2)or die("number query moonchi");
  $row=mysqli_fetch_array($result1);


  $sql="select distinct(`size`) from `memory_tbl` where verified =1 order by `size` desc";
  $sql_size=mysqli_query($con,$sql);

  $sql="select distinct(`form_factor`) from `memory_tbl` where verified =1 and type='SSD' order by `form_factor` desc";
  $sql_form_factor=mysqli_query($con,$sql);

  $sql="select distinct(`ssd_type`) from `memory_tbl` where verified =1 and type='SSD' order by `ssd_type` desc";
  $sql_ssd_type=mysqli_query($con,$sql);

  $sql3="select * from memory_tbl where name='$mem_m2_name'";
  $result_cab=mysqli_query($con,$sql3)or die("number query moonchi");
  $n=mysqli_num_rows($result_cab);
          if($n==0){
            header('location:../../onetime/mem_m2_one.php');
          }




// $loc="SELECT * FROM tbl_location WHERE is_delete=1";
// $result_loc=mysqli_query($con,$loc);
  $cart=$row['Count(*)'];
?>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>BulidNgine</title>
    <script src="../../../js/jquery-1.10.2.min.js"></script>
    <script src="../../../js/jquery-ui.js"></script>
    <script src="..././../js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="../../../css/bootstrap.min.css">
    <link rel="stylesheet" href="../../../css/top.css">
     <link rel="stylesheet" href="../css/11.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href = "../../../css/jquery-ui.css" rel = "stylesheet">
    <style media="screen">
    .container {
    width: 450px;
    }
    p{
    text-align: left;
    font-size: 15px;
    }
    </style>
  </head>
  <script type="text/javascript">
  function check() {
    var mem_type = document.getElementById('name').value;
          if (!mem_type) return;
          console.log("WORKING user TILL HERE");
          var ajax = new XMLHttpRequest();
          ajax.onreadystatechange = function(){
            if (this.readyState == 4 && this.status == 200 ){
              console.log(this.response); //helps SEE WHATS GOING ON in the php file;
              if(this.response=='TRUE'){
                  document.getElementById('nameid').innerHTML="SSD name is already entered";
                  document.getElementById('name').value="";
                  document.forms["memory_tbl"]["name"].focus();
              }
              else{
                  document.getElementById('nameid').innerHTML="";

              }
            }
          }
          ajax.open("GET", "checkmother.php?mem_type="+mem_type, true);
          ajax.send();

}

  </script>
    <?php
  include('../../../php/retailer_edit_header.php');
   ?>
  <center>
    <div class="container">
      <br>
<?php foreach($result_cab as $row){ ?>
      <form action="" method="post" name="memory_tbl" enctype="multipart/form-data" class="form-group-sm container"  >
        <h2 style="float: center;">New SSD Memory</h2 >
          <hr>
          <h6>Try to use accurate data</h6>
          <h6>(Try using <strong>CAPITAL</strong> letters)</h6>
        <hr>
        <p>SSD Name</p>
        <input type="text" class="form-control" style="width:450px;" required onchange="check()" placeholder="SSD Name" name="name" id="name" value="<?php echo $row['name']; ?>"><br>
        <span id='nameid'></span>
        <p>SSD Company</p>
        <input type="text" class="form-control" style="width:450px;" required  placeholder="SSD company" name="company"  value="<?php echo $row['company']; ?>"><br>
        <p>SSD Size</p>
        <select class="form-control" type="button" style="width:450px;" name="size" required>

                      <option value="<?php echo $row['size']; ?>"><?php echo $row['size']; ?>Gb</option>
                        <?php

                           while($data_ram=mysqli_fetch_array($sql_size ))
                           {
                               echo "<option value='".$data_ram['size']."'>" .$data_ram['size'] ." Gb</option>";
                           }
                            ?>

        </select><br>
        <p>SSD Form Factor</p>
        <select class="form-control" type="button" style="width:450px;" name="form_factor" required>

                      <option value="<?php echo $row['form_factor']; ?>"><?php echo $row['form_factor']; ?></option>
                        <?php

                           while($data_ram=mysqli_fetch_array($sql_form_factor))
                           {
                               echo "<option value='".$data_ram['form_factor']."'>" .$data_ram['form_factor'] ." </option>";
                           }
                            ?>

        </select><br>
        <p>SSD Type</p>
        <select class="form-control" type="button" style="width:450px;" name="ssd_type" required>

                      <option value="<?php echo $row['ssd_type']; ?>"><?php echo $row['ssd_type']; ?></option>
                        <?php

                           while($data_ram=mysqli_fetch_array($sql_ssd_type))
                           {
                               echo "<option value='".$data_ram['ssd_type']."'>" .$data_ram['ssd_type'] ." </option>";
                           }
                            ?>

        </select><br>
        <p>SSD Price</p>
        <input type="number" class="form-control" style="width:450px;" required placeholder="SSD price" name="price" value="<?php echo $row['price']; ?>">
        <!-- Select image to upload: -->
        <br>
        <p>Choose the image </p>
        <input type="file" accept="image/jpeg" style="width:450px;" required class="form-control" name="image" id="file" value="">
        <br>
        <input type="submit" name="submit" class="btn btn-success" value="Submit">
        <input type="reset" name="reset" class="btn btn-danger" value="Reset">
        <hr>
        <br>
        <br>
      </form>
    </div>
  </center>
</body>
<?php
}
if(isset($_POST['submit'])){

  unset($_SESSION['mem_m2_edit']);
  $name=$_POST['name'];
  $company=$_POST['company'];
  $size=$_POST['size'];
  $form_factor=$_POST['form_factor'];
  $ssd_type=$_POST['ssd_type'];
  $price=$_POST['price'];
  $pic=$_FILES['image']['name'];

  $sql="update `memory_tbl` set `name`='$name', `company`='$company', `size`=$size, `form_factor`='$form_factor',
  `ssd_type`='$ssd_type', `price`=$price, `pic`='$name.jpg' where name='$mem_m2_name'";

// echo "$sql";
if($result1=mysqli_query($con,$sql)){
  $target_dir = "../../../project/mem/";
  $target_path=$target_dir.$name.".jpg";
  move_uploaded_file($_FILES['image']['tmp_name'],$target_path);
  echo "<script>alert('Data Sucessfully Updated');</script>";
  echo "<script>window.location.reload();</script>";
}
else {
  echo $sql ;
  // echo "<script>alert('Data not inserted');</script>";
}
}
include('../../../php/footer.php');
?>
</html>
