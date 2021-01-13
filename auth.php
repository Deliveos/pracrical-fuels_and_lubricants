<?php
session_start();
require_once 'autoload.php';
$message = 'Авторизaция';
if (isset($_SESSION['id'])) {
  header('Location: index.php');
  exit;
} elseif (isset($_POST['login']) && isset($_POST['password'])) {
  $login = Helper::clearString($_POST['login']);
  $password = Helper::clearString($_POST['password']);
  $userService = new UserService();
  $user = $userService->auth($login, $password);
  if ($user) {
    $_SESSION['id'] = $user->user_id;
    $_SESSION['position_id'] = $user->position_id;
    $_SESSION['position'] = $user->position;
    $_SESSION['fio'] = $user->fio;
    header('Location: index.php');
    exit;
  } else {
    $message = '<span style="color:red;">Некорректен логин или пароль</span>';
  }
}
require_once 'template/login.php';