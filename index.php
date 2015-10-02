<?php

session_start();
include('config.php');
include('koneksi.php');
if(isset($_SESSION['hak_akses'])){
	if($_SESSION['hak_akses'] == 'siswa'){
		
		// Masukkan Template Header
		include("template/header.php");
		
		// Masukkan Template Header
		include("template/siswa/list_file.php");
		
		// Masukan Template Footer
		include("template/footer.php");
		
	}elseif($_SESSION['hak_akses'] == 'guru'){

		$modul_uri_register = array('upload');
		$modul = $_GET['module'];
		
		if(isset($modul) && !in_array($modul, $modul_uri_register)) exit('Mau curang, ya?');
		
		// Masukkan Template Header
		include("template/header.php");
		
		if($modul== 'upload'){
			include("template/guru/upload.php");
		// Selain itu masukan template admin
		}else{
			include("template/guru/file_list.php");
		}

		// Masukan Template Footer
		include("template/footer.php");

	}elseif($_SESSION['hak_akses'] == 'admin'){

		// URL yang boleh diakses
		// index.php?module=muser
		// index.php?module=mfile
		$modul_uri_register = array('muser','mfile','upload');
		$modul = "";
		if(isset($_GET["module"])){
			$modul = $_GET["module"];
		}
		
		if(!isset($modul) && !in_array($modul, $modul_uri_register)) exit('Mau curang, ya?');
		
		// Masukkan Template Header
		include("template/header.php");
		
		// Jika $modul bernilai muser maka masukkan template manajemen_user
		if($modul == 'muser'){
			include("template/admin/manajemen_user.php");
			
		// Jika $modul bernilai mfile maka masukkan template manajemen_file
		}elseif($modul== 'mfile'){
			include("template/admin/manajemen_file.php");
		
		}elseif($modul== 'upload'){
			include("template/guru/upload.php");
		
		// Selain itu masukan template admin
		}else{
			include("template/admin/index.php");
		}
		
		// Masukan Template Footer
		include("template/footer.php");
		
	}else{
		include("template/header.php");
		include("template/home/index.php");
		include("template/footer.php");
	}
}else{
		include("template/header.php");
		include("template/home/index.php");
		include("template/footer.php");
	}
?>