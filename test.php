<?php
  session_start();
  include_once('php/product.php');

  DumpSQl(findProducts2('Dev Mug WHITE', null, 'priceD'));
 ?>
