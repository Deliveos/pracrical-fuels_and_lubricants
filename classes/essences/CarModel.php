<?php
class CarModel implements IEssence {
  public $car_model_id;
  public $name;

  public function validate() {
    if (isset($this->car_model_id) && !empty($this->name)) {
      return true;
    } else {
      return false;
    }
  }
}
