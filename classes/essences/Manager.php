<?php
class Manager implements IEssence {
  public $manager_id;
  public $employee_id;
  public $login;
  public $password;
  
  public function validate() {
    if (!empty($this->login) && !empty($this->password)) {
      return true;
    } else {
      return false;
    }
  }
}