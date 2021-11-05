<?php
require_once("./includes/dbh.inc.php");

$fetchQuery = $db -> prepare("
SELECT * FROM `files` WHERE `pathfather`=:pathfather
");

$fetchQuery -> execute([
  "pathfather"=>"C:"."\\"."xampp\htdocs\Assembler\Month6"."\\"."files_system\php_files_sync"."\\"."filesystem-explorer"."\\"."root"
]);

$fileFetched = $fetchQuery -> rowCount()? $fetchQuery : [] ;
?>