<?php
require_once "secure.php";
$id = Helper::clearInt($_GET['id']);
$manager = (new ManagerService)->findById($id);
if((new ManagerService())->delete($manager->manager_id)) {
  if((new EmployeeService())->delete($id)) {
    if((new UserService())->delete($id)) {
      header('Location: list-manager.php');
    }
  }
}
//header("Location: list-manager.php");
exit();
