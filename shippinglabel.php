<?php
 session_start();
 include("header.php"); 


  if ( !is_logged_in() ) {
    header('location: index.php');
    die();
  }
 ?>

<div class="container">
<?php
	$weight = $_POST['weight'];
	$OrderId = $_GET['orderid'];


	$sql = "SELECT * FROM orders WHERE orderid='$OrderId'";
    $result = $conn->query($sql);

	while($row = $result->fetch_assoc()) {
		$labelhash = labelhash($OrderId, $weight);

		$results = api_query("https://vendor.Zazzle.com/v100/api.aspx?method=getshippinglabel&vendorid=$vendorid&orderid={$row['OrderId']}&weight=$weight&format=PNG&hash=$labelhash");

		$array = xml_to_string($results);

		$Carrier = $array["Result"]["ShippingInfo"]['Carrier'];
		$Method = $array["Result"]["ShippingInfo"]['Method'];
		$Tracking = $array["Result"]["ShippingInfo"]['TrackingNumber'];
		$Weight = $array["Result"]["ShippingInfo"]['Weight'];
		if (isset($array['Result']["ShippingInfo"]["ShippingDocuments"]["ShippingDocument"][0])) {
			$Url = $array["Result"]["ShippingInfo"]['ShippingDocuments']['ShippingDocument'][1]['Url'];
			$CommercialInvoice = $array["Result"]["ShippingInfo"]['ShippingDocuments']['ShippingDocument'][0]['Url'];
		} elseif (isset($array['Result']["ShippingInfo"]["ShippingDocuments"]["ShippingDocument"])) {
			$Url = $array["Result"]["ShippingInfo"]['ShippingDocuments']['ShippingDocument']['Url'];
			$CommercialInvoice = "";
		}


	      $sql = "UPDATE orders SET 
	      			Carrier = '{$Carrier}',
                    Method = '{$Method}',
                    Tracking = '{$Tracking}',
                    Weight = '{$Weight}',
                    SD_Url = '{$Url}',
                    CommercialInvoice = '{$CommercialInvoice}',
                    Status = 'SHIPPED'
                WHERE OrderId = '$OrderId'";

	      if ($conn->query($sql) === TRUE) {
	          
	      } else {
	          echo "Error: " . $sql . "<br>" . $conn->error;
	      }


		echo "<pre style='display:none;'>";
	    print_r($array);
	    echo "</pre>"; 

     	echo "
	    	<div class='row'>
				<div class='col-md-12 text-center'>
					<div class='col-md-12 innerWrap'>
						<h4>Print Shipping Label</h4>
						<a href='$Url' target='_blank' class='btn btn-primary' style='margin-right:10px'>Get Shipping Label</a>
			";

		if($CommercialInvoice == "") {
			echo "</div></div></div>";
		} else {

			echo "
							<h4>Commercial Invoice</h4>
							<a href='$CommercialInvoice' target='_blank' class='btn btn-primary' style='margin-right:10px'>Get Commercial Invoice</a>
						</div>
					</div>
					
				</div>
		    ";
		}

	    
	 }
?>
</div>
<a href="singleorder.php?orderid=<?php echo $OrderId;?>" class="btn btn-primary">View Order</a>

<div style="height:150px;"></div>

<?php include("footer.php"); ?>

