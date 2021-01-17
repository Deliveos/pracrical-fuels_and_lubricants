<?php
ob_start();
require_once 'secure.php';
require_once "./classes/essences/Bill.php";

if (isset($_POST['bill_id'])) {
  $bill = new Bill();
  $bill->bill_id = Helper::clearInt($_POST["bill_id"]);
  $bill->motor_depot_id = Helper::clearInt($_POST["motor_depot_id"]);
  $bill->bill_num = Helper::clearInt($_POST["bill_num"]);
  $bill->date = Helper::clearString($_POST["date"]);
  $bill->refueller_id = Helper::clearInt($_POST["refueller_id"]);
  if((new BillService)->save($bill)) {
    if (isset($_POST["addPosition"])) {
      if ($bill->bill_id === 0) {
        $lastBill = (new BillService)->findLast();
        header('Location: add-bill-position.php?bill_id='.$lastBill->bill_id);
      } else {
        header('Location: add-bill-position.php?bill_id='.$bill->bill_id);
      }
    } else {
      header('Location: list-bill.php');
    }
  } else {
    if ($bill->bill_id) {
      header('Location: add-bill-position.php?bill_id='.$bill->bill_id);
    } else {
      header('Location: add-bill.php');
    }
  }
  ob_end_flush();
  exit();
}

?>