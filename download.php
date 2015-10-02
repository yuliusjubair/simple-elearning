<?php
session_start();
if(isset($_SESSION['username'])){
header('Content-Description: File Transfer');
header('Content-Type: application/octet-stream');
header('Content-disposition: attachment; filename='.$_GET['name']);
header('Content-type: '.$_GET['tipe']);
readfile($folder_upload.'/'.$_GET['name']);
}else{

die("Nggak boleh download!");
}
?>