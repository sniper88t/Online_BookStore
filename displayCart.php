<?php
session_start();
$conn = mysqli_connect('sophia.cs.hku.hk', 'sroy', 'Riju1234', 'sroy') or die ('Error! '.mysqli_connect_error($conn));

if($_POST['show']=='validate')
{
  $username=$_POST['username'];
  $query="select * from login where UserId='".$username."';";
  $result=mysqli_query($conn, $query) or die ('Failed to query '.mysqli_error($conn));
  if(mysqli_num_rows($result)>0) {
        print "<p id=\"signal\">Username Duplicated!</p>";
        } else {
          print "<p id=\"signal\>Username Valid</p>";
          }
}

else if($_POST['show']=='records')
{
  if(isset($_SESSION['username']))
  {
    $username = $_SESSION['username'];
    $query = "Select B.Bookid, B.image, B.BookName, C.Quantity, B.Price * C.Quantity as STotal from cart as C Inner Join book as B on B.Bookid = C.BookID Where UserID = '".$username."'";
    $result = mysqli_query($conn, $query) or die ('Failed to query '.mysqli_error($conn));
    $sum = 0;
    while($row = mysqli_fetch_array($result)) {
      $sum = $sum + $row['STotal'];
      print "<h1>".$row['BookName']."</h1>";
      print "<h4>Quantity:".$row['Quantity']."</h4>";
      print "<h4>Subtotal: $".$row['STotal']."</h4>";
      print "<input type = \"button\" class=\"button_decor\"  onclick = \"deleteRecord(".$row['Bookid'].")\" value = \"Delete\">";

            }
      print "<h1>Total Price: $".$sum."</h1>";
  }
  else {

    $shoppingCart=array();
    $shoppingCart=$_SESSION['shoppingCart'];
    $sum=0;
    for ($row = 0; $row < count($shoppingCart); $row++) {
      $sum=$sum+$shoppingCart[$row][3]*$shoppingCart[$row][2];
      $subtotal=$shoppingCart[$row][3]*$shoppingCart[$row][2];
      print "<h1>".$shoppingCart[$row][1]."</h1>";
      print "<h4>Quantity:".$shoppingCart[$row][2]."</h4>";
      print "<h4>Subtotal: $".$subtotal."</h4>";
      print "<input type = \"button\" class=\"button_decor\" onclick = \"deleteRecord(".$shoppingCart[$row][0].")\" value = \"Delete\">";

    }

    print "<h1>Total Price: $".$sum."</h1>";


  }
}
else if($_POST['show']=='add')
{

  if(isset($_SESSION['username']))
  {
    $bid = $_POST['bid'];
    $username = $_SESSION['username'];
    $quantity = $_POST['quantity'];
    $query = "select * from cart Where UserID = '".$username."' And BookID = ".$bid;
    $result = mysqli_query($conn, $query) or die ('Failed to query '.mysqli_error($conn));

    if(mysqli_num_rows($result)==0)
    {
      $query = "insert into cart (BookID, UserID, Quantity) values (".$bid.", '".$username."', ".$quantity.")";
      $result = mysqli_query($conn, $query) or die ('Failed to query '.mysqli_error($conn));
    }
    else {
      $query = "update cart set quantity = quantity + ".$quantity." Where UserID = '".$username."' And BookID = ".$bid;
      $result = mysqli_query($conn, $query) or die ('Failed to query '.mysqli_error($conn));
    }

  }
  else
  {
    $bid = $_POST['bid'];
    $quantity = $_POST['quantity'];
    $r=array();
    $shoppingCart = array();



    if(isset($_SESSION['shoppingCart']))
    {
      $shoppingCart= $_SESSION['shoppingCart'];

      $flag =0;
      for ($row = 0; $row < count($shoppingCart); $row++) {
          if($shoppingCart[$row][0] == $bid){
            $shoppingCart[$row][2] = $shoppingCart[$row][2] + $quantity;
            $flag =1;
            }
          }
      $_SESSION['shoppingCart']=$shoppingCart;
      if($flag == 0){
          $query = "select * from book where Bookid = ".$bid;
          $result = mysqli_query($conn, $query) or die ('Failed to query '.mysqli_error($conn));
          while($row = mysqli_fetch_array($result)) {
              $r = array($bid, $row['Bookname'], $quantity, $row['Price']);
              array_push($shoppingCart, $r);
              $_SESSION['shoppingCart'] = $shoppingCart;
                      }
                  }
    }
    else {
      $query = "select * from book where Bookid = ".$bid;
      $result = mysqli_query($conn, $query) or die ('Failed to query '.mysqli_error($conn));
      while($row = mysqli_fetch_array($result)) {
            $r = array($bid, $row['Bookname'], $quantity,$row['Price']);
            $shoppingCart = array($r);
            $_SESSION['shoppingCart'] = $shoppingCart;
        }
    }

  }

}
else if($_POST['show']=='delete') {
  if(isset($_SESSION['username']))
  { $username=$_SESSION['username'];
    $bid = $_POST['bookid'];
    $query = "delete From cart Where UserID = '".$username."' and BookID = ".$bid;
    $result = mysqli_query($conn, $query) or die ('Failed to query '.mysqli_error($conn));
    $query = "Select B.Bookid, B.image, B.BookName, C.Quantity, B.Price * C.Quantity as STotal from cart as C Inner Join book as B on B.Bookid = C.BookID Where UserID = '".$username."'";
    $result = mysqli_query($conn, $query) or die ('Failed to query '.mysqli_error($conn));
    $sum = 0;
    while($row = mysqli_fetch_array($result)) {
      $sum = $sum + $row['STotal'];
      print "<h1>".$row['bookName']."</h1>";
      print "<h4>Quantity:".$row['Quantity']."</h4>";
      print "<h4>Subtotal: $".$row['STotal']."</h4>";
      print "<input type = \"button\" class=\"button_decor\"  onclick = \"deleteRecord(".$row['Bookid'].")\" value = \"Delete\">";

            }
      print "<h1>Total Price: $".$sum."</h1>";


}
else {

  $shoppingCart=array();
  $newCart=array();
  $r=array();
  $bid=$_POST['bookid'];

    $shoppingCart=$_SESSION['shoppingCart'];
    for($row=0;$row<count($shoppingCart);$row++)
    {
      if($shoppingCart[$row][0]!=$bid)
      {
        $r=$shoppingCart[$row];
        array_push($newCart,$r);
      }
    }
  $_SESSION['shoppingCart']=$newCart;
  $sum=0;
  for ($row = 0; $row < count($shoppingCart); $row++) {
    $sum=$sum+$shoppingCart[$row][3]*$shoppingCart[$row][2];
    $subtotal=$shoppingCart[$row][3]*$shoppingCart[$row][2];
    print "<h1>".$shoppingCart[$row][1]."</h1>";
    print "<h4>Quantity:".$shoppingCart[$row][2]."</h4>";
    print "<h4>Subtotal: $".$subtotal."</h4>";
    print "<input type = \"button\" class=\"button_decor\" onclick = \"deleteRecord(".$shoppingCart[$row][0].")\" value = \"Delete\">";

}

print "<h1>Total Price: $".$sum."</h1>";




}
}
else if ($_POST['show']=='checkOutRecords')
{
  if(isset($_SESSION['username']))
  {
    $username = $_SESSION['username'];
    $query = "Select B.Bookid, B.image, B.BookName, C.Quantity, B.Price * C.Quantity as STotal from cart as C Inner Join book as B on B.Bookid = C.BookID Where UserID = '".$username."'";
    $result = mysqli_query($conn, $query) or die ('Failed to query '.mysqli_error($conn));
    $sum = 0;
    while($row = mysqli_fetch_array($result)) {
      $sum = $sum + $row['STotal'];
      print "<p class=\"record_display\">".$row['Quantity']."X".$row['BookName']." HK$".$row['STotal']."</p>";
            }
      print "<p class=\"record_display\">Total Price: $".$sum."</p>";

  }
  else {

    $shoppingCart=array();
    $shoppingCart=$_SESSION['shoppingCart'];
    $sum=0;
    for ($row = 0; $row < count($shoppingCart); $row++) {
      $sum=$sum+$shoppingCart[$row][3]*$shoppingCart[$row][2];
      print "<p class=\"record_display\">".$shoppingCart[$row][2]."X".$shoppingCart[$row][1]." HK$".$shoppingCart[$row][3]."</p>";

  }
  print "<p class=\"record_display\">Total Price: $".$sum."</p>";


  }
}

else if ($_POST['show']=='cartValue') {
  if(isset($_SESSION['username'])){
    $query = "Select ifNULL(sum(Quantity),0) as total from cart Where UserID = '".$_SESSION['username']."'";
    $result = mysqli_query($conn, $query) or die ('Failed to query '.mysqli_error($conn));

    while($row = mysqli_fetch_array($result)) {
      echo "".$row['total']."";
    }
  }
  else if (isset($_SESSION['shoppingCart'])){
    $shoppingCart=array();
    $shoppingCart=$_SESSION['shoppingCart'];
    $sum=0;
    for ($row = 0; $row < count($shoppingCart); $row++) {
      $sum=$sum+$shoppingCart[$row][2];
      echo "".$sum."";
    }
  }
  else {
    echo "0";
  }
}
?>
