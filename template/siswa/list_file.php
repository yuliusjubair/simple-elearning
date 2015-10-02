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
   		<h2>Download File</h2>
		<?php
			if(isset($_GET['pointer'])){
				$files = mysql_query("SELECT * FROM file WHERE username='".$_GET['pointer']."' ORDER BY id_file DESC")or die(mysql_error());
				if(mysql_num_rows($files) == 0){
					echo "Tidak Ada File";
				}else{
					while($file = mysql_fetch_object($files)){
						echo "<a href='download.php?name=$file->nama_file&tipe=$file->tipe'>".$file->nama_file."</a><br /><br />";
					}									
				}
			}else{
				$users = mysql_query("SELECT * FROM user WHERE hak_akses='guru' ORDER BY username DESC")or die(mysql_error());
				if(mysql_num_rows($users) == 0){
					echo "Tidak Ada File";
				}else{
					while($user = mysql_fetch_object($users)){
						echo "<a href='?pointer=$user->username'>".$user->nama."</a><br /><br />";
					}									
				}
				
			}
		?>
   </td>
</tr>