<?php
class CarService  extends BaseService implements IService {
  public function save($car) {
    if ($car->validate()) {
      if ($car->car_id === 0) {
          return $this->insert($car);
      } else {
        return $this->update($car);
      }
    }
    return false;
  }

  public function delete($id) {
    if($this->db->exec("DELETE FROM car WHERE car_id=$id")) {
      return true;
    }
    return false;
  } 

  public function findById($id) {
    if($res = $this->db->query("SELECT car.car_id, car_model.car_model_id, car.state_num, car_model.name AS model FROM car
    INNER JOIN car_model ON car.car_model_id=car_model.car_model_id 
    WHERE car_id=$id")) {
      return $res->fetch(PDO::FETCH_OBJ);
    }
    return false;
  }

  public function findAll($ofset = 0, $limit = 20) {
    if($res = $this->db->query("SELECT car.car_id, car_model.car_model_id, car.state_num, car_model.name AS model FROM car
    INNER JOIN car_model ON car.car_model_id=car_model.car_model_id LIMIT $ofset, $limit")) {
      return $res->fetchAll(PDO::FETCH_OBJ);
    }
    return false;
  }

  public function findLast() {
    if($res = $this->db->query("SELECT car.car_id, car_model.car_model_id, car.state_num, car_model.name AS model FROM car
    INNER JOIN car_model ON car.car_model_id=car_model.car_model_id 
    WHERE car_id=(SELECT max(car_id) FROM car)")) {
      return $res->fetch(PDO::FETCH_OBJ);
    }
    return false;
  }

  public function arrCar() {
    if($res = $this->db->query("SELECT car_id AS id, state_num AS value FROM car")) {
      return $res->fetchAll(PDO::FETCH_ASSOC);
    }
    return false;
  }

  public function count() {
    $res = $this->db->query("SELECT COUNT(*) AS cnt FROM car");
    return $res->fetch(PDO::FETCH_OBJ)->cnt;
  }

  private function insert(Car $car) {
    $state_num = $this->db->quote($car->state_num);
    if ($this->db->exec("INSERT INTO car(state_num, car_model_id) VALUES($state_num, $car->car_model_id)") == 1) {
      return true;
    }
    return false;
  }

  private function update(Car $car) {
    $state_num = $this->db->quote($car->state_num);
    if ($this->db->exec("UPDATE car SET state_num=$state_num, car_model_id=$car->car_model_id WHERE car_id=".$car->car_id) == 1) {
      return true;
    }
    return false;
  }
}