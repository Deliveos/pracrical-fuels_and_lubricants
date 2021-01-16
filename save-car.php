<?php
require_once 'secure.php';
require_once "./classes/essences/Car.php";
if (isset($_POST['car_id'])) {
  $car = new Car();
  $car->car_id = Helper::clearInt($_POST["car_id"]);
  $car->state_num = Helper::clearString($_POST["state_num"]);
  $car->car_model_id = Helper::clearInt($_POST["car_model_id"]);
  if((new CarService)->save($car)) {
    header('Location: list-car.php');
  } else {
    if ($car->car_id) {
      header('Location: add-car.php?id='.$car->car_id);
    } else {
      header('Location: add-car.php');
    }
  }
  exit();
}
?>