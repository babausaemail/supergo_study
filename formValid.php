<?php
/**
 * Created by PhpStorm.
 * User: asus
 * Date: 10/8/2014
 * Time: 9:27 AM
 */

$jsonObject=array();
//print_r($jsonObject);


// Start of Upload File Validation Code.
$allowFileExt=array('pdf', 'gif', 'png', 'jpg');
$uploadFileName=$_FILES['file']['name'];
$fileExtension=pathinfo($uploadFileName, PATHINFO_EXTENSION);
if (!in_array($fileExtension,$allowFileExt)) {
    $jsonObject["uploadFileMessage"]="file is not allowed to be loaded";
}else{
    move_uploaded_file($_FILES['file']['tmp_name'],'upload/'.$uploadFileName);
    $jsonObject["uploadFileMessage"]="file is loaded successfully";
}
// ----------- End of Code Upload File Validation Code -----------------------------------------


// Start of Name validation Code
if (isset($_POST['Namekey'])) {
    $name=test_input($_POST['Namekey']);
    if (!preg_match('/^[a-zA-Z]*$/',$name)) {
        $jsonObject["nameValidMessage"]='Name is not valid.  Name can only contain characters';
    }else{
        $jsonObject["nameValidMessage"]='Valid Name';
    }
}
function test_input($data) {
    $data=trim($data);
    $data=stripcslashes($data);
    $data=htmlspecialchars($data);
    return $data;
}
// ------------------------- End of Name Validation Code  -----------------------------------------

// Start of JSON creation Code
$jsonObject=json_encode($jsonObject);
print_r($jsonObject);
// ------------------------- End of JSON creation Code  -----------------------------------------
?>