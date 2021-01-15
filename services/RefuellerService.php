<?php
class RefuellerService extends BaseService implements IService {
  public function save($refueller) {
    if ($refueller->validate()) {
      if ($refueller->refueller_id === 0) {
          return $this->insert($refueller);
      } else {
        return $this->update($refueller);
      }
    }
    return false;
  }

  public function delete($id) {
    if($this->db->exec("DELETE FROM refueller WHERE refueller_id=$id")) {
      return true;
    }
    return false;
  } 

  public function findById($id) {
    if($res = $this->db->query("SELECT user.user_id, refueller.refueller_id, CONCAT(user.surename, ' ', user.name, ' ', user.patronymic) AS fio, user.birthday, employee.employee_id, employee.active,
    position.position_id, position.name AS position, garage.num AS garage, motor_depot.motor_depot_id AS motor_depot_id, motor_depot.address AS motor_depot FROM refueller
    INNER JOIN employee ON refueller.employee_id=employee.employee_id 
    INNER JOIN user ON user.user_id=employee.user_id 
    INNER JOIN position ON employee.position_id=position.position_id
    INNER JOIN garage ON refueller.garage_id=garage.garage_id
    INNER JOIN motor_depot ON garage.motor_depot_id=motor_depot.motor_depot_id
    WHERE user.user_id=$id")) {
      return $res->fetch(PDO::FETCH_OBJ);
    }
    return false;
  }

  public function findAll($ofset = 0, $limit = 20) {
    if($res = $this->db->query("SELECT user.user_id, CONCAT(user.surename, ' ', user.name, ' ', user.patronymic) AS fio, user.birthday,
    position.position_id, position.name AS position, garage.num AS garage, motor_depot.address AS motor_depot FROM refueller
    INNER JOIN employee ON refueller.employee_id=employee.employee_id 
    INNER JOIN user ON user.user_id=employee.user_id 
    INNER JOIN position ON employee.position_id=position.position_id 
    INNER JOIN garage ON refueller.garage_id=garage.garage_id
    INNER JOIN motor_depot ON garage.motor_depot_id=motor_depot.motor_depot_id LIMIT $ofset, $limit")) {
      return $res->fetchAll(PDO::FETCH_OBJ);
    }
    return false;
  }

  public function count() {
    $res = $this->db->query("SELECT COUNT(*) AS cnt FROM employee");
    return $res->fetch(PDO::FETCH_OBJ)->cnt;
  }

  private function insert(Refueller $refueller) {
    if ($this->db->exec("INSERT INTO refueller(employee_id, garage_id, motor_depot_id) 
    VALUES($refueller->employee_id, $refueller->garage_id, $refueller->motor_depot_id)") == 1) {
      return true;
    }
    return false;
  }

  private function update(Refueller $refueller) {
    if ($this->db->exec("UPDATE refueller SET motor_depot_id=$refueller->motor_depot_id, garage_id=$refueller->garage_id WHERE refueller_id=".$refueller->refueller_id) == 1) {
      return true;
    }
    return false;
  }
}