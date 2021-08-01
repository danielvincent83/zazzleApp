
<?php include("header.php"); ?>

<div class="container">
  <table class="table">
    <thead>
      <tr>
        <th scope="col">Order Id</th>
        <th scope="col">Order Date</th>
        <th scope="col">Delivery Method</th>
        <th scope="col">Priority</th>
        <th scope="col">Status</th>

      </tr>
    </thead>
    <tbody>
      <?php echo "There are " . $colCount . " new orders in the system"; ?>

      <?php 

        $query = htmlspecialchars($_GET["orderid"]);

        if ($query === $OrderId) {
          # code...
        }

      ?>



      <?php foreach ($Order as $value) { $myJSON = json_encode($value); extract($value, EXTR_REFS); 
          echo "<tr>";
              echo "<td>" . $OrderId . "</td>";
              echo "<td>" . $OrderDate  . "</td>"; 
              echo "<td>" . $DeliveryMethod  . "</td>"; 
              echo "<td>" . $Priority  . "</td>"; 
              echo "<td>" .  $Status   . "</td>"; 
              extract($ShippingAddress, EXTR_REFS);
              echo "<td>" . $Address1  . "</td>"; 
              extract($Address2, EXTR_REFS);

              extract($Address3, EXTR_REFS);

              echo "<td>" . $Name  . "</td>"; 
              extract($Name2, EXTR_REFS); 

              echo "<td>" . City  . "</td>"; 
              echo "<td>" . State  . "</td>"; 
              echo "<td>" . Country  . "</td>"; 
              echo "<td>" . CountryCode  . "</td>"; 
              echo "<td>" . Zip  . "</td>";

          echo "</tr>";
          } 
      ?> 
    </tbody>
  </table>
</div>

  <?php include("footer.php"); ?>



  <!--               extract($ShippingAddress, EXTR_REFS);
              echo "<td>" . $Address1  . "</td>"; 
              extract($Address2, EXTR_REFS);

              extract($Address3, EXTR_REFS);

              echo "<td>" . $Name  . "</td>"; 
              extract($Name2, EXTR_REFS); 

              echo "<td>" . City  . "</td>"; 
              echo "<td>" . State  . "</td>"; 
              echo "<td>" . Country  . "</td>"; 
              echo "<td>" . CountryCode  . "</td>"; 
              echo "<td>" . Zip  . "</td>";  -->

