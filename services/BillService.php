<?php
class BillService  extends BaseService implements IService {
  public function save($bill) {
    if ($bill->validate()) {
      if ($bill->car_id === 0) {
          return $this->insert($bill);
      } else {
        return $this->update($bill);
      }
    }
    return false;
  }

  public function delete($id) {
    if($this->db->exec("DELETE FROM bill WHERE bill_id=$id")) {
      return true;
    }
    return false;
  } 

  public function findById($id) {
    if($res = $this->db->query("SELECT bill.bill_id, motor_depot.motor_depot_id, motor_depot.address AS motor_depot, 
    bill.bill_num, bill.date, refueller.refueller_id, refueller.garage_id, garage.num AS garage_num, 
    CONCAT(user.surename, ' ', user.name, ' ', user.patronymic) AS fio FROM bill
    INNER JOIN motor_depot ON bill.motor_depot_id=motor_depot.motor_depot_id
    INNER JOIN refueller ON bill.refueller_id=refueller.refueller_id
    INNER JOIN garage ON refueller.garage_id=garage.garage_id
    INNER JOIN employee ON refueller.employee_id=employee.employee_id
    INNER JOIN user ON employee.user_id=user.user_id
    WHERE bill.bill_id=$id")) {
      return $res->fetch(PDO::FETCH_OBJ);
    }
    return false;
  }

  public function findAll($ofset = 0, $limit = 20) {
    if($res = $this->db->query("SELECT bill.bill_id, motor_depot.motor_depot_id, motor_depot.address AS motor_depot, 
    bill.bill_num, bill.date, refueller.refueller_id, refueller.garage_id, garage.num AS garage_num, 
    CONCAT(user.surename, ' ', user.name, ' ', user.patronymic) AS fio FROM bill
    INNER JOIN motor_depot ON bill.motor_depot_id=motor_depot.motor_depot_id
    INNER JOIN refueller ON bill.refueller_id=refueller.refueller_id
    INNER JOIN garage ON refueller.garage_id=garage.garage_id
    INNER JOIN employee ON refueller.employee_id=employee.employee_id
    INNER JOIN user ON employee.user_id=user.user_id LIMIT $ofset, $limit")) {
      return $res->fetchAll(PDO::FETCH_OBJ);
    }
    return false;
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

  private function insert(Bill $bill) {
    if ($this->db->exec("INSERT INTO bill(bill_id,	motor_depot_id,	bill_num,	date,	refueller_id) 
    VALUES($bill->bill_id, $bill->motor_depot_id, $bill->bill_num, $bill->date, $bill->refueller_id)") == 1) {
      return true;
    }
    return false;
  }

  private function update(Bill $bill) {
    if ($this->db->exec("UPDATE bill SET motor_depot_id=$bill->motor_depot_id, bill_num=$bill->bill_num, 
    date=$bill->date, refueller_id=$bill->refueller_id WHERE bill_id=".$bill->bill_id) == 1) {
      return true;
    }
    return false;
  }
}