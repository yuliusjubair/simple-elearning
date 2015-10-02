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
   		<h2>Selamat Datang</h2>
		<p>Selamat Datang di situs Simple E-Learning.</p>
   </td>
</tr>