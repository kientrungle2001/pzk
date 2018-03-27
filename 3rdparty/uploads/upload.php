<?php

$target_dir = "C:/wamp/www/qlhs/3rdparty/uploads/images/";
$basename= basename($_FILES["fileToUpload"]["name"]);
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
//echo ($_FILES["fileToUpload"]["name"]);
//die();

$uploadOk = 1;
//echo $basename;
//die();
$message="";
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
       // echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        $message= "Thay đổi không thành công. Bạn chỉ được phép upload file ảnh JPG, JPEG, PNG, GIF";
        $uploadOk = 0;
    }
}
// Check if file already exists
if (file_exists($target_file)) {
    // Trường hợp tên file đã tồn tại
    $add=md5(rand(0,200000));
   $target_file=$target_dir .$add.basename($_FILES["fileToUpload"]["name"]);
   
  //  $uploadOk = 1;
}
// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
    $message=" Dung lượng file ảnh quá lớn, bạn hãy chọn file ảnh có kích thước < 488kb";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif"&& $imageFileType != "JPG" && $imageFileType != "PNG" && $imageFileType != "JPEG" && $imageFileType != "GIF") {
    $message= "Thay đổi không thành công. Bạn chỉ được phép upload file ảnh JPG, JPEG, PNG, GIF";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    //echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {

        $message="Bạn đã thay đổi avata thành công";

    //echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";

    } else {
     //   echo "Sorry, there was an error uploading your file.";
    }
}
return $target_file;
?>