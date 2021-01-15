<?php
class UserService extends BaseService implements IService {
  public function save($user) {
    if ($user->validate()) {
      if ($user->user_id == 0) {
          return $this->insert($user);
      } else {
        return $this->update($user);
      }
    }
    return false;
  }

  public function delete($id) {
    if ($this->db->exec("DELETE FROM user WHERE user_id=$id") == 1) {
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

  public function findLast() {
    if($res = $this->db->query("SELECT user.user_id, user.surename, user.name, user.patronymic, user.birthday
    FROM user WHERE user.user_id=(SELECT max(user_id) FROM user)")) {
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

  private function insert(User $user) {
    $name = $this->db->quote($user->name);
    $surename = $this->db->quote($user->surename);
    $patronymic = $this->db->quote($user->patronymic);
    $birthday = $this->db->quote($user->birthday);
    if ($this->db->exec("INSERT INTO user(user_id, surename, name, patronymic, birthday, role_id) 
    VALUES($user->user_id, $surename, $name, $patronymic, $birthday, $user->role_id)") == 1) {
      return true;
    }
    return false;
  }

  private function update(User $user) {
    $name = $this->db->quote($user->name);
    $surename = $this->db->quote($user->surename);
    $patronymic = $this->db->quote($user->patronymic);
    $birthday = $this->db->quote($user->birthday);
    if ($this->db->exec("UPDATE user SET user.name=$name, surename=$surename, patronymic=$patronymic, birthday=$birthday WHERE user_id=$user->user_id") == 1) {
      return true;
    }
    return false;
  }
}