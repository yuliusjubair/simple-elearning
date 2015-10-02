<tr>
   <td width="160px">
   
   <?php 
   	//Kalau di URL index.php?error=noreguser maka tampilkan pesan 'Username dan Password tidak cocok!'
   	if(isset($_GET['error']) && $_GET['error'] == 'noreguser' ) echo "Username dan Password tidak cocok!"; 
	
	// Masukkan Template Panel User
	include('template/home/panel_user.php');
   ?>
   </td>
   <td>
   <?php 
	$action_uri_register = array('simpan');
	$action = !empty($_GET['action'])?$_GET['action']:"";
	
	//Jika URL yang diakses bukan seperti yang diatas maka tampilkan pesan
	if(!isset($action) && !in_array($action, $action_uri_register)){ 
		echo "Maaf, Halaman yang Anda maksud tidak ada!";
	//Jika tidak proses dengan module manajemen user.
	}else{
		
		if($action=='simpan'){
		$nmfile = rand(0,999)."_".$_SESSION['username']."_".$_FILES['file']['name'];
			$query = mysql_query("INSERT INTO file(nama_file, tipe, username, tgl_upload) VALUES('".$nmfile."','".$_FILES['file']['type']."','".$_SESSION['username']."','".date("Y-m-d")."')");
			
			move_uploaded_file($_FILES['file']['tmp_name'], $folder_upload."/".$nmfile);
			if($query){
					$id = mysql_insert_id();
					echo "Upload Sukses! <a href='index.php'>Kembali ke Index</a> | <a href='index?module=upload'>Input Data</a>";
				//Jika Salah tampilkan pesan Error
				}else{
					echo "Maaf, Terjadi kesalahan input! ".mysql_error()."<a href='?module=muser'>Kembali ke Index</a>";
				}
		
		}else{
		?>
		<form action="index.php?module=upload&action=simpan" method="post" enctype="multipart/form-data">
		<h2>Upload File</h2>
			<p><input name="file" type="file" /></p>
			<p><input name="" type="submit" value="Upload" /></p>
		</form>
	<?php
		}
	}
   ?>
   </td>
</tr>
