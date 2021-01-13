<?php
class Employee implements IEssence {
  public $employee_id;
  public $user_id;
  public $position_id;

  public function validate() {
    if (!empty($this->employee_id) 
    && !empty($this->user_id)
    && !empty($this->position_id)) {
      return true;
    } else {
      return false;
    }
  }
}
