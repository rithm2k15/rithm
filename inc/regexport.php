<?php
$db_name     = "rithm2k15";
$db_password = "regency";
$db_link     = mysqli_connect("localhost", "rithm2k15", "regency","rithm2k15"); 
mysqli_query($db_link,"SET NAMES UTF8");
$table = "reg";


function assoc_query_2D($db_link ,$sql, $id_name = false){
  $result = mysqli_query($db_link,$sql);
  $arr = array();
  $row = array();
  if($result){
    if($id_name == false){
      while($row = mysqli_fetch_assoc($result))
        $arr[] = $row;
    }else{
      while($row = mysqli_fetch_assoc($result)){
        $id = $row['id'];
        $arr[$id] = $row;
      }
    }
  }else return 0;

  return $arr;
}

function query_whole_table($db_link,$table, $value = '*'){
    $sql = "SELECT $value FROM $table";
  return assoc_query_2D($db_link ,$sql);
}

$export_str = "";
$result = query_whole_table($db_link,$table);

foreach($result as $record){
  $export_str .= implode(";",$record) . "\n";
}
// add time to fileName
$date = time(); 
file_put_contents($date.'_'.$table."_export.csv", $export_str);
?>