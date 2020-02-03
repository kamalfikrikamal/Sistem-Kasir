<?php  
/**
 * Class Transaksi
 *
 * @package transaksi
 * @author 
 **/

require 'Product.php';

class Transaksi extends Product
{
	private $connection;

	function __construct()
	{

		if(empty($_SESSION['is_login'])) :
			header("Location:login.php");
		endif;
	}

	/**
	 * menambahkan Produk ke transaksi
	 *
	 * @param Integer ( id_produk, quantity )
	 * @return string
	 **/
	public function add($ID=0, $qty = 1)
	{
		$row = mysqli_fetch_object($this->get($ID));
		session_name('produk');
		if(empty($_SESSION['produk'][$ID])) :
			$_SESSION['produk'][$ID] = array(
				'id' => $ID,
				'qty' => $qty,
				'kode' => $row->kode_produk,
				'nama' => $row->nama_produk,
				'harga' => $row->harga,
			);
		else :
			$cart = $_SESSION['produk'][$ID];
			$_SESSION['produk'][$ID] = array(
				'id' => $ID,
				'qty' => $qty + $cart['qty'],
				'kode' => $row->kode_produk,
				'nama' => $row->nama_produk,
				'harga' => $row->harga,
			);
		endif;
		header("Location:index_kasir.php?p=laman_transaksi_kasir");
	}

	/**
	 * Mengubah data Keranjang transaksi
	 *
	 * @param Integer ( id_produk, quantity )
	 * @return string
	 **/
	public function update($ID=0, $qty = 1)
	{
		$row = mysqli_fetch_object($this->get($ID));
		$cart = $_SESSION['produk'][$ID];
		$_SESSION['produk'][$ID] = array(
			'id' => $ID,
			'qty' => $qty,
			'kode' => $row->kode_produk,
			'nama' => $row->nama_produk,
			'harga' => $row->harga,
		);
		header("Location:index_kasir.php?p=laman_transaksi_kasir");
	}

	/**
	 * Menghapu Keranjang transaksi
	 *
	 * @param Integer ( id_produk)
	 * @return string
	 **/
	public function delete($ID=0)
	{
		unset($_SESSION['produk'][$ID]);
		header("Location:index_kasir.php?p=laman_transaksi_kasir");
	}

	/**
	 * Menghapu Keranjang transaksi
	 *
	 * @param Integer ( id_produk)
	 * @return string
	 **/
	public function destroy()
	{
		foreach($_SESSION['produk'] as $items => $row) :
			unset($_SESSION['produk'][$row['id']]);
		endforeach;
		header("Location:index_kasir.php?p=laman_transaksi_kasir");
	}	

	/**
	 * menyimpan Data Transaksi
	 *
	 * @return string
	 **/
	public function simpan_transaksi($bayar = 0)
	{
		$tanggal = date('Y-m-d');

		$total = 0;
		foreach($_SESSION['produk'] as $items => $row) :
			$produk = mysqli_fetch_object($this->get($row['id']));
			$subtotal = $row['harga'] * $row['qty'];
			$total += $subtotal;
			$hitung_stok = $produk->jumlah_stok - $row['qty'];
			$stok_sekarang = ($hitung_stok <= 0) ? 0 : $hitung_stok;
			if($bayar < $total) :
				header("Location:index_kasir.php?p=laman_transaksi_kasir&kurang=true");
			else :
				mysqli_query($this->connection(), "UPDATE tb_stok SET jumlah_stok = '{$stok_sekarang}' WHERE id_produk = '{$row['id']}'");
				mysqli_query($this->connection(), "INSERT INTO tb_detail_transaksi (no_faktur, id_produk, quantity, subtotal) VALUES ('{$this->faktur()}', '{$row['id']}','{$row['qty']}', '{$subtotal}')");
			endif;
		endforeach;
		mysqli_query($this->connection(), "INSERT INTO tb_transaksi (no_faktur, tanggal, bayar, total) VALUES ('{$this->faktur()}','{$tanggal}','{$bayar}', '{$total}')");
		$this->destroy();
		$kurang_satu = $this->faktur() - 1;
		header("Location:index_kasir.php?p=laman_transaksi_kasir&cetak={$kurang_satu}");
	}

	/**
	 * Generate Nomor Faktur
	 *
	 * @return Integer
	 **/
	public function faktur()
	{
		$query_cek = mysqli_query($this->connection(), "SELECT MAX(no_faktur) AS no_faktur FROM tb_transaksi");
		$transaksi = mysqli_fetch_object($query_cek);
		$no_faktur = $transaksi->no_faktur;
		return ++$no_faktur;
	}

	/**
	 *  Menampilkan Data Transaksi 
	 *
	 * @return Array
	 **/
	public function get_transaksi($ID=0)
	{
		$query = mysqli_query($this->connection(), "SELECT * FROM tb_transaksi WHERE no_faktur = '{$ID}'");
		return $query; 
	}

	/**
	 *  Menampilkan Data Transaksi
	 *
	 * @return Array
	 **/
	public function get_produk_transaksi($ID=0)
	{
		$query = mysqli_query($this->connection(), "SELECT tb_detail_transaksi.*, tb_produk.* FROM tb_detail_transaksi INNER JOIN tb_produk ON tb_detail_transaksi.id_produk = tb_produk.id_produk WHERE tb_detail_transaksi.no_faktur = '{$ID}'");
		return $query; 
	}

} // END class Transaksi.php