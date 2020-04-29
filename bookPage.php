<html>
  <head>
    <meta charset="utf-8">
    <title>Roy's Bookstore</title>
    <link rel= "stylesheet" type= "text/css"  href= "style.css">

  </head>
  <body>
        <div class = "search_area">
              <input type = "text"  id = "searchBar" placeholder = "Keyword(s)">
              <input type = "button" id = "searchButton" value = "Search" onclick = "window.location.href = 'main.php?show=searchFunc&words='+document.getElementById('searchBar').value">
        </div>

        <div class = "logins">
        <?php
            session_start();
            if(!isset($_SESSION['username'])){
                echo "<div  id = \"sign_in\" class = \"s_btn\" onclick= \"window.location.href = 'indexx.html'\">Sign In</div>";
                echo "<div  id = \"register\"  class = \"s_btn\" onclick= \"window.location.href = 'create.html'\">Register</div>";
                echo "<input type = \"button\" class = \"btn1\" id = \"cart\" value = \"Cart\" onclick = \"window.location.href = 'cart.php'\">";
                $conn = mysqli_connect('sophia.cs.hku.hk', 'sroy', 'Riju1234', 'sroy') or die ('Error! '.mysqli_connect_error($conn));

                if(isset($_SESSION['username'])){
                $query = "Select ifNULL(sum(Quantity),0) as total from cart Where UserID = '".$_SESSION['username']."'";
                $result = mysqli_query($conn, $query) or die ('Failed to query '.mysqli_error($conn));

                while($row = mysqli_fetch_array($result)) {
                  echo "<sup  id = \"cartValue\">".$row['total']."</sup>";
                }
              }
              else if (isset($_SESSION['shoppingCart'])){
                $shoppingCart=array();
                $shoppingCart=$_SESSION['shoppingCart'];
                $sum=0;
                for ($row = 0; $row < count($shoppingCart); $row++) {
                  $sum=$sum+$shoppingCart[$row][2];
                }
                  echo "<sup  id = \"cartValue\">".$sum."</sup>";



              }
              else {
              echo "<sup id = \"cartValue\">0</sup>";
              }


            } else {
              echo "<input type = \"button\" class=\"button_decor\"  id = \"logout\" value = \"Logout\" onclick = \"window.location.href = 'logout.php'\">";

              echo "<input type = \"button\" class = \"btn1\" id = \"cart\" value = \"Cart\" onclick = \"window.location.href = 'cart.php'\">";

              $conn = mysqli_connect('sophia.cs.hku.hk', 'sroy', 'Riju1234', 'sroy') or die ('Error! '.mysqli_connect_error($conn));

              if(isset($_SESSION['username'])){
              $query = "Select ifNULL(sum(Quantity),0) as total from cart Where UserID = '".$_SESSION['username']."'";
              $result = mysqli_query($conn, $query) or die ('Failed to query '.mysqli_error($conn));

              while($row = mysqli_fetch_array($result)) {
                echo "<sup  id = \"cartValue\">".$row['total']."</sup>";
              }
            }
            else if (isset($_SESSION['shoppingCart'])){
              $shoppingCart=array();
              $shoppingCart=$_SESSION['shoppingCart'];
              $sum=0;
              for ($row = 0; $row < count($shoppingCart); $row++) {
                $sum=$sum+$shoppingCart[$row][2];

                echo "<sup  id = \"cartValue\">".$sum."</sup>";


      }
    }
     else {
          echo "<sup id = \"cartValue\">0</sup>";
      }





          }
        ?>
      </div>

      <a href="main.php"> HOME </a>
<?php
$conn = mysqli_connect('sophia.cs.hku.hk', 'sroy', 'Riju1234', 'sroy') or die ('Error! '.mysqli_connect_error($conn));
$query = 'select * from book Where Bookid=\''.$_GET['bookID'].'\'';
$bid=$_GET['bookID'];
$result = mysqli_query($conn, $query) or die ('Failed to query '.mysqli_error($conn));
while($row = mysqli_fetch_array($result)){
  print "<a href=\"javascript:void(0);\" id = \"sss\">".$row['Bookname']."</a>";
  print "<h1>".$row['Bookname']."</h1>";
  print "<img src=\"upload_image/".$row['image']."\">";
  print "<p>Author: ".$row['Author']."</p>";
  print "<p>Published: ".$row['Published']."</p>";
  print "<p>Publisher: ".$row['Publisher']."</p>";
  print "<p>Category: ".$row['Category']."</p>";
  print "<p>Language: ".$row['Lang']."</p>";
  print "<p>Description: ".$row['Description']."</p>";
  print "<p>$ ".$row['Price']."</p>";

}

while($row = mysqli_fetch_array($result)){
  print "<a href=\"javascript:void(0);\" id = \"sss\">".$row['BookName']."</a>";
  print "<p>".$row['BookName']."</p>";
  print "<img src=\"upload_image/".$row['image']."\">";
  print "<p>Author: ".$row['Author']."</p>";
  print "<p>Published: ".$row['Published']."</p>";
  print "<p>Publisher: ".$row['Publisher']."</p>";
  print "<p>Category: ".$row['Category']."</p>";
  print "<p>Language: ".$row['Lang']."</p>";
  print "<p>Description: ".$row['Description']."</p>";
  print "<p>$ ".$row['Price']."</p>";

}
session_start();

?>
<span>Order:</span>
<input type = "number" min="1" value="1"  id = "cartInput">
<input type = "button" id = "cartButton" value = "Add to Cart">
<script>
document.getElementById("cartButton").addEventListener('click', addToCart);
function addToCart()
{
  var xmlhttp;
  if (window.XMLHttpRequest) {
      xmlhttp = new XMLHttpRequest();
      }
  else {
      xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
      }

    xmlhttp.open("POST", "displayCart.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send("show=add&bid="+"<?= $bid; ?>"+"&quantity="+document.getElementById("cartInput").value);
    xmlhttp.onreadystatechange = function () {
    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
        document.getElementById("cartInput").value = 1;
        window.location.href = "cart.php";
            }
            else {
            }
      }
}
</script>






  </body>

</html>
