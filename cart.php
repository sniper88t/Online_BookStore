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
                echo "<div  id = \"sign_in\" class = \"s_btn\" onclick= \"window.location.href = 'shoppingCartLogin.html'\">Sign In</div>";
                echo "<div  id = \"register\"  class = \"s_btn\" onclick= \"window.location.href = 'shoppingCartCreate.html'\">Register</div>";
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
              echo "<input type = \"button\" class = \"btn1\" id = \"logout\" value = \"Logout\" onclick = \"window.location.href = 'logout.php'\">";

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


    <h2>My Shopping Cart</h2>
    <div id="entries" class = "cartEntries">
    </div>
    <input type = "button" class="button_decor" value = "Checkout" onclick = " window.location.href = 'checkout.php'">
    <input type = "button" class="button_decor" value = "Back" onclick = " window.location.href = 'main.php'">


    <script>
    window.onload= function(){
      displayRecords();
    }
    function deleteRecord(elem)
    {

      console.log("FUCK YEAH");
      console.log(elem);
      var xmlhttp;
      if (window.XMLHttpRequest) {
          xmlhttp = new XMLHttpRequest();
      }
      else {
          xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
          }

      xmlhttp.onreadystatechange = function () {
      if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
          var mesgs = document.getElementById("entries");
          mesgs.innerHTML = xmlhttp.responseText;
          getCartVal();
        }
      }
      xmlhttp.open("POST", "displayCart.php", true);
      xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      xmlhttp.send("show=delete&bookid="+elem);


    }

    function getCartVal(){
      var xmlhttp;
      if (window.XMLHttpRequest) {
          xmlhttp = new XMLHttpRequest();
      }
      else {
          xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
          }

      xmlhttp.onreadystatechange = function () {
      if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
          var mesgs = document.getElementById("cartValue");
          mesgs.innerHTML = xmlhttp.responseText;
          }
      }
      xmlhttp.open("POST", "displayCart.php", true);
      xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      xmlhttp.send("show=cartValue");
    }

    function displayRecords()
    {
      var xmlhttp;
      if (window.XMLHttpRequest) {
          xmlhttp = new XMLHttpRequest();
      }
      else {
          xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
          }

      xmlhttp.onreadystatechange = function () {
      if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
          var mesgs = document.getElementById("entries");
          mesgs.innerHTML = xmlhttp.responseText;
          }
      }
      xmlhttp.open("POST", "displayCart.php", true);
      xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      xmlhttp.send("show=records");
    }
    </script>

  </body>

</html>
