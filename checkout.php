<html>
  <head>
    <meta charset="utf-8">
    <title>Roy's Bookstore</title>
    <link rel= "stylesheet" type= "text/css"  href= "style.css">
  </head>

  <body>
    <?php session_start(); if (isset($_SESSION['username'])) : ?>
      <div class="checkout_region">
      <p>Delivery Address</p>
      <label>Full Name </label>
      <input type = "text" id="fullname" placeholder = "Required">
      <br>
      <label>Company Name </label>
      <input type = "text" id="companyname" placeholder = "Required">
      <br>
      <label>Address Line 1 </label>
      <input type = "text" id="address1" placeholder = "Required">
      <br>
      <label>Address Line 2</label>
      <input type = "text" id="address2">
      <br>
      <label>City</label>
      <input type = "text" id="city" placeholder = "Required">
      <br>
      <label>Region/State/District</label>
      <input type = "text" id="region">
      <br>
      <label>Country</label>
      <input type = "text" id="country" placeholder = "Required">
      <br>
      <label>Postcode Zip Code</label>
      <input type = "text" id="postcode" placeholder = "Required">
      <br>
    </div>
      <input type = "button" class="button_decor" id = "confirmation"  value = "Confirm" onclick = "getInvoice()">
    <?php  endif ?>
    <?php session_start(); if (!isset($_SESSION['username'])) : ?>
      <div id="outer_box">
        <div class="checkout_region">
          <p> I'm a new customer </p>
          <p> Please checkout below </p>
        </div>
        <div class="checkout_region">
          <p> I'm already a Customer </p>
          <a href="cartLogin.html"> Sign in </a>
        </div>
      </div>
      <input id="desired_username" type="text" placeholder="Desired Username" required > <br>
      <input id="desired_password" type="password" placeholder="Desired Password"> <br>
      <div id="signal">
      </div>
      <div class="checkout_region">
      <p>Delivery Address</p>
      <label>Full Name </label>
      <input type = "text" id="fullname" placeholder = "Required">
      <br>
      <label>Company Name </label>
      <input type = "text" id="companyname" placeholder = "Required">
      <br>
      <label>Address Line 1 </label>
      <input type = "text" id="address1" placeholder = "Required">
      <br>
      <label>Address Line 2</label>
      <input type = "text" id="address2">
      <br>
      <label>City</label>
      <input type = "text" id="city" placeholder = "Required">
      <br>
      <label>Region/State/District</label>
      <input type = "text" id="region">
      <br>
      <label>Country</label>
      <input type = "text" id="country" placeholder = "Required">
      <br>
      <label>Postcode Zip Code</label>
      <input type = "text" id="postcode" placeholder = "Required">
    </div>
      <br>
      <p> Your order: ( <a href="cart.php"> change </a>) </p>
      <br>
      <input type = "button" id = "confirmation"  value = "Confirm" onclick = "getInvoiceNotLoggedIn()">

    <?php  endif ?>

    <div id="entries">
    </div>


  </body>
  <script>
  document.getElementById("desired_username").addEventListener("blur",validateUserName);

  window.onload = function() {
                 showCheckoutRecords();
             }

             function validateUserName()
             {

                 var xmlhttp;
                  if (window.XMLHttpRequest) {
                      xmlhttp = new XMLHttpRequest();
                  } else {
                      xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                  }
                  xmlhttp.onreadystatechange = function () {
                      if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                          var mesgs = document.getElementById("signal");
                          if(xmlhttp.responseText=='<p id=\"signal\">Username Duplicated!</p>')
                          {
                            mesgs.innerHTML = xmlhttp.responseText;
                            document.getElementById("confirmation").disabled = true;

                          }
                          else {
                            mesgs.innerHTML = xmlhttp.responseText;
                            document.getElementById("confirmation").disabled = false;

                          }
                      }
            }
            console.log(document.getElementById("desired_username").value);
                  xmlhttp.open("POST", "displayCart.php", true);
                  xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                  xmlhttp.send("show=validate&username="+document.getElementById("desired_username").value);
             }
             function getInvoiceNotLoggedIn()
             {
               let fullname = document.getElementById("fullname");
                if (fullname.validity.valueMissing || fullname.value.trim() == '') {
                    alert("Please do not leave the fields empty");
                    fullname.focus();
                    return;
                }

                let companyname = document.getElementById("companyname");
                if (companyname.validity.valueMissing || companyname.value.trim() == '') {
                    companyname = 'NA';
                } else {
                    companyname = companyname.value;
                }

                let address1 = document.getElementById("address1");
                if (address1.validity.valueMissing || address1.value.trim() == '') {
                    alert("Please do not leave the fields empty");
                    address1.focus();
                    return;
                }

                let address2 = document.getElementById("address2");
                if (address2.validity.valueMissing || address2.value.trim() == '') {
                    address2 = 'NA';
                } else {
                    address2 = address2.value;
                }

                let city = document.getElementById("city");
                if (city.validity.valueMissing || city.value.trim() == '') {
                    alert("Please do not leave the fields empty");
                    city.focus();
                    return;
                }

                let region = document.getElementById("region");
                if (region.validity.valueMissing || region.value.trim() == '') {
                    region = 'NA';
                } else {
                    region = region.value;
                }

                let country = document.getElementById("country");
                if (country.validity.valueMissing || country.value.trim() == '') {
                    alert("Please do not leave the fields empty");
                    country.focus();
                    return;
                }

                let postcode = document.getElementById("postcode");
                if (postcode.validity.valueMissing || postcode.value.trim() == '') {
                    alert("Please do not leave the fields empty");
                    postcode.focus();
                    return;
                }
                let desired_username=document.getElementById("desired_username");
                let desired_password=document.getElementById("desired_password");

                if(desired_username.validity.valueMissing || desired_username.value.trim()=='')
                {
                  alert("Please do not leave the fields empty");
                }
                else if(desired_password.validity.valueMissing || desired_password.value.trim()=='')
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
                      if (xmlhttp.responseText=="")
                        {
                                                 var xmlhttp1;
                          if (window.XMLHttpRequest) {
                              xmlhttp1 = new XMLHttpRequest();
                          } else {
                              xmlhttp1 = new ActiveXObject("Microsoft.XMLHTTP");
                          }

                          xmlhttp1.onreadystatechange = function () {
                              if (xmlhttp1.readyState == 4 && xmlhttp1.status == 200) {
                                  window.location.href = 'invoice.php';
                              }
                    }
                          xmlhttp1.open("POST", "invoiceHelper.php", true);
                          xmlhttp1.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                          xmlhttp1.send("show=invoice&name="+fullname.value+"&company="+companyname+"&address1="+address1.value+"&address2="+address2+"&city="+city.value+"&region="+region+"&country="+country.value+"&postcode="+postcode.value);
                        }
                        else {
                          mesgs.innerHTML = xmlhttp.responseText;
                          window.setTimeout(function(){
                            window.location.href = "checkout.php";
                            }, 3000);
                        }


                }
              }
              xmlhttp.open("POST", "invoiceCreateAccount.php",true);
              xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
              xmlhttp.send("username="+document.getElementById("desired_username").value+"&password="+document.getElementById("desired_password").value);


             }
           }

             function showCheckoutRecords()
             {
               var xmlhttp;
                if (window.XMLHttpRequest) {
                    xmlhttp = new XMLHttpRequest();
                } else {
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
                xmlhttp.send("show=checkOutRecords");
             }

             function getInvoice()
             {
               let fullname = document.getElementById("fullname");
                if (fullname.validity.valueMissing || fullname.value.trim() == '') {
                    alert("Please do not leave the fields empty");
                    fullname.focus();
                    return;
                }

                let companyname = document.getElementById("companyname");
                if (companyname.validity.valueMissing || companyname.value.trim() == '') {
                    companyname = 'NA';
                } else {
                    companyname = companyname.value;
                }

                let address1 = document.getElementById("address1");
                if (address1.validity.valueMissing || address1.value.trim() == '') {
                    alert("Please do not leave the fields empty");
                    address1.focus();
                    return;
                }

                let address2 = document.getElementById("address2");
                if (address2.validity.valueMissing || address2.value.trim() == '') {
                    address2 = 'NA';
                } else {
                    address2 = address2.value;
                }

                let city = document.getElementById("city");
                if (city.validity.valueMissing || city.value.trim() == '') {
                    alert("Please do not leave the fields empty");
                    city.focus();
                    return;
                }

                let region = document.getElementById("region");
                if (region.validity.valueMissing || region.value.trim() == '') {
                    region = 'NA';
                } else {
                    region = region.value;
                }

                let country = document.getElementById("country");
                if (country.validity.valueMissing || country.value.trim() == '') {
                    alert("Please do not leave the fields empty");
                    country.focus();
                    return;
                }

                let postcode = document.getElementById("postcode");
                if (postcode.validity.valueMissing || postcode.value.trim() == '') {
                    alert("Please do not leave the fields empty");
                    postcode.focus();
                    return;
                }

                var xmlhttp;
                if (window.XMLHttpRequest) {
                    xmlhttp = new XMLHttpRequest();
                } else {
                    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                }

                xmlhttp.onreadystatechange = function () {
                    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                        window.location.href = 'invoice.php';
                    }
			    }
                xmlhttp.open("POST", "invoiceHelper.php", true);
                xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xmlhttp.send("show=invoice&name="+fullname.value+"&company="+companyname+"&address1="+address1.value+"&address2="+address2+"&city="+city.value+"&region="+region+"&country="+country.value+"&postcode="+postcode.value);
             }

  </script>

</html>
