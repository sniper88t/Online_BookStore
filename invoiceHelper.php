<?php

session_start();

if($_POST['show']=='invoice')
{

  $invoice=array();
  $invoice = array($_POST['name'], $_POST['company'],$_POST['address1'], $_POST['address2'],$_POST['city'], $_POST['region'],$_POST['country'], $_POST['postcode']);
  $_SESSION['invoice'] = $invoice;

}





 ?>
