<?php

session_start();
include('config.php');
include('koneksi.php');

if(empty($_POST)) exit("Mau curang, ya?");

$uname		= $_POST['username'];
$pass 		= md5($_POST['password']);

$query = mysql_query("SELECT * FROM user WHERE username = '$uname' AND password = '$pass' ");

if( mysql_num_rows($query) == 0 ){
	session_destroy();
	header('location: index.php?error=noreguser');
}else{
	$user 					= mysql_fetch_object($query);
	$_SESSION['loggon'] 	= 'yes';
	$_SESSION['username'] 	= $user->username;
	$_SESSION['nama'] 		= $user->nama;
	$_SESSION['hak_akses'] 	= $user->hak_akses;
	header('location: index.php');
}
?>