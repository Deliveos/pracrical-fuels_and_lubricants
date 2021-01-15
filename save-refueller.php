<?php
  require_once 'secure.php';
  require_once "./classes/essences/User.php";
  require_once "./classes/essences/Employee.php";
  require_once "./classes/essences/Refueller.php";
  if (isset($_POST['user_id'])) {
    $user = new User();
    $user->surename = Helper::clearString($_POST['surename']);
    $user->user_id= Helper::clearInt($_POST['user_id']);
    $user->name = Helper::clearString($_POST['name']);
    $user->patronymic = Helper::clearString($_POST['patronymic']);
    $user->birthday = Helper::clearString($_POST['birthday']);
    $user->role_id = Helper::clearInt($_POST["role_id"]);

    // save user
    if((new UserService)->save($user)) {
      if (isset($_POST['saveRefueller'])) {
        $employee = new Employee();
        $employee->employee_id = Helper::clearInt($_POST["employee_id"]);
        if($user->user_id === 0) {
          $newUser = (new UserService)->findLast();
          $employee->user_id = $newUser->user_id;
        } else {
          $employee->user_id = $user->user_id;
        }
        $employee->position_id = Helper::clearInt($_POST["position_id"]);
        $employee->active = Helper::clearInt($_POST['active']);

        // save employee
        if ((new EmployeeService())->save($employee)) {
          $refueller = new Refueller();
          $refueller->refueller_id = Helper::clearInt($_POST["refueller_id"]);
          if ($employee->employee_id === 0) {
            $newEmployee = (new EmployeeService())->findLast();
            $refueller->employee_id = Helper::clearInt($newEmployee->employee_id);
          } else {
            $refueller->employee_id = Helper::clearInt($_POST["employee_id"]);
          }
          $refueller->garage_id = Helper::clearInt($_POST['garage_id']);
          $refueller->motor_depot_id = Helper::clearInt($_POST['motor_depot_id']);

          // save refueller
          if ((new RefuellerService())->save($refueller)) {
            if($user->user_id === 0) {
              $newUser = (new UserService)->findLast();
              header('Location: profile-refueller.php?id='.$newUser->user_id);
            } else {
              header('Location: profile-refueller.php?id='.$user->user_id);
            }
          } else {
            if ($user->user_id) {
              header('Location: add-refueller.php?id='.$user->user_id);
            } else {
              header('Location: add-refueller.php');
            }
          }
        }
        exit();
      }
    }
  }
?>