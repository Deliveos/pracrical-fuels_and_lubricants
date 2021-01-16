<?php
class FaLService  extends BaseService implements IService {
  public function save($fal) {
    if ($fal->validate()) {
      if ($fal->fal_id === 0) {
          return $this->insert($fal);
      } else {
        return $this->update($fal);
      }
    }
    return false;
  }

  public function delete($id) {
    if($this->db->exec("DELETE FROM fal WHERE fal_id=$id")) {
      return true;
    }
    return false;
  } 

  public function findById($id) {
    if($res = $this->db->query("SELECT fal.fal_id, fal.name, unit.unit_id, unit.name AS unit FROM fal
    INNER JOIN unit ON fal.unit_id=unit.unit_id
    WHERE fal_id=$id")) {
      return $res->fetch(PDO::FETCH_OBJ);
    }
    return false;
  }

  public function findAll($ofset = 0, $limit = 20) {
    if($res = $this->db->query("SELECT fal.fal_id, fal.name, unit.unit_id, unit.name AS unit FROM fal
    INNER JOIN unit ON fal.unit_id=unit.unit_id LIMIT $ofset, $limit")) {
      return $res->fetchAll(PDO::FETCH_OBJ);
    }
    return false;
  }

  public function findLast() {
    if($res = $this->db->query("SELECT fal.fal_id, fal.name, unit.unit_id, unit.name AS unit FROM fal
    INNER JOIN unit ON fal.unit_id=unit_unit_id
    WHERE fal_id=(SELECT max(fal_id) FROM fal)")) {
      return $res->fetch(PDO::FETCH_OBJ);
    }
    return false;
  }

  public function count() {
    $res = $this->db->query("SELECT COUNT(*) AS cnt FROM fal");
    return $res->fetch(PDO::FETCH_OBJ)->cnt;
  }

  public function arrFaL() {
    if($res = $this->db->query("SELECT fal_id AS id, name AS value FROM fal")) {
      return $res->fetchAll(PDO::FETCH_ASSOC);
    }
    return false;
  }

  private function insert(FaL $fal) {
    $name = $this->db->quote($fal->name);
    if ($this->db->exec("INSERT INTO fal(name, unit_id) 
    VALUES($name, $fal->unit_id)") == 1) {
      return true;
    }
    return false;
  }

  private function update(FaL $fal) {
    $name = $this->db->quote($fal->name);
    if ($this->db->exec("UPDATE fal SET name=$name, unit_id=$fal->unit_id WHERE fal_id=".$fal->fal_id) == 1) {
      return true;
    }
    return false;
  }
}