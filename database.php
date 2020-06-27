<?php

// Lib By Léon ==> Read the README.MD for the documentation

class DB
{
  private $path = '';
  private $db = [];

  public function __construct($path = "db.json"){
    $this->path = $path;

    if(!file_exists($path)){
      if(strpos($path, '.json') === false){ $path .= '.json'; }
      $fp = fopen($path,"wb");
      fwrite($fp, "{}");
      fclose($fp);
    }

    $this->db = json_decode(file_get_contents($path), true);
  }

  private function save(){
    $json = ($this->db === "{}") ? $this->db : json_encode($this->db);

    file_put_contents($this->path, $json);
  }

  public function insert($data, $key = ""){
    if($key !== "")
      $this->db[$key] = $data;
    else
      $this->db[] = $data;

    $this->save();

    return $this;
  }

  public function delete($key){
    unset($this->db[$key]);

    $this->save();

    return $this;
  }

  public function getSingle($key){
    return $this->db[$key];
  }

  public function getList($conditions = [], $orderBy = []){
    $result = [];

    if(empty($conditions)){
      $result = $this->db;
    }else{
      foreach($this->db as $key => $value){
        $requirements = true;

        foreach($conditions as $k => $v){
          if($value[$k] !== $v){
            $requirements = false;
          }
        }

        if($requirements) $result[$key] = $value;
      }
    }

    if($orderBy['on'] !== '' && $orderBy['order'] !== ''){
      usort($result, function($first, $second) use($orderBy){
        if($orderBy['order'] === "ASC"){
          return strcmp($first[$orderBy['on']], $second[$orderBy['on']]) > 0;
        }else{
          return strcmp($first[$orderBy['on']], $second[$orderBy['on']]) < 0;
        }
      });
    }

    return $result;
  }

  public function clear(){
    $this->db = "{}";

    $this->save();

    return $this;
  }
}
?>
