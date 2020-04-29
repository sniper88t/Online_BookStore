<html>
<head>
<title>Roy's Bookstore </title>
<link rel= "stylesheet" type= "text/css"  href= "style.css">
</head>
<body>
  <div id="entries">
  </div>
<h1> Invoice Page </h1>
<?php
session_start();
$conn = mysqli_connect('sophia.cs.hku.hk', 'sroy', 'Riju1234', 'sroy') or die ('Error! '.mysqli_connect_error($conn));

if(isset($_SESSION['username']))
{
print "<p> Full name".$_SESSION['invoice'][0]."</p>";

print "<p> Company: ".$_SESSION['invoice'][1]."</p>";
print "<p> Address Line 1: ".$_SESSION['invoice'][2]."</p>";
print "<p> Address Line 2".$_SESSION['invoice'][3]."</p>";
print "<p> City: ".$_SESSION['invoice'][4]."</p>";
print "<p> Region: ".$_SESSION['invoice'][5]."</p>";
print "<p> Country: ".$_SESSION['invoice'][6]."</p>";
print "<p> Postcode: ".$_SESSION['invoice'][7]."</p>";
$username = $_SESSION['username'];


$query = "Select B.Bookid, B.image, B.BookName, C.Quantity, B.Price * C.Quantity as STotal from cart as C Inner Join book as B on B.Bookid = C.BookID Where UserID = '".$username."'";
$result = mysqli_query($conn, $query) or die ('Failed to query '.mysqli_error($conn));
$sum = 0;
while($row = mysqli_fetch_array($result)) {
  $sum = $sum + $row['STotal'];
  print "<p class=\"record_display\">".$row['Quantity']."X".$row['BookName']." HK$".$row['STotal']."</p>";
        }
  print "<p class=\"record_display\">Total Price: $".$sum."</p>";

    $query = "delete From cart Where UserID = '".$username."'";
    $result = mysqli_query($conn, $query) or die ('Failed to query '.mysqli_error($conn));

print "<p class=\"record_display\"> Thanks for ordering. Your books will be delivered within 7 working days </p>";


}
else {
  print "<p> Full name".$_SESSION['invoice'][0]."</p>";

  print "<p> Company: ".$_SESSION['invoice'][1]."</p>";
  print "<p> Address Line 1: ".$_SESSION['invoice'][2]."</p>";
  print "<p> Address Line 2".$_SESSION['invoice'][3]."</p>";
  print "<p> City: ".$_SESSION['invoice'][4]."</p>";
  print "<p> Region: ".$_SESSION['invoice'][5]."</p>";
  print "<p> Country: ".$_SESSION['invoice'][6]."</p>";
  print "<p> Postcode: ".$_SESSION['invoice'][7]."</p>";



  $shoppingCart=array();
  $shoppingCart=$_SESSION['shoppingCart'];
  $sum=0;
  for ($row = 0; $row < count($shoppingCart); $row++) {
    $sum=$sum+$shoppingCart[$row][3]*$shoppingCart[$row][2];
    print "<p class=\"record_display\">".$shoppingCart[$row][2]."X".$shoppingCart[$row][1]." HK$".$shoppingCart[$row][3]."</p>";

}
print "<p class=\"record_display\">Total Price: $".$sum."</p>";
print "<p class=\"record_display\"> Thanks for ordering. Your books will be delivered within 7 working days </p>";
}
 ?>

 <input type = "button" id="ok_button" value = "OK" onclick = "window.location.href = 'main.php'">


</body>

</html>
