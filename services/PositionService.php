<?php
class PositionService extends BaseService implements IService {
  public function save($user) {

  }

  public function delete($id) {

  } 

  public function findById($id) {
    $id = Helper::clearInt($id);
    if($res = $this->db->query("SELECT CONCAT(employee.surename, ' ', employee.name, ' ', employee.patronymic) AS fio, 
    position.position_id, position.name AS position, user.login FROM user 
    INNER JOIN employee ON user.employee_id=employee.employee_id INNER JOIN position ON employee.position_id=position.position_id
    WHERE user_id=$id")) {
      return $res->fetch(PDO::FETCH_OBJ);
    }
    return false;
  }

  public function findAll($ofset = 0, $limit = 20) {
    if($res = $this->db->query("SELECT CONCAT(employee.surename, ' ', employee.name, ' ', employee.patronymic) AS fio,  employee.birthday,
    position.position_id, position.name AS position, user.login FROM user 
    INNER JOIN employee ON user.employee_id=employee.employee_id INNER JOIN position ON employee.position_id=position.position_id  LIMIT $ofset, $limit")) {
      return $res->fetchAll(PDO::FETCH_OBJ);
    }
    return false;
  }

  public function count() {
    $res = $this->db->query("SELECT COUNT(*) AS cnt FROM user");
    return $res->fetch(PDO::FETCH_OBJ)->cnt;
  }

  public function arrPosition() {
    if($res = $this->db->query("SELECT position_id AS id, name AS value FROM position")) {
      return $res->fetch(PDO::FETCH_ASSOC);
    }
    return false;
  }
}
