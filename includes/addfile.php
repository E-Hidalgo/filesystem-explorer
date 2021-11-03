<?php
require_once 'db.inc.php';
session_start();
$folder_dest = "../upload/";

if(isset($_POST["btn-menu"])){
  if(!$folder_dest){
  mkdir($folder_dest, 0777, true);
  }
  else {
    $file= $_FILES["addfile"];
    $name = $file["name"];
    $type = $file["type"];
    $size = $file["size"];
    $ext = pathinfo($name, PATHINFO_EXTENSION);

    $tmp_name = $file["tmp_name"];

    $destination = $folder_dest.$name;
    move_uploaded_file($tmp_name, $destination);

    $uploadQuery = $db->prepare("
      INSERT INTO
      files(`name`, `size`, `creation`, `modified`, `extension`, `path`) 
      VALUES (:name, :size, :creation, :modified, :extension, :path)
    ");

    $uploadQuery->execute([
      "name"=>$name,
      "size"=>$size,
      "creation"=>date("Y-m-d", filemtime($destination)),
      "modified"=>date("Y-m-d", filectime($destination)),
      "extension"=>$ext,
      "path"=>$destination
    ]);

    // $drawQuery=$db->prepare("
    //   SELECT `id`, `name`, `size`, `creation`, `modified`, `extension`, `path` FROM files
    // ");
    // $drawQuery->execute();

    // $filesAdded = $drawQuery->rowCount()?$drawQuery:[];
  }
  header("Location: ../index.php");
}