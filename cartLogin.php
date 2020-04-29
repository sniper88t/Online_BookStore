<html>
  <head>
    <meta charset="utf-8">
    <title>Roy's Bookstore</title>
  </head>
  <body>
    <h1> Roy's Bookstore </h1>
    <br>
    <input id="username" type="text" placeholder="Username" > <br>
    <input id="password" type="password" placeholder="Password"> <br>
    <div id="entries"></div>
    <input type="submit" value="SUBMIT" id="submit"><br>
    <a href="cartCreateAccount.php"><input type="submit" value="CREATE" id="create"></a>
  </body>
  <script>
    var btn=document.getElementById("submit");
    btn.addEventListener('click',checkValid);

    function checkValid()
    {
      let username=document.getElementById("username");
      let password=document.getElementById("password");
      if(username.validity.valueMissing || username.value.trim()=='')
      {
        alert("Please do not leave the fields empty");
      }
      else if(password.validity.valueMissing || password.value.trim()=='')
      {
        alert("Please do not leave the fields empty");
      }
      else {

        var xmlhttp;
        if (window.XMLHttpRequest) {
          xmlhttp = new XMLHttpRequest();
        } else {
          xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
          xmlhttp.onreadystatechange = function () {
              if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                var mesgs = document.getElementById("entries");
                if (xmlhttp.responseText!="")
                {
                  mesgs.innerHTML = xmlhttp.responseText;
                  window.setTimeout(function(){

                 window.location.href = "cartLogin.php";
             }, 3000);

                }
                else {
                  window.location.href = "cart.php";

                }
              }
            }
            xmlhttp.open("POST", "cartVerifyLogin.php",true);
            xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xmlhttp.send("username="+document.getElementById("username").value+"&password="+document.getElementById("password").value);
              }
            }


  </script>
</html>
