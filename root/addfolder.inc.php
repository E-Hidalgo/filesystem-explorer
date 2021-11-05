<?php

require_once('../includes/dbh.inc.php');


$modified = date("Y-m-d", filemtime($pathName . $fileName));
$creation = date("Y-m-d", filectime($pathName . $fileName));
$fileName = $_POST["addfolder"];
$pathName= dirname(__FILE__);


// prepare to upload to db 

$uploadQuery =$db->prepare("
INSERT INTO `files`(`name`, `size`, `modified`, `creation`, `extension`, `path`, `pathfather`) 
VALUES (:name, :size, :modified, :creation, :extension, :path, :pathfather)
");


//encrypt

$uploadQuery->execute([
  "name"=>$fileName,
  "size"=>0,
  "modified"=>$modified,
  "creation"=>$creation,
  "extension"=>"folder",
  "path"=>$pathName."\\".$fileName,
  "pathfather"=>$pathName
]);

if(!file_exists($pathName."/".$fileName)) {
mkdir($pathName."/".$fileName, 0777, true);
if (PHP_OS !== "WINNT") {
  chmod($pathName."/".$fileName, 0777);
}
}

header("location: ../index.php");