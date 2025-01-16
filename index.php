<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $target = "uploads/";
    $destination = "archive/"; // Destination folder for moving files

   
    if (!is_dir($destination)) {
        mkdir($destination, 0777, true);
    }

    $file = $_FILES['image'];
    $fileName = basename($file['name']);
    $targetFile = $target . $fileName;
    $destinationFile = $destination . $fileName;
    $fileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
    
    if (move_uploaded_file($file['tmp_name'], $targetFile)) {
        echo "The file " . htmlspecialchars($fileName) . " has been uploaded successfully! .<br>";
    } else {
        echo "Error: There was a problem uploading your file.";
    }
        // Move the file to another folder
        if (rename($targetFile, $destinationFile)) {
            echo "The file has been moved to the archive folder.<br>";
        } else {
            echo "Error: Unable to move the file to the archive folder.<br>";
        }
        // Optionally delete the file from the destination folder
        if (unlink($destinationFile)) {
            echo "The file has been deleted from the archive folder.<br>";
        } else {
            echo "Error: Unable to delete the file from the archive folder.<br>";
        }
    } else {
        echo "Error: There was a problem uploading your file.<br>";
    }

exit();



?>