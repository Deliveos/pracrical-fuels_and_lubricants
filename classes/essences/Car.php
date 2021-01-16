<?php
class Car implements IEssence {
  public $car_id;
  public $state_num;
  public $car_model_id;

  public function validate() {
    if (!empty($this->state_num)) {
      return true;
    } else {
      return false;
    }
  }
}
