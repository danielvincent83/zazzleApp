<?php
 session_start();
 include("header.php"); 
 include("navigation.php");


 ?>

<div class="container">
  


<?php 

    require_once("inc/config.php");
    require_once("inc/functions.php");

    foreach ($Order as $value) { 
      extract($value, EXTR_REFS); 
      extract($ShippingAddress, EXTR_REFS);
      extract($LineItems, EXTR_REFS);
      extract($PackingSheet, EXTR_REFS);

      if ($Address2 == NULL ) { $Address2 = NULL; } 
      if ($Address3 == NULL ) { $Address3 = NULL; } 
      if ($Name2 == NULL ) { $Name2 = NULL; } 
      GLOBAL $OrderId;
      GLOBAL $OrderId;

      if(isset ($Page[1])) { 
        $PackingSheet_Url = $Page[0]['Front']['Url'];
        $PackingSheet_Url2 = $Page[1]['Front']['Url'];
      } else {
          extract($Page, EXTR_REFS);
          $PackingSheet_Url = $Front['Url'];
          $PackingSheet_Url2 = NULL;
      }    

      if(isset ($LineItem[1])) { 

        foreach ($LineItem as $item) {
          extract($item, EXTR_REFS);
          $PrintFile_Url_Front = $PrintFiles['PrintFile'][0]['Url'];
          $PrintFile_Url_Back = $PrintFiles['PrintFile'][1]['Url'];
          $PreviewFile_Url_Front = $Previews['PreviewFile'][0]['Url'];
          $PreviewFile_Url_Back = $Previews['PreviewFile'][1]['Url'];

          $sql = "INSERT INTO orderitems (OrderId, LI_LineItemId, LI_Quantity, LI_Description, PrintFile_Url_Front, PrintFile_Url_Back, PreviewFile_Url_Front, PreviewFile_Url_Back) VALUES ('{$OrderId}',  '{$LineItemId}', '{$Quantity}', '{$Description}', '{$PrintFile_Url_Front}', '{$PrintFile_Url_Back}', '{$PreviewFile_Url_Front}', '{$PreviewFile_Url_Back}')";

            // if ($conn->query($sql) === TRUE) {
            //     echo "Line Item Created for". $OrderId ."<br>";
            // } else {
            //     echo "<li>Error: " . $conn->error ."</li>";
            // } 
        }
      } else {
        
          extract($LineItem, EXTR_REFS);
          $PrintFile_Url_Front = $PrintFiles['PrintFile'][0]['Url'];
          $PrintFile_Url_Back = $PrintFiles['PrintFile'][1]['Url'];
          $PreviewFile_Url_Front = $Previews['PreviewFile'][0]['Url'];
          $PreviewFile_Url_Back = $Previews['PreviewFile'][1]['Url'];

          $sql = "INSERT INTO orderitems (OrderId, LI_LineItemId, LI_Quantity, LI_Description, PrintFile_Url_Front, PrintFile_Url_Back, PreviewFile_Url_Front, PreviewFile_Url_Back) VALUES ('{$OrderId}',  '{$LineItemId}', '{$Quantity}', '{$Description}', '{$PrintFile_Url_Front}', '{$PrintFile_Url_Back}', '{$PreviewFile_Url_Front}', '{$PreviewFile_Url_Back}')";

            // if ($conn->query($sql) === TRUE) {
            //     echo "Line Item Created for". $OrderId ."<br>";
            // } else {
            //     echo "<li>Error: " . $conn->error ."</li>";
            // } 
      }  
      // echo "</ul>";


      $sql = "INSERT INTO orders (OrderId, OrderDate, DeliveryMethod, Priority, Status, Address1, Address2, Address3, Name, Name2, City, State, Country, CountryCode, Zip, PackingSheet_Url, PackingSheet_Url2) VALUES ('{$OrderId}', '{$OrderDate}', '{$DeliveryMethod}', '{$Priority}', 'Accepted', '{$Address1}', '{$Address2}', '{$Address3}', '{$Name}', '{$Name2}','{$City}', '{$State}', '{$Country}', '{$CountryCode}', '{$Zip}', '{$PackingSheet_Url}', '{$PackingSheet_Url2}')";
      if ($conn->query($sql) === TRUE) {
        $orderhash = md5hash($OrderId, 'new');
        $ackorderurl = 'https://vendor.zazzle.com/v100/api.aspx?method=ackorder&vendorid=inkcorrect&orderid='.$OrderId.'&type=new&hash='.$orderhash.'';
        set_AckOrder($ackorderurl);
        echo $OrderId ." Successfully added to the database<br>";
      } 

      else {
          echo "Error: " . $conn->errno . ": " . $conn->error . "<br>";
        //   $orderhash = md5hash($OrderId, 'new');
        // $ackorderurl = 'https://vendor.zazzle.com/v100/api.aspx?method=ackorder&vendorid=inkcorrect&orderid='.$OrderId.'&type=new&hash='.$orderhash.'';
        // set_AckOrder($ackorderurl);
        // echo "<a href='".$ackorderurl."'>Clear Order ></a>" . "<br><br>";

          
      }
      // if( $conn->errno == 1062 ) {
      //     $orderhash = md5hash($OrderId, 'new');
      //     $ackorderurl = 'https://vendor.zazzle.com/v100/api.aspx?method=ackorder&vendorid=inkcorrect&orderid='.$OrderId.'&type=new&hash='.$orderhash.'';
      //     set_AckOrder($ackorderurl);
      //     echo "Duplicate Order: " . $OrderId ." Successfully acked from the system<br>";
      //   } 
    }
    
?>
</div>