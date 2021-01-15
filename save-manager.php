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
          if (isset($_POST['saveManager'])) {
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
            if ((new EmployeeService())->save($employee)) {
              $manager = new Manager();
              $manager->manager_id = Helper::clearInt($_POST["manager_id"]);
              if ($employee->employee_id === 0) {
                $newEmployee = (new EmployeeService())->findLast();
                $manager->employee_id = $newEmployee->employee_id;
              } else {
                $manager->employee_id = Helper::clearInt($_POST["employee_id"]);
              }
              $manager->login = Helper::clearString($_POST['login']);
              $manager->password = password_hash(Helper::clearString($_POST['password']), PASSWORD_BCRYPT);
              if ((new ManagerService())->save($manager)) {
                if($user->user_id === 0) {
                  $newUser = (new UserService)->findLast();
                  header('Location: profile-manager.php?id='.$newUser->user_id);
                } else {
                  header('Location: profile-manager.php?id='.$user->user_id);
                }
                
              } else {
                if ($user->user_id) {
                    header('Location: add-manager.php?id='.$user->user_id);
                } else {
                    header('Location: add-manager.php');
                }
              }
            }
            exit();
          }
        }
    }
?>