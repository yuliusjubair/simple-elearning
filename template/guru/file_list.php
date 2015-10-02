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
	$action_uri_register = array('hapus');
	$action = $_GET['action'];
	
	//Jika URL yang diakses bukan seperti yang diatas maka tampilkan pesan
	if(isset($action) && !in_array($action, $action_uri_register)){ 
		echo "Maaf, Halaman yang Anda maksud tidak ada!";
	//Jika tidak proses dengan module manajemen user.
	}else{
		if($action=='hapus'){
			// Jika ada id proses hapus
			if(isset($_GET['id'])){
				$query = mysql_query("DELETE FROM file WHERE nama_file='". $_GET['id']."'");
				unlink($folder_upload.'/'.$_GET['id']);
				if($query){
					echo "User telah dihapus! <a href='index.php'>Kembali ke Index</a>";
				}else{
					echo "Maaf, Terjadi kesalahan hapus! ".mysql_error()."<a href='index.php'>Kembali ke Index</a>";
				}
			// Jika tidak tampilkan pesan	
			}else{
				echo "Maaf, Terjadi kesalahan! <a href='index.php'>Kembali ke Index</a>";
			}		
		}else{	
	?>
		<h2>Daftar File</h2>
			<a href="?module=upload">Tambah File</a>
			<?php 
				$limit = 5;
				
				if(isset($_GET['offset'])){
					$offset = $_GET['offset'];
				}else{
					$offset = 0;
				}
				$no = $offset + 1;
				$files = mysql_query("SELECT * FROM file WHERE username='".$_SESSION['username']."' ORDER BY id_file DESC LIMIT $offset, $limit")or die(mysql_error());
				
				if(mysql_num_rows($files) == 0 ){
					echo '<h1>Tidak ada data yang bisa ditampilkan.</h1>';
				}else{
					echo "<table id='table_dalam'>";
					echo "<tr><td>No.</td><td>Nama File</td><td>Tipe</td><td>Tanggal Upload</td><td>Aksi</td></tr>";
					while($file=mysql_fetch_object($files)){
					echo "<tr><td>$no.</td><td><a href='download.php?name=$file->nama_file&tipe=$file->tipe'>$file->nama_file</a></td><td>$file->tipe</td><td>$file->tgl_upload</td><td><a href='?action=hapus&id=$file->nama_file' onclick='return confirm(\"Apakah Anda Yakin?\")'>Hapus</a></td></tr>";
					$no++;
					}
					echo "</table>";
				}
				
				$banyak_content = mysql_num_rows( mysql_query("SELECT * FROM file WHERE username='".$_SESSION['username']."'") );
				$banyak_halaman = ceil($banyak_content/$limit);
				
				echo "Halaman : ";
				for( $i=1; $i<=$banyak_halaman; $i++ ){
					$link = ( $i - 1 ) * $limit;
					if($offset == $link){ 
						echo $i; 
					}else{ 
						echo " <a href='?offset=".$link."'>$i</a> "; 
					} 
				}
		}		
	}
   ?>
   </td>
</tr>
