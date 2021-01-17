<?php
require_once "secure.php";
$id = Helper::clearInt($_GET['bill_position_id']);
  if((new BillPositionService())->delete($id)) {
    header('Location: add-bill.php?id='.$_GET["bill_id"]);
  }
exit();
