<?php

//fetch_data.php

include('../database/connection.php');

if(isset($_POST["action"]))
{
	$query = "
		SELECT * FROM prebuilt_tbl where status=1
	";
	if(isset($_POST["minimum_price"], $_POST["maximum_price"]) && !empty($_POST["minimum_price"]) && !empty($_POST["maximum_price"]))
	{
		$query .= "
		 AND price BETWEEN '".$_POST["minimum_price"]."' AND '".$_POST["maximum_price"]."'
		";
	}
	if(isset($_POST["loginid"]))
	{
		$loginid_filter = implode("','", $_POST["loginid"]);
		$query .= "
		 AND loginid IN('".$loginid_filter."')
		";
	}
	if(isset($_POST["category"]))
	{
		$category_filter = implode("','", $_POST["category"]);
		$query .= "
		 AND category IN('".$category_filter."')
		";
	}

	if(isset($_POST["ram_type"]))
	{
		$ram_filter = implode("','", $_POST["ram_type"]);
		$query .= "
		 AND ram_type IN('".$ram_filter."')
		";
	}
	if(isset($_POST["ram_size"]))
	{
		$max_filter = implode("','", $_POST["ram_size"]);
		$query .= "
		 AND ram_size IN('".$max_filter."')
		";
	}

	$query .= "order by `price` ";
	$statement = $connect->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$total_row = $statement->rowCount();
	$output = '';
	if($total_row > 0)
	{
		foreach($result as $row)
		{
			$output .= '
			<a href="bulid.php?id='.$row['prebuilt_id'].'">
			<div class="col-sm-12 col-lg-12 col-md-12">

				<div style="border:1px solid #ccc; border-radius:5px; padding:16px; margin-bottom:16px; height:auto;">
					<img  style="float:left; padding:5px;"src="../project/cabinet/'.  $row['cabinet'] .'.jpg " width="100px" height="100px"  >

					<div style="float: left;">
						<h4><strong>'.$row['name'].'</strong></h4>

						</div>
				<table  >



					<tr ><td ><strong> Category</strong></td><td > : '. $row['category'] .'</td></tr>
					<tr ><td ><strong> Price</strong></td><td > : ₹ '. $row['price'] .'</td></tr>
					<tr><td ><strong> Created By</strong></td><td > : '. $row['loginid'] .'</td></tr>
				<tr>
					<h4  style="text-align:right;" class="text-danger" >₹ '. $row['price'] .'</h4>
					<br><br><br><br><br>
				</tr>

				</table>


				</div>

			</div>
			</a>
			';
		}
	}
	else
	{
		// echo "$query";
		$output = '<h3>No Data Found</h3>';
	}

	echo $output;
	// echo $query;
}

?>
