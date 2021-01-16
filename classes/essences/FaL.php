<?php
class FaL implements IEssence {
  public $fal_id, $unit_id = 0;
  public $name = '';

  public function validate() {
    if (isset($this->fal_id) && isset($this->unit_id) && !empty($this->name)) {
      return true;
    } else {
      return false;
    }
  }
}
