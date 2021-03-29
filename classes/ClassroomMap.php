<?php

class ClassroomMap extends BaseMap {

  private function insert($classroom)
  {
    $name = $this->db->quote($classroom->name);
    if ($this->db->exec("INSERT INTO classroom(name, active) VALUES($name, $classroom->active)") == 1) {
      $classroom->classroom_id = $this->db->lastInsertId();
      return true;
    }
    return false;
  }

  private function update($classroom)
  {
    $name = $this->db->quote($classroom->name);
    if ( $this->db->exec("UPDATE classroom SET name = $name, active = $classroom->active WHERE classroom_id = ".$classroom->classroom_id) == 1) {
      return true;
    }
  }

  public function arrClassrooms()
  {
    $res = $this->db->query("SELECT classroom_id AS id, name AS value FROM classroom");
    return $res->fetchAll(PDO::FETCH_ASSOC);
  }

  public function findById($id = null)
  {
    if ($id) {
      $res = $this->db->query("SELECT classroom_id, name, active FROM classroom"
      . " WHERE classroom_id = $id");
      return $res->fetchObject("Classroom");
    }
    return new Classroom();
  }

  public function findViewById($id = null)
  {
    if ($id) {
      $res = $this->db->query("SELECT classroom_id, name, active FROM classroom WHERE classroom_id = $id");
      return $res->fetch(PDO::FETCH_OBJ);
    }
    return false;
  }

  public function findAll($ofset = 0, $limit = 30)
  {
    $res = $this->db->query("SELECT classroom_id, name FROM classroom LIMIT $ofset, $limit");
    return $res->fetchAll(PDO::FETCH_OBJ);
  }

  public function count()
  {
    $res = $this->db->query("SELECT COUNT(*) AS cnt FROM classroom");
    return $res->fetch(PDO::FETCH_OBJ)->cnt;
  }

  public function save($classroom)
  {
    if ($classroom->validate()) {
      if ($classroom->classroom_id == 0) {
        return $this->insert($classroom);
      } 
      else {
        return $this->update($classroom);
      }
    }
  }

}
