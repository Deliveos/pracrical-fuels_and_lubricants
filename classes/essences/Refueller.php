<?php
class Refueller implements IEssence {
  public $refueller_id,	$garage_id,	$employee_id,	$motor_depot_id = 0;

  public function validate() {
    if (isset($this->refueller_id) && isset($this->garage_id) && isset($this->motor_depot_id)) {
      return true;
    } else {
      return false;
    }
  }
}