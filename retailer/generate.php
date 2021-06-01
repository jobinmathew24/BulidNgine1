<?php
session_start();
$orderid=$_SESSION['orderid'];
$loginid=$_SESSION['loginid'];
require('invoice.php');
$our_company="BuildNgine Pvt Ltd.";
$con=mysqli_connect("localhost","root","","bulid") or die("connection moonchi");
$sql="select * from ordertbl where orderid=$orderid";
$result=mysqli_query($con,$sql);
$row=mysqli_fetch_array($result);

$order_date=$row['date'];

$our_phone=8590252557;
$order_number=$orderid;

$sql2="select * from user_login where loginid='$loginid'";
$result2=mysqli_query($con,$sql2);
$rows=mysqli_fetch_array($result2);

$file_name=$loginid;

$pdf = new PDF_Invoice( 'P', 'mm', 'A4' );
$pdf->AddPage();
$pdf->addSociete($our_company,"144/10,\n" ."Changanacherry, Kottayam - 686102,\nKerala , India\nPhone : ".$our_phone."\n");
$pdf->addDate( "Ordered Date : ".$order_date."\nOrder Number : ".$order_number."\n");
		// Set font
		$pdf->SetFont('Arial','B',18);
		// Move to 8 cm to the right
		$pdf->Cell(80);
		// Centred text in a framed 20*10 mm cell and line break
		$pdf->Cell(20,20,"Invoice",0,1,'C');
		$pdf->SetFont('Arial','B',12);
		// Move to 8 cm to the right
		$pdf->Cell(15);
		// Centred text in a framed 20*10 mm cell and line break
		$pdf->Cell(20,5,'Customer Information',0,1,'C');

    $billing_company=$rows['name'];
    $billing_address=$rows['address'];

		$state=$rows['state'];

		$statesql="select StateName from state where StCode=$state";
		$result7=mysqli_query($con,$statesql)or die($statesql);
		$state=mysqli_fetch_array($result7);
		$state=$state['StateName'];

    $billing_addr2=$rows['district'];
    $billing_city=$state;
    $billing_pin=686102;
    $billing_country="India";

    $pdf->addBillingAddr($billing_company."\n".$billing_address."\n".$billing_addr2."\n".$billing_city." - ".$billing_pin."\n".$billing_country);
    // 		$pdf->addShippingAddr($shipping_company."\n".$shipping_addr.$shipping_addr2."\n".$shipping_city." - ".$shipping_pin."\n".$shipping_country);
    		$cols=array( "Sno"    => 23,
    					 "Description"  => 78,
    					 "Qty"     => 22,
    					 "Rate/Unit (INR)"      => 26,
    					 "Amount (INR)" => 41);
    		$pdf->addCols( $cols);
    		$cols=array("Sno"    => "C",
    					 "Description"  => "C",
    					 "Qty"     => "C",
    					 "Rate/Unit (INR)"      => "C",
    					 "Amount (INR)" => "C");
    		$pdf->addLineFormat( $cols);
    		$pdf->addLineFormat($cols);
    		$y    = 100;
    		$sno = 1;
    		$decript_arry = $row['name'];
    		$quantity = $row['qty'];
    		$unit_cost = $row['price'];
    		$total_amount = $row['total'];

    			$line = array( "Sno"    => $sno,
                   "Description"  => $decript_arry,
                   "Qty"     => $quantity,
                   "Rate/Unit (INR)"      => $unit_cost,
                   "Amount (INR)" => $total_amount);
    			$size = $pdf->addLine( $y, $line );
    			$y   += $size + 4;
    			$sno++;
    		//
        $our_bank_name=" South Indian Bank,Changanacherry";
        $our_ifsc_code="SIBL00013";
        $our_banck_ac=60124100008521;
    		$bank_details = array("bank_name"=>$our_bank_name,"our_ifsc_code"=>$our_ifsc_code,"our_banck_ac"=>$our_banck_ac);

        $central_excise=1.5;
        $central_excise_rs=1.5;
        $freight=40;
        $sub_total=$row['total'];
        $final_amount=$sub_total+$freight+($sub_total*.015);

    		$sub_total_details = array("central_excise"=>$central_excise,"central_excise_rs"=>$central_excise_rs,"freight"=>$freight,"sub_total"=>$sub_total,"final_amount"=>$final_amount);
    		$pdf->addBanckDetails($bank_details);
    		$pdf->addSubTotals($sub_total_details);
				$time = time();
				$file_name .=$time.".pdf";
		$pdf->Output($file_name,'D');

 ?>