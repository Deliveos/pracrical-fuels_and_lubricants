<?php
require_once "secure.php";
$id = Helper::clearInt($_GET['id']);
  if((new UserService())->delete($id)) {
    header('Location: list-driver.php');
  }
//header("Location: list-manager.php");
exit();
