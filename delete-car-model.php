<?php
require_once "secure.php";
$id = Helper::clearInt($_GET['id']);
  if((new CarModelService())->delete($id)) {
    header('Location: list-car-model.php');
  }
exit();
