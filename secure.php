<?php
session_start();
require_once 'autoload.php';
if (!isset($_SESSION['user_id']) || isset($_POST['out'])) {
  session_destroy();
  header('Location: auth.php');
  exit;
}