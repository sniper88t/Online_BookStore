<?php
    session_start();

    $conn=mysqli_connect('sophia.cs.hku.hk', 'sroy', 'Riju1234', 'sroy') or die ('Error! '.mysqli_connect_error($conn));
    $username = $_POST['username'];
    $password = $_POST['password'];
    $query = "select * from login where UserId='$username' and Pwd='$password';";
    $result = mysqli_query($conn, $query) or die ('Failed to query '.mysqli_error($conn));
    if(mysqli_num_rows($result) != 0) {
      $_SESSION['username'] = $username;

    } else {
      print "<h1>Invalid login, please login again.</h1>";
    }
  mysqli_free_result($result);
	mysqli_close($conn);

?>
