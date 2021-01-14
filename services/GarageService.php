<?php
class GarageService extends BaseService implements IService {
  public function save($user) {

  }

  public function delete($id) {
    if($this->db->exec("DELETE FROM manager 
    INNER JOIN employee ON manager.employee_id=employee.employee_id 
    INNER JOIN user ON employee.user_id=user.user_id 
    WHERE user_id=$id")) {
      return true;
    }
    return false;
  } 

  public function findById($id) {
    if($res = $this->db->query("SELECT user.user_id, user.surename, user.name, user.patronymic, user.birthday, employee.active, manager.login AS login,
    position.position_id, position.name AS position FROM manager
    INNER JOIN employee ON employee.employee_id=manager.employee_id 
    INNER JOIN user ON employee.user_id=user.user_id
    INNER JOIN position ON employee.position_id=position.position_id
    WHERE user.user_id=$id")) {
      return $res->fetch(PDO::FETCH_OBJ);
    }
    return false;
  }

  public function findAll($ofset = 0, $limit = 20) {
    if($res = $this->db->query("SELECT user.user_id, CONCAT(user.surename, ' ', user.name, ' ', user.patronymic) AS fio,  user.birthday, employee.active,
    position.position_id, position.name AS position FROM manager
    INNER JOIN employee ON employee.employee_id=manager.employee_id 
    INNER JOIN user ON employee.user_id=user.user_id
    INNER JOIN position ON employee.position_id=position.position_id
    LIMIT $ofset, $limit")) {
      return $res->fetchAll(PDO::FETCH_OBJ);
    }
    return false;
  }

  public function count() {
    $res = $this->db->query("SELECT COUNT(*) AS cnt FROM employee");
    return $res->fetch(PDO::FETCH_OBJ)->cnt;
  }

  public function arrGarage($motor_depot_id) {
    if($res = $this->db->query("SELECT garage_id AS id, num AS value FROM garage WHERE motor_depot_id=$motor_depot_id")) {
      return $res->fetchAll(PDO::FETCH_ASSOC);
    }
    return false;
  }

  public function findByNumAndMotorDepot($garage_num, $motor_depot_id) {
    if($res = $this->db->query("SELECT garage_id AS id, num AS value FROM garage WHERE garage_num=$garage_num AND motor_depot_id=$motor_depot_id")) {
      return $res->fetchAll(PDO::FETCH_ASSOC);
    }
    return false;
  }
}