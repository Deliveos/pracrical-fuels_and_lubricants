<?php
require_once 'secure.php';
require_once "./classes/essences/FaL.php";
if (isset($_POST['met'])) {
  $fal = new Fal();
  $fal->fal_id = Helper::clearInt($_POST["fal_id"]);
  $fal->name = Helper::clearString($_POST["name"]);
  $fal->unit_id = Helper::clearInt($_POST["unit_id"]);
  if((new FaLService)->save($fal)) {
    header('Location: list-fal.php');
  } else {
    if ($fal->fal_id) {
      header('Location: add-fal.php?id='.$fal->fal_id);
    } else {
      header('Location: add-fal.php');
    }
  }
  exit();
}
?>