date	 	
<?php
class BillPosition implements IEssence {
  public $bill_id;
  public $bill_position_id;
  public $waybill_num;
  public $fal_id;
  public $user_id;
  public $car_id;
  public $count;

  public function validate() {
    if (isset($this->bill_id) && isset($this->bill_position_id) && isset($this->waybill_num) &&
    isset($this->fal_id) && isset($this->user_id) && isset($this->car_id)) {
      return true;
    } else {
      return false;
    }
  }
}