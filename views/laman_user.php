<h3 style=" text-align: center;">Laman User Transaksi</h3><hr>
<?php  
if(isset($_GET['add'])) :
	$transaksi->add($_GET['id'], $_GET['qty']);
endif;
if(isset($_GET['update'])) :
	$transaksi->update($_GET['id'], $_GET['qty']);
endif;
if(isset($_GET['delete'])) :
	$transaksi->delete($_GET['delete']);
endif;
if(isset($_GET['destroy'])) :
	$transaksi->destroy();
endif;
if(isset($_GET['selesai'])) :
	$transaksi->simpan_transaksi($_GET['tunai']);
endif;
?>
<div class="grid_9" style="margin-left: 25%;">
	<form action="index.php" method="get">
		<select name="id" id="produk" style="width: 230px;" required="">
			<option value="">~ Pilih Produk ~</option>
			<?php $query = $product->json(); while ($row = mysqli_fetch_object( $query ) ) : ?>
			<option value="<?php echo $row->id_produk; ?>"><?php echo $row->nama_produk; ?></option>
			<?php endwhile; ?>
		</select>
		<input type="hidden" name="p" value="laman_transaksi">
		<input type="text" name="qty" style="width: 90px;" placeholder="Jumlah.." required="">
		<input type="submit" name="add" value="Masukkan" style="width: 100px; padding:6px;">
	</form>
</div>
<div class="grid_9">
	<p style="text-align: center; color: red;"><?php echo (isset($_GET['action'])) ? 'Gagal Menghapus Produk!!' : ''; ?></p>
</div>
<table width="100%">
	<thead>
		<tr>
			<th width="20">No.</th>
			<th width="100">Kode Produk</th>
			<th>Nama Produk</th>
			<th width="100">Jumlah </th>
			<th>Harga</th>
			<th>Subtotal</th>
			<th width="78">Opsi</th>
		</tr>
	</thead>
	<tbody>
	<?php 
	if(empty($_SESSION['produk'])) :

	else :
	$no=1; $total = 0; foreach($_SESSION['produk'] as $items => $row) : 
	$subtotal = $row['harga'] * $row['qty'];
	$total += $subtotal;
	?>
		<tr>
			<td><?php echo $no++; ?>.</td>
			<td><?php echo $row['kode']; ?></td>
			<td><?php echo $row['nama']; ?></td>
			<td><?php echo $row['qty'] ?></td>
			<td><?php echo number_format($row['harga']) ?></td>
			<td><?php echo number_format($subtotal); ?></td>
			<td> 
			<a href="#" onclick="ubah_transaksi('<?php echo $row['id']; ?>', '<?php echo $row['qty'] ?>');"  class="text-blue">Ubah</a> | <a href="#" onclick="delete_transaksi('<?php echo $row['id']; ?>');" class="text-red">Hapus</a></td>
		</tr>
	<?php endforeach; endif; ?>
	</tbody>
	<tfoot>
		<tr>
			<td colspan="5"><span class="pull-right">Total :</span></td>
			<td><?php echo (empty($_SESSION['produk'])) ? '' : number_format($total) ?></td>
			<td></td>
		</tr>
	</tfoot>
</table>
<div style="width: 50%; float: left; margin-top:15px;">
	<a href="?p=laman_transaksi&destroy=true" class="tombol">Batalkan Transaksi</a>
</div>
<div class="grid_9" style="margin-left: 70%;">
	<form action="index.php" method="get">
		<input type="text" name="tunai" style="width: 175px;" placeholder="Dibayar.." required="">
		<input type="hidden" name="p" value="laman_transaksi">
		<input type="submit" name="selesai" value="Simpan" style="width: 100px; padding:6px;">
	</form>
<p style="text-align: center; color: red;"><?php echo (isset($_GET['kurang'])) ? 'Uang Anda Tidak mencukupi!' : ''; ?></p>
</div>
<style>
table, td, th { border: 1px solid black;  font-size:12px; padding:7px; }
table { border-collapse: collapse;  width: 100%; }
th { height: 30px; }
ul.pagination { display: inline-block; padding: 0; margin: 0; margin-top:30px; }
ul.pagination li {display: inline; }
ul.pagination li a { color: black; border-radius:5px; margin-left: 10px; float: left; padding: 3px 8px; text-decoration: none; transition: background-color .3s; border: 1px solid #ddd; }
ul.pagination li a.active { background-color: #AF5855; color: white; border: 1px solid #AF5855; }
ul.pagination li a:hover:not(.active) {background-color: #ddd;}
.text-blue { color:blue; } .text-red { color:red; }
select {
    padding:3px;
    margin: 0;
    -webkit-border-radius:4px;
    -moz-border-radius:4px;
    border-radius:4px;
    -webkit-box-shadow: 0 3px 0 #ccc, 0 -1px #fff inset;
    -moz-box-shadow: 0 3px 0 #ccc, 0 -1px #fff inset;
    box-shadow: 0 3px 0 #ccc, 0 -1px #fff inset;
    background: black;
    color:#888;
    border:none;
    outline:none;
    display: inline-block;
    -webkit-appearance:none;
    -moz-appearance:none;
    appearance:none;
    cursor:pointer;
}
</style>
<?php if(isset($_GET['cetak'])) : ?>
<script>
        var newwindow = window.open('print_nota.php?id=' + <?php echo $_GET['cetak'] ?>,'name','height=600,width=800');
        if (window.focus) {
            newwindow.focus()
        }
</script>
<?php endif; ?>
