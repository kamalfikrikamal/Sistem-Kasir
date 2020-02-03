		<h3>Pengaturan Akun</h3><hr>
			<?php 
			$user = $app->get_user();
			if(isset($_POST['simpan'])) :
				$object = array(
					'username' => $_POST['username'], 
					'password' => $_POST['password'], 
					'app-1' => $_POST['app-1'],
					'app-2' => $_POST['app-2'] 
				);
				$app->set_pengaturan($object);
			endif; ?>

			<form method="post" action="">
				<table width="100%">
					<tr>
						<td width="200"><label>Username </label></td><td width="50" style="text-align: center;">:</td>
						<td><input type="text" name="username" style="width: 80%;" class="form" value="<?php echo $user->username; ?>" required /></td>
					</tr>
					<tr>
						<td><label>Password </label></td><td width="50" style="text-align: center;">:</td>
						<td><input type="password" name="password" style="width: 80%;" value="<?php echo base64_decode($user->password); ?>" ></td>
					</tr>
					<tr>
						<td><label>Nama Perusahaan </label></td><td width="50" style="text-align: center;">:</td>
						<td><input type="text" name="app-1" style="width: 80%;" class="form" required value="<?php echo $app->get_app('company_name'); ?>" /></td>
					</tr>
					<tr>
						<td><label>Alamat Perusahaan </label></td><td width="50" style="text-align: center;">:</td>
						<td><input type="text" name="app-2" style="width: 80%;" class="form" required value="<?php echo $app->get_app('company_address'); ?>" /></td>
					</tr>
					<tr>
						<td></td><td></td>
						<td><input type="submit" name="simpan" value="SIMPAN" style="width: 80%;" /></td>
					</tr>
				</table>
			</form>
			<br>
			<br>
			
			<a href="?p=home">Kembali</a>