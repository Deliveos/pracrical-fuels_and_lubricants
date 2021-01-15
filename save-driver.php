<?php
require_once 'secure.php';
require_once "./classes/essences/User.php";
require_once "./classes/essences/Employee.php";
require_once "./classes/essences/Manager.php";
if (isset($_POST['user_id'])) {
  $user = new User();
  $user->surename = Helper::clearString($_POST['surename']);
  $user->user_id= Helper::clearInt($_POST['user_id']);
  $user->name = Helper::clearString($_POST['name']);
  $user->patronymic = Helper::clearString($_POST['patronymic']);
  $user->birthday = Helper::clearString($_POST['birthday']);
  $user->role_id = Helper::clearInt($_POST["role_id"]);
  if((new UserService)->save($user)) {
    if($user->user_id === 0) {
      $newUser = (new UserService)->findLast();
      header('Location: profile-driver.php?id='.$newUser->user_id);
    } else {
      header('Location: profile-driver.php?id='.$user->user_id);
    }
  } else {
    if ($user->user_id) {
        header('Location: add-driver.php?id='.$user->user_id);
    } else {
        header('Location: add-driver.php');
    }
  }
  exit();
}
?>