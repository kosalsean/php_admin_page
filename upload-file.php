<?php
$file = $_FILES['txt-file'];
$name = $file['name'];
// echo $name;
$tmp = $file['tmp_name'];
//echo $tmp;
//  move_uploaded_file($tmp, 'img/1.jpg');
$type = pathinfo($name, PATHINFO_EXTENSION);
//echo $type;
$size = $file['size'];
$check = getimagesize($tmp);
$t = time();

if ($check == false) {
    // echo 'not an image';
    return;
} else {
    if ($size < 2000000) {
        if ($type != 'jpg' && $type != 'png' && $type != 'gif') {
          //  echo 'file not found';
          return;
        } else {
            move_uploaded_file($tmp, 'img/' . $t . '.' . $type);
        }
    }
}
$source = "img/$t.$type";
$message['source']=$source;
echo json_encode($message);
?>