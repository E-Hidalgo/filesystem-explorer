<?php

function rootPathMaker($pathName="../root"){
  $explodePath = explode('/', $pathName);
  $hardCodedPath = '';
  for ($i = 1; $i <= count($explodePath) - 1; $i++) {
      if ($explodePath[$i] !== '..') {
  
          $hardCodedPath = $hardCodedPath .  '/' . $explodePath[$i];
      }
  }
  $uri = $_SERVER['REQUEST_URI'];
  if (isset($uri) && $uri !== null) {
      $uri = explode('/', $uri);
      $rootPath='';
      for ($i=1; $i < count($uri)-2; $i++) {
        $rootPath = $rootPath .  '/' . $uri[$i];
        echo $rootPath;
  echo "<br/>";
      }
      $uri = "$_SERVER[DOCUMENT_ROOT]". $rootPath;
  } else {
      $uri = null;
  }
  $filePath = $uri .$hardCodedPath;
  $fileName = str_replace(' ', '', str_replace('/', '\ ', $filePath));
  return $filePath;
}