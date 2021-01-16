<?php
require_once "secure.php";
$id = Helper::clearInt($_GET['id']);
  if((new CarService())->delete($id)) {
    header('Location: list-car.php');
  }
exit();
