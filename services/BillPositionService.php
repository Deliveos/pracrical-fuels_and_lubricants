<?php
class BillPositionService  extends BaseService implements IService {
  public function save($bill_position) {
    if ($bill_position->validate()) {
      if ($bill_position->bill_position_id === 0) {
          return $this->insert($bill_position);
      } else {
        return $this->update($bill_position);
      }
    }
    return false;
  }

  public function delete($id) {
    if($this->db->exec("DELETE FROM bill_position WHERE bill_position_id=$id")) {
      return true;
    }
    return false;
  } 

  public function findById($id) {
    if($res = $this->db->query("SELECT bill_position.bill_position_id, bill_position.bill_id, car.car_id, car.state_num, 
    car_model.car_model_id, car_model.name AS model, bill_position.waybill_num AS waybill_num, user.user_id, fal_id, 
    CONCAT(user.surename, ' ', user.name, ' ', user.patronymic) AS fio FROM bill_position
    INNER JOIN car ON bill_position.car_id=car.car_id
    INNER JOIN car_model ON car.car_model_id=car_model.car_model_id
    INNER JOIN user ON bill_position.user_id=user.user_id
    WHERE bill_position.bill_position_id=$id AND user.role_id=2")) {
      return $res->fetch(PDO::FETCH_OBJ);
    }
    return false;
  }

  public function findByBillId($id) {
    if($res = $this->db->query("SELECT bill_position.bill_position_id, bill_position.bill_id, car.car_id, car.state_num, 
    car_model.car_model_id, car_model.name AS model, bill_position.waybill_num, bill_position.fal_id, fal.name AS fal, count,
    CONCAT(user.surename, ' ', user.name, ' ', user.patronymic) AS fio FROM bill_position
    INNER JOIN car ON bill_position.car_id=car.car_id
    INNER JOIN car_model ON car.car_model_id=car_model.car_model_id
    INNER JOIN user ON bill_position.user_id=user.user_id
    INNER JOIN fal ON bill_position.fal_id=fal.fal_id
    WHERE bill_position.bill_id=$id AND user.role_id=2")) {
      return $res->fetchAll(PDO::FETCH_OBJ);
    }
    return false;
  }

  public function findAll($ofset = 0, $limit = 20) {
    if($res = $this->db->query("SELECT bill_position.bill_position_id, bill_position.bill_id, car.car_id, car.state_num, 
    car_model.car_model_id, car_model.name AS model, bill_position.waybill_num, 
    CONCAT(user.surename, ' ', user.name, ' ', user.patronymic) AS fio FROM bill_position
    INNER JOIN car ON bill_position.car_id=car.car_id
    INNER JOIN car_model ON car.car_model_id=car_model.car_model_id
    INNER JOIN user ON bill_position.user_id LIMIT $ofset, $limit")) {
      return $res->fetchAll(PDO::FETCH_OBJ);
    }
    return false;
  }

  public function findAllOfRange($start, $end) {
    $start = $this->db->quote($start);
    $end = $this->db->quote($end);
    if ($res = $this->db->query("SELECT fal.name, SUM(COUNT) AS cnt, unit.name AS unit FROM bill_position
    INNER JOIN bill ON bill_position.bill_id=bill.bill_id
      INNER JOIN fal ON bill_position.fal_id=fal.fal_id
      INNER JOIN unit ON fal.unit_id=unit.unit_id
  WHERE bill.date BETWEEN $start AND $end GROUP BY fal.fal_id")) {
    return $res->fetchAll(PDO::FETCH_OBJ);
  }
}

public function findAllOfRangeByGarageId($start, $end, $garage_id) {
  $start = $this->db->quote($start);
  $end = $this->db->quote($end);
  if ($res = $this->db->query("SELECT fal.name, SUM(COUNT) AS cnt, unit.name AS unit FROM bill_position
	INNER JOIN bill ON bill_position.bill_id=bill.bill_id
    INNER JOIN fal ON bill_position.fal_id=fal.fal_id
    INNER JOIN unit ON fal.unit_id=unit.unit_id
    INNER JOIN refueller ON bill.refueller_id=refueller.refueller_id
  WHERE refueller.garage_id=$garage_id AND bill.date BETWEEN $start AND $end GROUP BY fal.fal_id")) {
  return $res->fetchAll(PDO::FETCH_OBJ);
  }
}

public function findAllOfRangeByDriver($start, $end, $user_id) {
  $start = $this->db->quote($start);
  $end = $this->db->quote($end);
  if ($res = $this->db->query("SELECT fal.name, SUM(COUNT) AS cnt, unit.name AS unit FROM bill_position
  INNER JOIN bill ON bill_position.bill_id=bill.bill_id
    INNER JOIN fal ON bill_position.fal_id=fal.fal_id
    INNER JOIN unit ON fal.unit_id=unit.unit_id
WHERE bill_position.user_id=$user_id AND bill.date BETWEEN $start AND $end GROUP BY fal.fal_id")) {
  return $res->fetchAll(PDO::FETCH_OBJ);
}
}

  public function findLast() {
    if($res = $this->db->query("SELECT bill.bill_id, motor_depot.motor_depot_id, motor_depot.address, 
    bill.bill_num, bill.date, refueller.refueller_id, refueller.garage_id, garage.num AS garage_num, 
    CONCAT(user.surename, ' ', user.name, ' ', user.patronymic) AS fio FROM bill
    INNER JOIN motor_depot ON bill.motor_depot_id=motor_depot.motor_depot_id
    INNER JOIN refueller ON bill.refueller_id=refueller.refueller_id
    INNER JOIN garage ON refueller.garage_id=garage.garage_id
    INNER JOIN employee ON refueller.employee_id=employee.employee_id
    INNER JOIN user ON employee.user_id=user.user_id
    WHERE bill.bill_id=(SELECT max(bill_id) FROM bill)")) {
      return $res->fetch(PDO::FETCH_OBJ);
    }
    return false;
  }

  public function count() {
    $res = $this->db->query("SELECT COUNT(*) AS cnt FROM bill");
    return $res->fetch(PDO::FETCH_OBJ)->cnt;
  }

  private function insert(BillPosition $bill) {
    if ($this->db->exec("INSERT INTO bill_position(bill_id,	waybill_num,	fal_id,	user_id,	car_id, count) 
    VALUES($bill->bill_id, $bill->waybill_num, $bill->fal_id, $bill->user_id, $bill->car_id, $bill->count)") == 1) {
      return true;
    }
    return false;
  }

  private function update(BillPosition $bill) {
    if ($this->db->exec("UPDATE bill_position SET waybill_num=$bill->waybill_num, bill_id=$bill->bill_id, 
    fal_id=$bill->fal_id, user_id=$bill->user_id, car_id=$bill->car_id, count=$bill->count WHERE bill_id=".$bill->bill_id) == 1) {
      return true;
    }
    return false;
  }
}