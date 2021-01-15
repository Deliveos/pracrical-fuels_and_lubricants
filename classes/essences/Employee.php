<?php
class Employee implements IEssence {
  public $employee_id;
  public $user_id;
  public $position_id;
  public $active;

  public function validate() {
    if (isset($this->employee_id) 
    && isset($this->user_id)
    && isset($this->position_id)) {
      return true;
    } else {
      return false;
    }
  }
}
