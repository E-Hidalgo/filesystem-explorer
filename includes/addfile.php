<?php
require_once("./dbh.inc.php");
includes "rootPathMaker.php";
echo "<a href='javascript:history.back(1);'>Back</a>'";

//Paris´s code
$pathName= "../root";

//create function to constant
$ROOTFOLDERNUMBER=count(explode("/", rootPathMaker()));

$fileName = $_FILES["addfile"]["name"];
$fileType =$_FILES["addfile"]["type"];
$fileTmp = $_FILES["addfile"]["tmp_name"];
$fileSize = $_FILES["addfile"]["size"];

if(!file_exists("../root")) {
mkdir($pathName, 0777, true);
if (PHP_OS !== "WINNT") {
  chmod($pathName, 0777);
}
}
  if(move_uploaded_file($fileTmp, "../root/" . $fileName)) {
    echo "Uploaded file";
  }else {
    echo "File upload failed";
  }



$file= $_FILES["addfile"];
 $name = $file["name"];
 $extension = pathinfo($name, PATHINFO_EXTENSION);
 $size = $file["size"];
 $modified = date("Y-m-d", filemtime($pathName . $fileName));
 $creation = date("Y-m-d", filectime($pathName . $fileName));
 



// prepare to upload to db 

$uploadQuery =$db->prepare("
INSERT INTO `files`(`name`, `size`, `modified`, `creation`, `extension`, `path`) 
VALUES (:name, :size, :modified, :creation, :extension, :path)
");


//encrypt

$uploadQuery->execute([
  "name"=>$name,
  "size"=>$size,
  "modified"=>$modified,
  "creation"=>$creation,
  "extension"=>$extension,
  "path"=>$pathName."/".$fileName,
  "pathId"=>$folderNumber
]);
//header("location: ../index.php");