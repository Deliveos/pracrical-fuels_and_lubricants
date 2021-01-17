<?php
ob_start();
require_once 'secure.php';
require_once "./classes/essences/BillPosition.php";
if (isset($_POST['bill_position_id'])) {
  $bill_position = new BillPosition();
  $bill_position->bill_id = Helper::clearInt($_POST["bill_id"]);
  $bill_position->bill_position_id = Helper::clearInt($_POST["bill_position_id"]);
  $bill_position->waybill_num = Helper::clearInt($_POST["waybill_num"]);
  $bill_position->car_id = Helper::clearInt($_POST["car_id"]);
  $bill_position->user_id = Helper::clearInt($_POST["user_id"]);
  $bill_position->fal_id = Helper::clearInt($_POST["fal_id"]);
  $bill_position->count = Helper::clearInt($_POST["count"]);
  if((new BillPositionService)->save($bill_position)) {
    if (isset($_POST["saveBillPosition"])) {
      if ($bill_position->bill_id === 0) {
        $lastBill = (new BillService)->findLast();
        header('Location: add-bill.php?id='.$lastBill->bill_id);
      } else {
        header('Location: add-bill.php?id='.$bill_position->bill_id);
      }
    } else {
      header('Location: list-bill.php');
    }
  } else {
    if ($bill_position->bill_id) {
      header('Location: add-bill-position.php?bill_id='.$bill_position->bill_id);
    } else {
      header('Location: add-bill.php');
    }
  }
  ob_end_flush();
  exit();
}
?>