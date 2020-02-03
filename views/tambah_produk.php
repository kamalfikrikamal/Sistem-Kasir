<h3 style=" text-align: center;">Tambah Produk</h3><hr>
			<?php if(isset($_POST['simpan'])) :
				$object = array(
					'kode' => $_POST['kode'], 
					'nama' => $_POST['nama'], 
					'stok' => $_POST['stok'], 
					'harga' => $_POST['harga']
				);
				$product->add_produk($object);
			endif; ?>
			<p style="text-align: center; color: blue;"><?php echo (isset($_GET['action'])) ? 'Berhasil ditambahkan!' : ''; ?></p>
			<form method="post" action="data_produk.php">
				<table width="100%">
					<tr>
						<td><label>Kode Produk </label></td><td width="50" style="text-align: center;">:</td>
						<td><input type="text" name="kode" style="width: 300px;" class="form" required /></td>
					</tr>
					<tr>
						<td><label>Nama Produk </label></td><td width="50" style="text-align: center;">:</td>
						<td><input type="text" name="nama" style="width: 80%;"></td>
					</tr>
					<tr>
						<td><label>Jumlah Stok </label></td><td width="50" style="text-align: center;">:</td>
						<td><input type="text" name="stok" style="width: 300px;" class="form" required /></td>
					</tr>
					<tr>
						<td><label>Harga </label></td><td width="50" style="text-align: center;">:</td>
						<td><input type="text" name="harga" style="width: 300px;" class="form" required /></td>
					</tr>
					<tr>
						<td></td><td></td>
						<td><input type="submit" name="simpan" value="SIMPAN" style="width: 50%;" /></td>
					</tr>
				</table>
			</form>
			<br>
			<br>
			<a href="?p=home">Kembali</a>