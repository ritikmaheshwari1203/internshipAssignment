<?php

require "./dbconnect.php";
$input = file_get_contents('php://input');
$decode = json_decode($input, true);

$name=$decode['name'];
$city=$decode['city'];
$number=$decode['number'];

require './dbconnect.php';
function guidv4($data = null) {
    // Generate 16 bytes (128 bits) of random data or use the data passed into the function.
    $data = $data ?? random_bytes(16);
    assert(strlen($data) == 16);

    // Set version to 0100
    $data[6] = chr(ord($data[6]) & 0x0f | 0x40);
    // Set bits 6-7 to 10
    $data[8] = chr(ord($data[8]) & 0x3f | 0x80);

    // Output the 36 character UUID.
    return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
}

$myuuid = guidv4();
$sql="INSERT INTO `userinfo` (`UUID`, `name`,`city`,`phoneNo`) VALUES ('$myuuid','$name','$city',$number)";
$result=mysqli_query($conn,$sql);
// session_start();
// $_SESSION['UUID']=$myuuid;

// session_start();
// $uuid=$_SESSION['UUID'];
require "vendor/autoload.php";
// require "./dbconnect.php";
$sql="SELECT * from userInfo";
$result=mysqli_query($conn,$sql);
$html='<table>';
$html.='<tr><td>ID</td><td>Name</td><td>UUID</td><td>City</td><td>phoneNo</td></tr>';
while ($row=mysqli_fetch_assoc($result)) {
    // $id=(string)$row['id'];
    $html.='<tr><td>'.$row['id'].'</td><td>'.$row['name'].'</td><td>'.$row['UUID'].'</td><td>'.$row['city'].'</td><td>'.$row['phoneNo'].'</td></tr>';
}
$html.='</table>';
// echo $html;
$mypdf=new \Mpdf\Mpdf();
$mypdf->WriteHTML($html);
$name=time();
$file='data/'.$name.'.pdf';
$mypdf->output($file,'F');
echo json_encode(array('id'=>$name));
// echo json_encode(array('UUID'=>));


?>