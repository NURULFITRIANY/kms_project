<?php


function upload_file($file){
    $filename=false;

// var_dump($file);
$target_dir = "uploads/"; //target directory
$target_file = $target_dir . basename($file["name"]); //give a name for upload file
$uploadOk = 1; //default if uploading is succesed

//IMAGE

$file_type = pathinfo($target_file,PATHINFO_EXTENSION);
// var_dump($file_type); //nampilkan type file yg diupload
// Check if image file is a actual image or fake image
//check the file's type
// if(isset($_POST["submit"])) {
//     $check = getimagesize($file["tmp_name"]);
//     if($check !== false) {
//         echo "File is an image - " . $check["mime"] . ".";
//         $uploadOk = 1;
//     } else {
//         echo "File is not an image.";
//         $uploadOk = 0;
//     }
// }
// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}
// Check file size
if ($file["size"] > 128000000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
// Allow certain file formats
if($file_type != "jpg" && $file_type != "png" && $file_type != "jpeg"
&& $file_type != "gif" && $file_type != 'pdf' && $file_type != 'docx' && $file_type != 'doc') {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    // var_dump($file);
    if (move_uploaded_file($file["tmp_name"], $target_file)) {
        echo "The file ". basename( $file["name"]). " has been uploaded.";
        $filename=$file['name'];
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}

//DOCUMENT PDF
// $DocFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// // Check if image file is a actual image or fake image
// if(isset($_POST["submit"])) {
//     $check = getdocsize($file["tmp_name"]);
//     if($check !== false) {
//         echo "File is an pdf - " . $check["mime"] . ".";
//         $uploadOk = 1;
//     } else {
//         echo "File is not an pdf extension.";
//         $uploadOk = 0;
//     }
// }
// // Check if file already exists
// if (file_exists($target_file)) {
//     echo "Sorry, file already exists.";
//     $uploadOk = 0;
// }
// // Check file size
// if ($file["size"] > 128000000) {
//     echo "Sorry, your file is too large.";
//     $uploadOk = 0;
// }
// // Allow certain file formats
// if($DocFileType != "pdf") {
//     echo "Sorry, only pdf files are allowed.";
//     $uploadOk = 0;
// }
// // Check if $uploadOk is set to 0 by an error
// if ($uploadOk == 0) {
//     echo "Sorry, your file was not uploaded.";
// // if everything is ok, try to upload file
// } else {
//     if (move_uploaded_file($file["tmp_name"], $target_file)) {
//         echo "The file ". basename( $file["name"]). " has been uploaded.";
//         $filename=$file['name'];
//     } else {
//         echo "Sorry, there was an error uploading your file.";
//     }
// }

// //ARCHIEVE
// $ArchieveFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// // Check if image file is a actual image or fake image
// if(isset($_POST["submit"])) {
//     $check = getarchievesize($file["tmp_name"]);
//     if($check !== false) {
//         echo "File is an archieve - " . $check["mime"] . ".";
//         $uploadOk = 1;
//     } else {
//         echo "File is not an archieve.";
//         $uploadOk = 0;
//     }
// }
// // Check if file already exists
// if (file_exists($target_file)) {
//     echo "Sorry, file already exists.";
//     $uploadOk = 0;
// }
// // Check file size
// if ($file["size"] > 128000000) {
//     echo "Sorry, your file is too large.";
//     $uploadOk = 0;
// }
// // Allow certain file formats
// if($ArchieveFileType != "zip" && $ArchieveFileType != "tar" && $ArchieveFileType != "7z"
// && $ArchieveFileType != "rar" ) {
//     echo "Sorry, only ZIP, RAR, TAR & 7Z files are allowed.";
//     $uploadOk = 0;
// }
// // Check if $uploadOk is set to 0 by an error
// if ($uploadOk == 0) {
//     echo "Sorry, your file was not uploaded.";
// // if everything is ok, try to upload file
// } else {
//     if (move_uploaded_file($file["tmp_name"], $target_file)) {
//         echo "The file ". basename( $file["name"]). " has been uploaded.";
//         $filename=$file['name'];
//     } else {
//         echo "Sorry, there was an error uploading your file.";
//     }
// }

// //WORD
// $WordFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// // Check if image file is a actual image or fake image
// if(isset($_POST["submit"])) {
//     $check = getwordsize($file["tmp_name"]);
//     if($check !== false) {
//         echo "File is an doc (word) - " . $check["mime"] . ".";
//         $uploadOk = 1;
//     } else {
//         echo "File is not an doc (word).";
//         $uploadOk = 0;
//     }
// }
// // Check if file already exists
// if (file_exists($target_file)) {
//     echo "Sorry, file already exists.";
//     $uploadOk = 0;
// }
// // Check file size
// if ($file["size"] > 128000000) {
//     echo "Sorry, your file is too large.";
//     $uploadOk = 0;
// }
// // Allow certain file formats
// if($WordFileType != "docx" && $WordFileType != "docm" && $WordFileType != "dotx"
// && $WordFileType != "dotm" ) {
//     echo "Sorry, only DOCX, DOCM, DOTX, DOTM files are allowed.";
//     $uploadOk = 0;
// }
// // Check if $uploadOk is set to 0 by an error
// if ($uploadOk == 0) {
//     echo "Sorry, your file was not uploaded.";
// // if everything is ok, try to upload file
// } else {
//     if (move_uploaded_file($file["tmp_name"], $target_file)) {
//         echo "The file ". basename( $file["name"]). " has been uploaded.";
//         $filename=$file['name'];
//     } else {
//         echo "Sorry, there was an error uploading your file.";
//     }
// }

// //EXCEL
// $ExcelFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// // Check if image file is a actual image or fake image
// if(isset($_POST["submit"])) {
//     $check = getexcelsize($file["tmp_name"]);
//     if($check !== false) {
//         echo "File is an excel - " . $check["mime"] . ".";
//         $uploadOk = 1;
//     } else {
//         echo "File is not an excel.";
//         $uploadOk = 0;
//     }
// }
// // Check if file already exists
// if (file_exists($target_file)) {
//     echo "Sorry, file already exists.";
//     $uploadOk = 0;
// }
// // Check file size
// if ($file["size"] > 128000000) {
//     echo "Sorry, your file is too large.";
//     $uploadOk = 0;
// }
// // Allow certain file formats
// if($ExcelFileType != "xlsx" && $ExcelFileType != "xlsm" && $ExcelFileType != "xltx"
// && $ExcelFileType != "xltm" ) {
//     echo "Sorry, only XLSX, XLSM, XLTX, XLTM files are allowed.";
//     $uploadOk = 0;
// }
// // Check if $uploadOk is set to 0 by an error
// if ($uploadOk == 0) {
//     echo "Sorry, your file was not uploaded.";
// // if everything is ok, try to upload file
// } else {
//     if (move_uploaded_file($file["tmp_name"], $target_file)) {
//         echo "The file ". basename( $file["name"]). " has been uploaded.";
//         $filename=$file['name'];
//     } else {
//         echo "Sorry, there was an error uploading your file.";
//     }
// }

// //POINT
// $PointFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// // Check if image file is a actual image or fake image
// if(isset($_POST["submit"])) {
//     $check = getpointsize($file["tmp_name"]);
//     if($check !== false) {
//         echo "File is an powerpoint - " . $check["mime"] . ".";
//         $uploadOk = 1;
//     } else {
//         echo "File is not an powerpoint.";
//         $uploadOk = 0;
//     }
// }
// // Check if file already exists
// if (file_exists($target_file)) {
//     echo "Sorry, file already exists.";
//     $uploadOk = 0;
// }
// // Check file size
// if ($file["size"] > 128000000) {
//     echo "Sorry, your file is too large.";
//     $uploadOk = 0;
// }
// // Allow certain file formats
// if($PointFileType != "pptx" && $PointFileType != "potm" && $PointFileType != "pptm"
// && $PointFileType != "potx" ) {
//     echo "Sorry, only PPTX, POTM, PPTM, POTX files are allowed.";
//     $uploadOk = 0;
// }
// // Check if $uploadOk is set to 0 by an error
// if ($uploadOk == 0) {
//     echo "Sorry, your file was not uploaded.";
// // if everything is ok, try to upload file
// } else {
//     if (move_uploaded_file($file["tmp_name"], $target_file)) {
//         echo "The file ". basename( $file["name"]). " has been uploaded.";
//         $filename=$file['name'];
//     } else {
//         echo "Sorry, there was an error uploading your file.";
//     }
// }



    return $filename;
}


?>