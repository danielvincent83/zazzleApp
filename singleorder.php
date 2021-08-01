
<?php
 session_start();
 include("header.php"); 
 include("navigation.php"); 

  if ( !is_logged_in() ) {
    header('location: index.php');
    die();
  }
 ?>



<div class="container">

  <?php  
    if (isset($_POST['weight'])) {
      $weight = $_POST['weight'];
    }
    
    $OrderId = $_GET['orderid'];
    $sql = "SELECT * FROM orders WHERE orderid='$OrderId'";
    $result = $conn->query($sql);


    $weight = 0;

    while($row = $result->fetch_assoc()) {
      
      echo"
      <div class='wrapper col-md-12'>
        <div class='row' style='padding:1em; background:#ececec;'>
          <div class='col-md-6'>
            <h3>Order Information</h3>
            <strong>Order Id:</strong> {$row["OrderId"]} <br />
            <strong>Order Date:</strong> {$row["OrderDate"]} <br />

            <strong>Delivery Method:</strong> {$row["DeliveryMethod"]} <br />
            <strong>Priority:</strong> {$row["Priority"]} <br />


            <strong>Status:</strong> <span style='color:#ff0000;'><strong>{$row["Status"]}</strong></span> <br />
            <strong>Packing Slip:</strong> <br/><a href='{$row["PackingSheet_Url"]}' target='_blank' >Get Packing Slip</a> <br />";

            if($row["PackingSheet_Url2"] != "") {
              echo "<a href='{$row["PackingSheet_Url2"]}' target='_blank'>Packing Slip Pg(2)</a>"; 
            }
          echo"</div>
          <div class='col-md-6'>
            <h3>Customer Information</h3>
            {$row["Name"]}, {$row["Name2"]} <br /><br />
            <strong>Address:</strong>
            <br />{$row["Address1"]}, {$row["Address2"]}, {$row["Address3"]} <br />
            {$row["City"]}, {$row["State"]} {$row["Zip"]} <br />
            Country: {$row["Country"]}, {$row["CountryCode"]}<br />";
            if($row["SD_Url"] != "") {
              echo "<a href='{$row["SD_Url"]}' target='_blank' >Re-Print Label</a><br/><br/>";
              echo "<a href='voidshippinglabel.php?orderid=$OrderId' style='color:red;'>Void Shipping Label</a>";
            } else {
              echo "
                <form method='post' style='margin:0;' action='shippinglabel.php?orderid=$OrderId' id='weightform'>

                    
                      <input type='text' maxlength='2' required id='weight' name='weight' placeholder='Enter weight'>

                  <button type='submit'>Enter Package Weight</button>
                </form> 
              ";
            }

            
          echo "</div>
          <div style='clear:both'></div>
          <div class='col-md-12'>

          </div>
        </div>

        <div style='height:20px'></div>

        

        
      ";
    }



    $sql = "SELECT * FROM orderitems WHERE orderid='$OrderId'";
    $result = $conn->query($sql);

    echo "<div class='row'>
        <h3>Item Information</h3>
        <div class='col-md-12'>
          <table class='table' width='100%'>
            <thead>
              <th>Line Item Id</th>
              <th>Qty</th>
              <th>Item Name</th>
              <th>Front <br><small>Preview</small></th>
              <th>Back <br><small>Preview</small></th>
              <th>File</th>
              <th>File</th>
            </thead>
            <tbody>";

    while($row = $result->fetch_assoc()) {

      echo "

        <tr>
          <td>{$row["LI_LineItemId"]}</td>
          <td>{$row["LI_Quantity"]}</td>
          <td>{$row["LI_Description"]}</td>
          <td><a href='{$row["PreviewFile_Url_Front"]}' target='_blank'><img src='{$row["PreviewFile_Url_Front"]}' style='max-width:75px' /></a></td>
          <td><a href='{$row["PreviewFile_Url_Back"]}' target='_blank'><img src='{$row["PreviewFile_Url_Back"]}' style='max-width:75px' /></a></td>
          <td><a href='{$row["PrintFile_Url_Front"]}' target='_blank'>Front</a></td>
          <td><a href='{$row["PrintFile_Url_Back"]}' target='_blank'>Back</a></td>
          
          


        </tr>";
      }

      echo "
            </tbody>
          </table> <br/>
          
        </div>
      </div>";



  ?>
</div>

  <?php include("footer.php"); ?>



 
