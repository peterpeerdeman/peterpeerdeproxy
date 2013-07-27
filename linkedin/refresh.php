<?php
try {
  $dbhandle = new PDO('linkedin_tokens.db');
  // Set errormode to exceptions
  $dbhandle->setAttribute(PDO::ATTR_ERRMODE, 
                          PDO::ERRMODE_EXCEPTION);

  switch ($_GET['cmd']) {
    case 'create':
      create($dbhandle);
    break;
    case 'drop':
      drop($dbhandle);
    break;
    case 'insert':
    insert($dbhandle);
    break;
    case 'select':
    select($dbhandle);
    default:
    exit(1);
  }

} catch(Exception $e) {
  print $e->getMessage();
  return false;
}

function drop($dbhandle) {
  $stm = "DROP TABLE Tokens";
  $res = $dbhandle->exec($stm);
  if($res) {
    echo 'dropped';
  }
}

function create($dbhandle) {
  $stm = "CREATE TABLE Tokens(id INTEGER PRIMARY KEY AUTOINCREMENT,token TEXT NOT NULL, datetime DATETIME )";
  $res = $dbhandle->exec($stm);
  if($res) {
    echo 'created';
  }
}

function insert($dbhandle) {
  $stm = "INSERT into Tokens(token,datetime) values ('test2', DATETIME('now'))";
  $res = $dbhandle->exec($stm);
  if($res) {
    echo 'inserted';
  }
}
function select($dbhandle) {
  $stm = "select token from Tokens order by datetime desc LIMIT 1";
  $res = $dbhandle->query($stm);
//  $res = query($stm, $dbhandle);
    foreach ($res as $row) {
      echo '1';
      echo $row['token'];
    }
}

?>
