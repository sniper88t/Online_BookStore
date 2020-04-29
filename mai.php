<?php
$conn=mysqli_connect('sophia.cs.hku.hk', 'sroy', 'Riju1234', 'sroy') or die ('Error! '.mysqli_connect_error($conn));
session_start();

if ($_POST['show']=="categories")
{
  $query = 'select distinct Category from book';
  $result = mysqli_query($conn, $query) or die ('Failed to query '.mysqli_error($conn));

  while($row = mysqli_fetch_array($result)) {
          print "<u onclick=\"filterCategory(this)\">".$row['Category']."</u>";
          print " <br>";
    }
}
else if ($_POST['show']=="books")
{
  $query = 'select * from book';
  $result = mysqli_query($conn, $query) or die ('Failed to query '.mysqli_error($conn));

  while($row = mysqli_fetch_array($result)) {
    print "<div class=\"card\">";
		print "<img src=\"upload_image/".$row['image']."\">";
		print "<div id=\"".$row['Bookid']."\" onclick=\"window.location.href = 'bookPage.php?show=bookDisplay&bookID='+this.id\">Name:".$row['Bookname']."</div>";
		print "<p>Author: ".$row['Author']."</p>";
		print "<p>Publisher: ".$row['Publisher']."</p>";
    print "<p>$ ".$row['Price']."</p>";
    print "</div>";
  }
}
else if ($_POST['show']=="search") {
  $keywords = explode(" ", $_POST['keyword']);
$i=0;


  $query = 'select * from book where';
  for ($i=0; $i<count($keywords)-1;$i++)
    $query=$query." BookName like '%".$keywords[$i]."%' or";
  $query=$query." BookName like '%".$keywords[count($keywords)-1]."%';";

  $result = mysqli_query($conn, $query) or die ('Failed to query '.mysqli_error($conn));
  while($row = mysqli_fetch_array($result)) {
    print "<img src=\"upload_image/".$row['image']."\">";
    print "<div id=\"".$row['Bookid']."\" onclick=\"window.location.href = 'bookPage.php?show=bookDisplay&bookID='+this.id\">Name:".$row['Bookname']."</p>";
    print "<p>Author: ".$row['Author']."</p>";
    print "<p>Publisher: ".$row['Publisher']."</p>";
    print "<p>$ ".$row['Price']."</p>";
    print "</div>";
  }

}
else if ($_POST['show']=="sort"){
  $query = 'select * from book order by Price';
  $result = mysqli_query($conn, $query) or die ('Failed to query '.mysqli_error($conn));
  while($row = mysqli_fetch_array($result)) {
    print "<img src=\"upload_image/".$row['image']."\">";
    print "<div id=\"".$row['Bookid']."\" onclick=\"window.location.href = 'bookPage.php?show=bookDisplay&bookID='+this.id\">Name:".$row['Bookname']."</p>";
    print "<p>Author: ".$row['Author']."</p>";
    print "<p>Publisher: ".$row['Publisher']."</p>";
    print "<p>$ ".$row['Price']."</p>";
    print "</div>";
  }
  // code...
}
else if ($_POST['show']=="filter")
{
  $query = "select * from book Where Category = '".$_POST['category']."';";
  $result = mysqli_query($conn, $query) or die ('Failed to query '.mysqli_error($conn));
  while($row = mysqli_fetch_array($result)) {
    print "<img src=\"upload_image/".$row['image']."\">";
    print "<div id=\"".$row['Bookid']."\" onclick=\"window.location.href = 'bookPage.php?show=bookDisplay&bookID='+this.id\">Name:".$row['Bookname']."</p>";
    print "<p>Author: ".$row['Author']."</p>";
    print "<p>Publisher: ".$row['Publisher']."</p>";
    print "<p>$ ".$row['Price']."</p>";
    print "</div>";
  }
}
else {
  // code...
}
mysqli_free_result($result);
mysqli_close($conn);



 ?>
