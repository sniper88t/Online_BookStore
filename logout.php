<html>
  <head>
    <meta charset="utf-8">
    <title>Roy's Bookstore</title>
    <link rel= "stylesheet" type= "text/css"  href= "style.css">
  </head>
  <body>

    <div class = "search_area">
          <input type = "text"  id = "searchBar" placeholder = "Keyword(s)">
          <input type = "button" id = "searchButton" value = "Search">
    </div>
<?php
session_start();

if(isset($_SESSION['username']))
{
  unset($_SESSION['username']);

}

if(isset($_SESSION['invoice']))
{
  unset($_SESSION['invoice']);

}
if(isset($_SESSION['shoppingCart']))
{
  unset($_SESSION['shoppingCart']);

}


 ?>

  <br>
  <br>

<h2> Logging out </h2>
  </body>
  <script>
  window.onload = function(){
               setTimeout(() => {
                   window.location.href = "main.php";
               }, 3000);
           }
  </script>
</html>
