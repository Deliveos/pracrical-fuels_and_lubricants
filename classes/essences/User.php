<?php
class User implements IEssence {
  public $user_id;
  public $surename;
  public $name;
  public $patronymic;
  public $birthday;
  public $role_id;
  
  public function validate() {
    if (!empty($this->surename)
    && !empty($this->name) 
    && !empty($this->patronymic) 
    && !empty($this->birthday)) {
      return true;
    } else {
      return false;
    }
    return true;
  }
}
