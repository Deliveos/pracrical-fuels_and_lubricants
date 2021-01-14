<?php
class MotorDepotService extends BaseService implements IService {
  public function save($motor_depot) {

  }

  public function delete($id) {
    if ($this->db->exec("DELETE FROM schedule WHERE schedule_id=$id") == 1) {
      return true;
    }
    return false;
  } 

  public function findById($id) {
    $id = Helper::clearInt($id);
    if($res = $this->db->query("SELECT user.user_id, user.surename, user.name, user.patronymic, user.birthday
    FROM user WHERE user.user_id=$id")) {
      return $res->fetch(PDO::FETCH_OBJ);
    }
    return false;
  }

  public function findAll($ofset = 0, $limit = 20) {
    if($res = $this->db->query("SELECT CONCAT(user.surename, ' ', user.name, ' ', user.patronymic) AS fio, user.birthday, 
    position.position_id, position.name AS position, manager.login FROM user 
    INNER JOIN employee ON employee.user_id=user.user_id INNER JOIN position ON employee.position_id=position.position_id
    INNER JOIN manager ON manager.employee_id=employee.employee_id
    LIMIT $ofset, $limit")) {
      return $res->fetchAll(PDO::FETCH_OBJ);
    }
    return false;
  }

  public function findByLogin($login) {
    $login = Helper::clearString($login);
    $login = $this->db->quote($login);
    if($res = $this->db->query("SELECT * FROM user WHERE login=$login")) {
      return $res->fetch(PDO::FETCH_OBJ);
    }
    return false;
  }

  public function auth($login, $password) {
    $login = $this->db->quote($login);
    $res = $this->db->query("SELECT user.user_id, CONCAT(user.surename, ' ', user.name, ' ', user.patronymic) AS fio, 
    position.position_id, position.name AS position, manager.login, manager.password FROM manager 
    INNER JOIN employee ON manager.employee_id=employee.employee_id 
    INNER JOIN position ON employee.position_id=position.position_id 
    INNER JOIN user ON employee.user_id=user.user_id
    WHERE manager.login = $login");
    $user = $res->fetch(PDO::FETCH_OBJ);
    if ($user) {
      if (password_verify($password, $user->password)) {
        return $user;
      }
    }
    return null;
  }

  public function count() {
    $res = $this->db->query("SELECT COUNT(*) AS cnt FROM user");
    return $res->fetch(PDO::FETCH_OBJ)->cnt;
  }

  public function arrMotorDepot() {
    if($res = $this->db->query("SELECT motor_depot_id AS id, address AS value FROM motor_depot")) {
      return $res->fetchAll(PDO::FETCH_ASSOC);
    }
    return false;
  }
}