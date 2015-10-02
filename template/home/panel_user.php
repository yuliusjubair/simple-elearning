<?php 
if(isset($_SESSION['hak_akses'])){
if($_SESSION['hak_akses'] == 'siswa') { ?>

<h3>Hello, <?php echo $_SESSION['nama']; ?></h3>
<p><a href="index.php">Beranda</a></p>
<p><a href="logout.php">Logout</a></p> 

<?php }elseif($_SESSION['hak_akses'] == 'guru') { ?>

<h3>Hello, <?php echo $_SESSION['nama']; ?></h3>
<p><a href="index.php">Beranda</a></p>
<p><a href="?module=upload">Upload File</a></p>
<p><a href="logout.php">Logout</a></p> 

<?php }elseif($_SESSION['hak_akses'] == 'admin') { ?>

<h3>Hello, <?php echo $_SESSION['nama']; ?></h3>
<p><a href="index.php">Beranda</a></p>
<p><a href="?module=muser">Manajemen User</a></p>
<p><a href="?module=upload">Upload File</a></p>
<p><a href="?module=mfile">Manajemen File</a></p>
<p><a href="logout.php">Logout</a></p> 

<?php } else{ ?>

<form name="loginform" method="post" action="login.php">
	<p>Username : </p>
	<p><input name="username" type="text"></p>
	<p>Password : </p>
	<p><input name="password" type="password"></p>
	<p><input name="btlogin" type="submit" value="Login"></p>
</form> 

<?php }
}else{
 ?>
 <form name="loginform" method="post" action="login.php">
	<p>Username : </p>
	<p><input name="username" type="text"></p>
	<p>Password : </p>
	<p><input name="password" type="password"></p>
	<p><input name="btlogin" type="submit" value="Login"></p>
</form> 
 <?php } ?>