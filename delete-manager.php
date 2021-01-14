<?php
require_once "secure.php";
$id = Helper::clearInt($_GET['id']);
(new EmployeeService())->delete($id);
header('Location: list-employe.php');