<tr>
   <td width="160px">
		<?php		
		// Masukkan Template Panel User
		include('template/home/panel_user.php');
	   ?>  
	 </td>
   <td>
   <?php
    // URL yang boleh diakses
	// index.php?module=muser&action=edit
	// index.php?module=muser&action=tambah
	// index.php?module=muser&action=hapus
	$action_uri_register = array('tambah','hapus','edit','simpan','update');
	$action = $_GET['action'];
	
	//Jika URL yang diakses bukan seperti yang diatas maka tampilkan pesan
	if(isset($action) && !in_array($action, $action_uri_register)){ 
		echo "Maaf, Halaman yang Anda maksud tidak ada!";
	//Jika tidak proses dengan module manajemen user.
	}else{
		// Jika $action = 'tambah' tampilkan form tambah
		if( $action == 'tambah' ){
	?>
		<form action="index.php?module=muser&action=simpan" method="post">
			<h2>Tambah User</h2>
			<p>Nama: </p>
			<p><input name="nama" type="text"></p>
			<p>Username: </p>
			<p><input name="username" type="text"></p>
			<p>Password: </p>
			<p><input name="password" type="text"></p>
			<p>Hak Akses</p>
			<p>
			<select name="hak_akses">
			  <option value="admin">admin</option>
			  <option value="guru">guru</option>
			  <option value="siswa">siswa</option>
			</select>
			</p>
			<p><input name="bsimpan" type="submit" value="Simpan User"></p>
		</form>
	<?php
		// Jika $action = 'update' lakukan update user
		}elseif( $action == 'update' ){
			if(!isset($_POST['bupdate'])){
				echo "Maaf, Terjadi kesalahan! <a href='?module=muser'>Kembali ke Index</a>";
			}else{
				$id			= $_POST['id'];
				$nama 		= $_POST['nama'];
				$username 	= $_POST['username'];	
				$password 	= $_POST['password'];	
				$hakakses 	= $_POST['hak_akses'];
				
				if(empty($password)){
					$sql = "UPDATE user SET nama='$nama', hak_akses='$hakakses' WHERE username='$id'";
				}else{
					$password = md5(md5(md5($password)));
					$sql = "UPDATE user SET nama='$nama', password='$password', hak_akses='$hakakses' WHERE username='$id'";
				}
				
				$query = mysql_query($sql);
				// Jika Input benar Tampilkan pesan sukses
				if($query){
					echo "Update Sukses! <a href='?module=muser'>Kembali ke Index</a> | <a href='?module=muser&action=tambah'>Input Data</a> | <a href='?module=muser&action=edit&id=$id'> Lihat User </a>";
				//Jika Salah tampilkan pesan Error
				}else{
					echo "Maaf, Terjadi kesalahan input! ".mysql_error()."<a href='?module=muser'>Kembali ke Index</a>";
				}
				
			}
			
		// Jika $action = 'simpan' lakukan simpan user
		}elseif( $action == 'simpan' ){
			//Jika User langsung mengkases halaman simpan maka tampilkan pesan
			if(!isset($_POST['bsimpan'])){
				echo "Maaf, Terjadi kesalahan! <a href='?module=muser'>Kembali ke Index</a>";
			//Jika tidak maka proses input
			}else{
				$nama 		= $_POST['nama'];
				$username 	= $_POST['username'];	
				$password 	= md5(md5(md5($_POST['password'])));	
				$hakakses 	= $_POST['hak_akses'];
				
				$query = mysql_query("INSERT INTO user(nama, username, password, hak_akses) VALUES('$nama','$username','$password','$hakakses')");
				// Jika Input benar Tampilkan pesan sukses
				if($query){
					$id = $username ;
					echo "Input Sukses! <a href='?module=muser'>Kembali ke Index</a> | <a href='?module=muser&action=tambah'>Input Data</a> | <a href='?module=muser&action=edit&id=$username'> Lihat User </a>";
				//Jika Salah tampilkan pesan Error
				}else{
					echo "Maaf, Terjadi kesalahan input! ".mysql_error()."<a href='?module=muser'>Kembali ke Index</a>";
				}
			}			
		// Jika $action = 'hapus' lakukan hapus user
		}elseif( $action == 'hapus' ){
			// Jika ada id proses hapus
			if(isset($_GET['id'])){
				$query = mysql_query("DELETE FROM user WHERE username='". $_GET['id']."'");
				if($query){
					echo "User telah dihapus! <a href='?module=muser'>Kembali ke Index</a>";
				}else{
					echo "Maaf, Terjadi kesalahan hapus! ".mysql_error()."<a href='?module=muser'>Kembali ke Index</a>";
				}
			// Jika tidak tampilkan pesan	
			}else{
				echo "Maaf, Terjadi kesalahan! <a href='?module=muser'>Kembali ke Index</a>";
			}
		// Jika $action = 'edit' tampilkan form edit
		}elseif( $action == 'edit' ){
			// Jika ada id dan id adalah integer tampilkan form
			if(isset($_GET['id'])){
				$query = mysql_query("SELECT * FROM user WHERE username='". $_GET['id']."'");
				$user = mysql_fetch_object($query);
	?>
			<form action="index.php?module=muser&action=update" method="post">
				<h2>Update User</h2>
				<input name="id" type="hidden"  value="<?php echo $user->username; ?>">
				<p>Nama: </p>
				<p><input name="nama" type="text"  value="<?php echo $user->nama; ?>"></p>
				<p>Username: </p>
				<p><input name="username" type="text" disabled="disabled" value="<?php echo $user->username; ?>"></p>
				<p>Password Baru: </p>
				<p><input name="password" type="text" ></p>
				<p>Hak Akses</p>
				<p>
				<select name="hak_akses">
				  <option value="admin" <?php if($user->hak_akses == 'admin') echo 'selected="selected"'; ?>>admin</option>
				  <option value="guru" <?php if($user->hak_akses == 'guru') echo 'selected="selected"'; ?>>guru</option>
				  <option value="siswa" <?php if($user->hak_akses == 'siswa') echo 'selected="selected"'; ?>>siswa</option>
				</select>
				</p>
				<p><input name="bupdate" type="submit" value="Update User"></p>
			</form>
	<?php						
			// Jika tidak tampilkan pesan	
			}else{
				echo "Maaf, Terjadi kesalahan! <a href='?module=muser'>Kembali ke Index</a>";
			}
		}else{
	?>
			<h2>Manajemen User</h2>
			<a href="?module=muser&action=tambah">Tambah User</a>
			<?php 
				$limit = 5;
				
				if(isset($_GET['offset'])){
					$offset = $_GET['offset'];
				}else{
					$offset = 0;
				}
				$no = $offset + 1;
				$users = mysql_query("SELECT * FROM user ORDER BY username DESC LIMIT $offset, $limit")or die(mysql_error());
				
				if(mysql_num_rows($users) == 0 ){
					echo '<h1>Tidak ada data yang bisa ditampilkan.</h1>';
				}else{
					echo "<table id='table_dalam'>";
					echo "<tr><td>No.</td><td>Username</td><td>Nama</td><td>Hak Akses</td><td>Aksi</td></tr>";
					while($user=mysql_fetch_object($users)){
					echo "<tr><td>$no.</td><td>$user->username</td><td>$user->nama</td><td>$user->hak_akses</td><td><a href='?module=muser&action=hapus&id=$user->username' onclick='return confirm(\"Apakah Anda Yakin?\")'>Hapus</a> | <a href='?module=muser&action=edit&id=$user->username'>Edit</a></td></tr>";
					$no++;
					}
					echo "</table>";
				}
				
				$banyak_content = mysql_num_rows( mysql_query("SELECT * FROM user") );
				$banyak_halaman = ceil($banyak_content/$limit);
				
				echo "Halaman : ";
				for( $i=1; $i<=$banyak_halaman; $i++ ){
					$link = ( $i - 1 ) * $limit;
					if($offset == $link){
						echo $i;
					}else{
						echo " <a href='?module=muser&offset=".$link."'>$i</a> ";
					}
				}
				 
			}
		}
		?>
   </td>
</tr>
