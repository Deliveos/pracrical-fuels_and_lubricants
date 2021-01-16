<?php
require_once "secure.php";
$id = Helper::clearInt($_GET['id']);
  if((new FaLService())->delete($id)) {
    header('Location: list-fal.php');
  }
exit();
