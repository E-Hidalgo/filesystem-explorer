<?php
require_once "db.inc.php";
$drawQuery=$db->prepare("
    SELECT * FROM files
");
$drawQuery->execute();

$filesAdded = $drawQuery->rowCount()?$drawQuery:[];