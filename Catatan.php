<?php  
/**
 * Class Produk, 
 *
 * @package Produk
 * @author 
 **/

class Catatan
{
	protected $db_name = 'toko_alat_tulis'; // Nama Database
        protected $db_user = 'root'; // Username Database
        protected $db_pass = ''; // Password Database
        protected $db_host = 'localhost'; //  Host Server

	public function connection()
        {
                $connect_db = new mysqli( $this->db_host, $this->db_user, $this->db_pass, $this->db_name );

                if ( mysqli_connect_errno() ) :
                        printf("Maaf tidak bisa Koneksi : %s", mysqli_connect_error());
                        exit();
                endif;
                return $connect_db;
        }

	public function catatan_transaksi($cari='', $start = 10, $limit = 0)
	{
		$query = mysqli_query($this->connection(), "SELECT tb_transaksi.*, tb_user.* FROM tb_transaksi INNER JOIN tb_user ON tb_transaksi.no_faktur = tb_user.id_user WHERE tb_transaksi.tanggal LIKE '%{$cari}%' OR tb_transaksi.total LIKE '%{$cari}%' ORDER BY tb_transaksi.no_faktur DESC LIMIT {$start}, {$limit}");

		return $query;
	}


} // END class 
