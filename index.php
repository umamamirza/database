<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $target = "uploads/";
 
    $file = $_FILES['image'];
    $fileName = basename($file['name']);
    $targetFile = $target . $fileName;
    $fileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
   
    if (move_uploaded_file($file['tmp_name'], $targetFile)) {
        echo "The file " . htmlspecialchars($fileName) . " has been uploaded successfully!";

        $newFileName = "renamed_" . uniqid() . "." . $fileType;
        $newTargetFile = $target . $newFileName;
    
    if (rename($targetFile, $newTargetFile)) {
    echo "The file has been renamed to " . htmlspecialchars($newFileName) . ".<br>";
    
   
    if (unlink($newTargetFile)) {
       echo "The file " . htmlspecialchars($newFileName) . " has been deleted.";
    }}


    } else {
        echo "Error: There was a problem uploading your file.";
    }
  
    }


?>