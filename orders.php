<meta http-equiv="refresh" content="300">
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

  <table class="table">
    <thead>
      <tr>
        <th scope="col">Order Id</th>
        <th scope="col">Date Placed</th>
        <th scope="col">Name</th>
        <th scope="col">Delivery Method</th>
        <th scope="col">Country</th>
        <th scope="col">Priority</th>
        <th scope="col">Status</th>
      </tr>
    </thead>
    <tbody>
      <?php 
        $Status = $_GET['Status'];

        $sql = "SELECT * FROM orders WHERE Status = '$Status'";
          $result = $conn->query($sql);

        if(!$result) {
          die("Database query failed: " . mysql_error());
        } else {}

        while($row = $result->fetch_assoc()) {
          echo "
            <tr>
            <td><a href='singleorder.php?orderid={$row["OrderId"]}'>{$row["OrderId"]}</a></td>
              <td>{$row["OrderDate"]}</td>
              <td>{$row["Name"]}</td>
              <td>{$row["DeliveryMethod"]}</td>
              <td>{$row["Country"]}</td>
              <td>{$row["Priority"]}</td>
              <td>{$row["Status"]}</td> 
            </tr>
            ";
        }
      ?>
    </tbody>
  </table>
</div>
<div style="height:25px; clear:both;"></div>
<div class="container">
  <form action="orders.php?Status=" method="get">
    <select name="Status" id="">
      <option value="Accepted" <?php if($Status == "ACCEPTED") {echo "selected";} ?>>Accepted</option>
      <option value="Shipped" <?php if($Status == "Shipped") {echo "selected";} ?>>Shipped</option>
      <option value="Cancelled" <?php if($Status == "Cancelled") {echo "selected";} ?>>Cancelled</option>
    </select>
    <input type="submit">
  </form>
</div>

  <?php include("footer.php"); ?>



