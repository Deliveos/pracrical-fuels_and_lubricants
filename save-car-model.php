<?php
require_once 'secure.php';
require_once "./classes/essences/CarModel.php";
if (isset($_POST['car_model_id'])) {
  $carModel = new CarModel();
  $carModel->car_model_id = Helper::clearInt($_POST["car_model_id"]);
  $carModel->name = Helper::clearString($_POST["name"]);
  if((new CarModelService)->save($carModel)) {
      header('Location: list-car-model.php');
  } else {
    if ($carModel->car_model_id) {
        header('Location: add-car-model.php?id='.$carModel->car_model_id);
    } else {
        header('Location: add-car-model.php');
    }
  }
  exit();
}
?>