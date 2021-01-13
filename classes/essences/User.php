<?php
class User implements IEssence {
  public $user_id;
  public $surname;
  public $name;
  public $patronymic;
  public $birthday;
  public $role_id;
  
  public function validate() {
    if (!empty($this->user_id) 
    && !empty($this->surname)
    && !empty($this->name) 
    && !empty($this->patronymic) 
    && !empty($this->birthday) 
    && !empty($this->role_id)) {
      return true;
    } else {
      return false;
    }
  }
}
