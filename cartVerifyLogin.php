<?php
  session_start();

  $conn=mysqli_connect('sophia.cs.hku.hk', 'sroy', 'Riju1234', 'sroy') or die ('Error! '.mysqli_connect_error($conn));
  $username = $_POST['username'];
  $password = $_POST['password'];
  $query = "select * from login where UserId='".$username."' and Pwd='".$password."';";
  $result = mysqli_query($conn, $query) or die ('Failed to query '.mysqli_error($conn));
  if(mysqli_num_rows($result) != 0) {

    $_SESSION['username'] = $username;

    if(isset($_SESSION['shoppingCart']))
    {
      $shoppingCart = array();
      $shoppingCart = $_SESSION['shoppingCart'];
      $sum = 0;
      for ($row = 0; $row < count($shoppingCart); $row++) {
        $query1 = "select * from cart Where UserID = '".$username."' and BookID = ".$shoppingCart[$row][0];
        $result1 = mysqli_query($conn, $query1) or die ('Failed to query '.mysqli_error($conn));

        if(mysqli_num_rows($result1)!=0)
        {
          $query2 = "update cart set Quantity = Quantity + ".$shoppingCart[$row][2]." where UserID = '".$username."' and BookID = ".$shoppingCart[$row][0];
          $result2 = mysqli_query($conn, $query2) or die ('Failed to query '.mysqli_error($conn));
        }
        else {
          $query3 = "Insert into cart (BookID, UserID, Quantity) Values (".$shoppingCart[$row][0].", '".$username."', ".$shoppingCart[$row][2].")";
          $result3 = mysqli_query($conn, $query3) or die ('Failed to query '.mysqli_error($conn));
        }
      }

      session_unset($_SESSION['shoppingCart']);
    } 
  } else {
    print "<h1>Invalid login, please login again.</h1>";
  }
  mysqli_free_result($result);
	mysqli_close($conn);
?>
