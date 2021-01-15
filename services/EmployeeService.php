<?php
class EmployeeService extends BaseService implements IService {
  public function save($employee) {
    if ($employee->validate()) {
      if ($employee->manager_id == 0) {
          return $this->insert($employee);
      } else {
        return $this->update($employee);
      }
    }
    return false;
  }

  public function delete($id) {
    if($this->db->exec("DELETE FROM employee WHERE user_id=$id")) {
      return true;
    }
    return false;
  } 

  public function findById($id) {
    if($res = $this->db->query("SELECT user.user_id, CONCAT(user.surename, ' ', user.name, ' ', user.patronymic) AS fio,  user.birthday, employee.active,
    position.position_id, position.name AS position FROM user 
    INNER JOIN employee ON employee.user_id=user.user_id INNER JOIN position ON employee.position_id=position.position_id
    WHERE user.user_id=$id")) {
      return $res->fetch(PDO::FETCH_OBJ);
    }
    return false;
  }

  public function findLast() {
    if($res = $this->db->query("SELECT user.user_id, CONCAT(user.surename, ' ', user.name, ' ', user.patronymic) AS fio, employee.employee_id, user.birthday, employee.active,
    position.position_id, position.name AS position FROM employee 
    INNER JOIN user ON user.user_id=employee.user_id INNER JOIN position ON employee.position_id=position.position_id
    WHERE employee.employee_id=(SELECT max(employee_id) FROM employee)")) {
      return $res->fetch(PDO::FETCH_OBJ);
    }
    return false;
  }

  public function findAll($ofset = 0, $limit = 20) {
    if($res = $this->db->query("SELECT user.user_id, CONCAT(user.surename, ' ', user.name, ' ', user.patronymic) AS fio,  user.birthday,
    position.position_id, position.name AS position FROM employee 
    INNER JOIN user ON user.user_id=employee.user_id INNER JOIN position ON employee.position_id=position.position_id
    LIMIT $ofset, $limit")) {
      return $res->fetchAll(PDO::FETCH_OBJ);
    }
    return false;
  }

  public function count() {
    $res = $this->db->query("SELECT COUNT(*) AS cnt FROM employee");
    return $res->fetch(PDO::FETCH_OBJ)->cnt;
  }

  private function insert(Employee $employee) {
    if ($this->db->exec("INSERT INTO employee(user_id, position_id) 
    VALUES($employee->user_id, $employee->position_id)") == 1) {
      return true;
    }
    return false;
  }

  private function update(Employee $employee) {
    if ($this->db->exec("UPDATE employee SET position_id=$employee->position_id WHERE employee_id=".$employee->employee_id) == 1) {
      return true;
    }
    return false;
  }
}