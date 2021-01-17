			date	 	
<?php
class Bill implements IEssence {
  public $bill_id;
  public $motor_depot_id;
  public $bill_num;
  public $date;
  public $refueller_id;

  public function validate() {
    if (isset($this->bill_id) && isset($this->motor_depot_id) && isset($this->refueller_id)) {
      return true;
    } else {
      return false;
    }
  }
}
