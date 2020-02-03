<?php  
/**
 * Class Produk, 
 *
 * @package Produk
 * @author 
 **/
require 'App.php';

class Product extends App
{
	public function __construct()
	{
		if(empty($_SESSION['is_login'])) :
			header("Location:login.php");
		endif;
	}

	/**
	 * Menampilkan Data Semua Produj
	 *
	 * @param String, Integer ( search, limit, offset) 
	 * @return Array
	 **/
	public function data_produk($cari='', $start = 10, $limit = 0)
	{
		$query = mysqli_query($this->connection(), "SELECT tb_produk.*, tb_stok.* FROM tb_produk INNER JOIN tb_stok ON tb_produk.id_produk = tb_stok.id_produk WHERE tb_produk.kode_produk LIKE '%{$cari}%' OR tb_produk.nama_produk LIKE '%{$cari}%' ORDER BY tb_produk.id_produk DESC LIMIT {$start}, {$limit}");

		return $query;
	}

	/**
	 * Menghitung Data Semua Produj
	 *
	 * @param String ( search ) 
	 * @return Integer
	 **/
	public function num_produk($cari='')
	{
		$query = mysqli_query($this->connection(), "SELECT * FROM tb_produk WHERE kode_produk LIKE '%{$cari}%' OR nama_produk LIKE '%{$cari}%'");

		return $query;
	}

	/**
	 * Menghitung Data produk detail
	 *
	 * @param Integer ( id_produk ) 
	 * @return Integer
	 **/
	public function get($ID=0)
	{
		$query = mysqli_query($this->connection(), "SELECT tb_produk.*, tb_stok.* FROM tb_produk INNER JOIN tb_stok ON tb_produk.id_produk = tb_stok.id_produk WHERE tb_produk.id_produk = '{$ID}'");

		return $query;
	}

	/**
	 * Menambahkan Produk Baru
	 *
	 * @param Array ( Object dari form input produk)
	 * @return string
	 **/
	public function add_produk(Array $data)
	{
		// insert Produk
		$insert_produk = mysqli_query($this->connection(), "INSERT INTO tb_produk (kode_produk, nama_produk, harga) VALUES ('{$data['kode']}', '{$data['nama']}', '{$data['harga']}')");
		if( $insert_produk ) :
			// buat data stok
			$query_cek = mysqli_query($this->connection(), "SELECT MAX(id_produk) AS id_produk FROM tb_produk");
			$data_produk = mysqli_fetch_object($query_cek);
			$id_produk = (!$data_produk->id_produk) ? 1 : $data_produk->id_produk;
			$insert_stok = mysqli_query($this->connection(), "INSERT INTO tb_stok (id_produk, jumlah_stok) VALUES ('{$id_produk}', '{$data['stok']}')");
			if( $insert_stok ) :
				header("Location:index.php?p=tambah_produk&action=true");
			else :
				mysqli_query($this->connection(), "DELETE FROM tb_produk WHERE id_produk = '{$id_produk}");
				header("Location:index.php?p=tambah_produk&gagal");
			endif;
		else :
			header("Location:index.php?p=tambah_produk&gagal");
		endif;
	}

	/**
	 * Mengubah Data Produk
	 *
	 * @param Integer ( id_produk )
	 * @return string
	 **/
	public function update_produk(Array $data, $ID = 0)
	{
		$update_produk = mysqli_query($this->connection(), "UPDATE tb_produk SET kode_produk = '{$data['kode']}', nama_produk = '{$data['nama']}', harga = '{$data['harga']}' WHERE id_produk = '{$ID}'");
		if( $update_produk ) :
			$update_stok = mysqli_query($this->connection(), "UPDATE tb_stok SET jumlah_stok = '{$data['stok']}' WHERE id_produk = '{$ID}'");
			if( $update_stok ) :
				header("Location:index.php?p=edit_produk&id={$ID}&action=true");
			else :
				header("Location:index.php?p=edit_produk&id={$ID}&gagal");
			endif;
		else :
			header("Location:index.php?p=edit_produk&id={$ID}&gagal");
		endif;
	}

	/**
	 * Menghapus Data Produk
	 *
	 * @param Integer ( id_produk )
	 * @return string
	 **/
	public function delete_produk($ID=0)
	{
		$tables = array('tb_produk', 'tb_stok');
		foreach($tables as $tables) :
			$delete = mysqli_query($this->connection(),"DELETE FROM {$tables} WHERE id_produk = '{$ID}'");
		endforeach;
		if( $delete ) :
			header("location:index.php?p=data_produk");
		else :
			header("location:index.php?p=data_produk&action=true");
		endif;
	}

	/**
	 * Menampilkan Data Produk
	 *
	 * @return Array
	 **/
	public function json()
	{
		$query = mysqli_query( $this->connection(), "SELECT * FROM tb_produk");
		return $query;
	}


} // END class 
