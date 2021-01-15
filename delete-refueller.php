<?php
require_once "secure.php";
$id = Helper::clearInt($_GET['id']);
$refueller = (new RefuellerService)->findById($id);
if((new RefuellerService())->delete($refueller->refueller_id)) {
  if((new EmployeeService())->delete($id)) {
    if((new UserService())->delete($id)) {
      header('Location: list-refueller.php');
    }
  }
}
//header("Location: list-manager.php");
exit();
