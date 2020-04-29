<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Roy's Bookstore</title>
    <link rel= "stylesheet" type= "text/css"  href= "style.css">
  </head>
  <body>

    <div class = "search_area">
          <input type = "text"  id = "searchBar" placeholder = "Keyword(s)">
          <input type = "button" id = "searchButton" value = "Search">
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

  <br>
  <br>

    <div id="whole_page">

      <div class = "column c1">
      <h1> Category </h1>
        <div id="categoryList">

        </div>
      </div>
      <div id="books" class = "columnc2">
          <a href="main.php"> HOME </a>
          <span> > </span>
          <a href="javascript:void(0);" id = "sss"> </a>

          <h1 id = "head">All Books</h1>

          <input type = "button" id = "sortButton" value = "Sort by Price (Lowest)">

          <br>
          <br>

          <div id="bookList">

          </div>
      </div>
  </div>



  </body>
  <script>
    window.onload= function(){

      showCategory();
      showAllBooks();
      <?php
        if(isset($_GET['show'])){
          echo "searchOther('".$_GET['words']."');";
        }
      ?>
    }
    var btn=document.getElementById("searchButton");
    btn.addEventListener('click',searchByWords);
    var sortBtn=document.getElementById("sortButton");
    sortBtn.addEventListener('click',sortByPrice);

    function sortByPrice()
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

          var mesgs = document.getElementById("bookList");
          document.getElementById("head").innerHTML = "All Books (Sort by Price Lowest)";
          mesgs.innerHTML = xmlhttp.responseText;
          }
      }

      xmlhttp.open("POST", "mainHelper.php", true);
      xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      xmlhttp.send("show=sort");
    }
    function filterCategory(elem)
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

          var mesgs = document.getElementById("bookList");
          mesgs.innerHTML = xmlhttp.responseText;
          document.getElementById("sss").innerHTML = elem.innerHTML;
          document.getElementById("head").innerHTML = "All " +  elem.innerHTML;
          }
      }

      xmlhttp.open("POST", "mainHelper.php", true);
      xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      xmlhttp.send("show=filter&category="+elem.innerHTML);
    }
    function searchByWords()
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
          var mesgs = document.getElementById("bookList");
          document.getElementById("head").innerHTML = "Searching Results";
          mesgs.innerHTML = xmlhttp.responseText;
          }
      }

      xmlhttp.open("POST", "mainHelper.php", true);
      xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
     xmlhttp.send("show=search&keyword="+document.getElementById("searchBar").value);
    }

    function searchOther(elem)
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
          var mesgs = document.getElementById("bookList");
          document.getElementById("head").innerHTML = "Searching Results";
          mesgs.innerHTML = xmlhttp.responseText;
          }
      }

      xmlhttp.open("POST", "mainHelper.php", true);
      xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
     xmlhttp.send("show=search&keyword="+elem);
    }

    function showCategory()
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
          var mesgs = document.getElementById("categoryList");
          mesgs.innerHTML = xmlhttp.responseText;
          }
      }
      xmlhttp.open("POST", "mainHelper.php", true);
      xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      xmlhttp.send("show=categories");
    }
    function bookView(elem)
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
          window.location.href="bookPage.php";
          }
      }
      xmlhttp.open("POST", "mainHelper.php", true);
      xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      xmlhttp.send("show=bookDisplay&bookID="+elem);
    }
    function showAllBooks()
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
          var mesgs = document.getElementById("bookList");

          mesgs.innerHTML = xmlhttp.responseText;

          }
      }
      xmlhttp.open("POST", "mainHelper.php", true);
      xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      xmlhttp.send("show=books");
    }
  </script>
</html>
