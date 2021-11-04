<?php
echo "<a href='javascript:history.back(1);'>Back</a>'";
echo "<pre>";
print_r($_FILES);

$pathName= "../root";
$fileName = $_FILES["addfile"]["name"];
$fileType =$_FILES["addfile"]["type"];
$fileTmp = $_FILES["addfile"]["tmp_name"];
$fileSize = $_FILES["addfile"]["size"];

if(!file_exists("../root")) {
mkdir($pathName, 0777, true);
chmod($pathName, 0777);

if(file_exists("../root")) {

  if(move_uploaded_file($fileTmp, "../root/" . $fileName)) {
    echo "Uploaded file";
  }else {
    echo "File upload failed";
  }
}

// } else {
//   if(move_uploaded_file($fileTmp, "../root/" . $fileName)) {
//     echo "Uploaded file";
//   } else {
//     echo "File upload failed";
//   }
}