<?php
class DriverService  extends BaseService implements IService {
  public function save($user) {

  }

  public function delete($id) {
    if($this->db->exec("DELETE FROM user WHERE user_id=$id")) {
      return true;
    }
    return false;
  } 

  public function findById($id) {
    if($res = $this->db->query("SELECT user.user_id, user.surename, user.name, user.patronymic, user.birthday FROM user 
    WHERE user.role_id=2 AND user.user_id=$id")) {
      return $res->fetch(PDO::FETCH_OBJ);
    }
    return false;
  }

  public function arrDriver() {
    if($res = $this->db->query("SELECT user_id AS id, CONCAT(user.surename, ' ', user.name, ' ', user.patronymic) AS value FROM user WHERE role_id=2")) {
      return $res->fetchAll(PDO::FETCH_ASSOC);
    }
    return false;
  }
  
  public function findAll($ofset = 0, $limit = 20) {
    if($res = $this->db->query("SELECT user.user_id, CONCAT(user.surename, ' ', user.name, ' ', user.patronymic) AS fio, user.birthday FROM user
    WHERE role_id=2 LIMIT $ofset, $limit")) {
      return $res->fetchAll(PDO::FETCH_OBJ);
    }
    return false;
  }

  public function count() {
    $res = $this->db->query("SELECT COUNT(*) AS cnt FROM employee");
    return $res->fetch(PDO::FETCH_OBJ)->cnt;
  }
}