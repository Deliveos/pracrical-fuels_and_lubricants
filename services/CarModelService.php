<?php
class CarModelService  extends BaseService implements IService {
  public function save($car_model) {
    if ($car_model->validate()) {
      if ($car_model->car_model_id == 0) {
          return $this->insert($car_model);
      } else {
        return $this->update($car_model);
      }
    }
    return false;
  }

  public function delete($id) {
    if($this->db->exec("DELETE FROM car_model WHERE car_model_id=$id")) {
      return true;
    }
    return false;
  } 

  public function findById($id) {
    if($res = $this->db->query("SELECT car_model_id, name  FROM car_model
    WHERE car_model_id=$id")) {
      return $res->fetch(PDO::FETCH_OBJ);
    }
    return false;
  }

  public function findAll($ofset = 0, $limit = 20) {
    if($res = $this->db->query("SELECT car_model_id, name  FROM car_model LIMIT $ofset, $limit")) {
      return $res->fetchAll(PDO::FETCH_OBJ);
    }
    return false;
  }

  public function findLast() {
    if($res = $this->db->query("SELECT car_model_id, name  FROM car_model
    WHERE car_model_id=(SELECT max(car_model_id) FROM car_model)")) {
      return $res->fetch(PDO::FETCH_OBJ);
    }
    return false;
  }

  public function count() {
    $res = $this->db->query("SELECT COUNT(*) AS cnt FROM car_model");
    return $res->fetch(PDO::FETCH_OBJ)->cnt;
  }

  public function arrCarModel() {
    if($res = $this->db->query("SELECT car_model_id AS id, name AS value FROM car_model")) {
      return $res->fetchAll(PDO::FETCH_ASSOC);
    }
    return false;
  }

  private function insert(CarModel $car_model) {
    $name = $this->db->quote($car_model->name);
    if ($this->db->exec("INSERT INTO car_model(name) 
    VALUES($name)") == 1) {
      return true;
    }
    return false;
  }

  private function update(CarModel $car_model) {
    $name = $this->db->quote($car_model->name);
    if ($this->db->exec("UPDATE car_model SET name=$name WHERE car_model_id=".$car_model->car_model_id) == 1) {
      return true;
    }
    return false;
  }
}