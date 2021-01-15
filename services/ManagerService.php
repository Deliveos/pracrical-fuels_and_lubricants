<?php
class ManagerService extends BaseService implements IService {
  public function save($manager) {
    if ($manager->validate()) {
      if ($manager->manager_id == 0) {
          return $this->insert($manager);
      } else {
        return $this->update($manager);
      }
    }
    return false;
  }

  public function delete($id) {
    if($this->db->exec("DELETE FROM manager WHERE manager_id=$id")) {
      return true;
    }
    return false;
  } 

  public function findById($id) {
    if($res = $this->db->query("SELECT user.user_id, user.surename, user.name, user.patronymic, user.birthday, employee.employee_id, manager.manager_id, employee.active, manager.login AS login,
    position.position_id, position.name AS position FROM manager
    INNER JOIN employee ON employee.employee_id=manager.employee_id 
    
    INNER JOIN position ON employee.position_id=position.position_id INNER JOIN user ON employee.user_id=user.user_id
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

  private function insert(Manager $manager) {
    $login = $this->db->quote($manager->login);
    $password = $this->db->quote($manager->password);
    if ($this->db->exec("INSERT INTO manager(employee_id, login, password) 
    VALUES($manager->employee_id, $login, $password)") == 1) {
      return true;
    }
    return false;
  }

  private function update(Manager $manager) {
    $login = $this->db->quote($manager->login);
    $password = $this->db->quote($manager->password);
    if ($this->db->exec("UPDATE manager SET login=$login, password=$password WHERE manager_id=".$manager->manager_id) == 1) {
      return true;
    }
    return false;
  }
}