<?php 
/**
 * Class App.php
 * mengatur Koneksi database, mengatur session login aplikasi
 *
 * @package Utama Aplikasi
 * @author <^--^>
 **/
class App2
{
	protected $db_name = 'toko_alat_tulis'; // Nama Database
	protected $db_user = 'root'; // Username Database
	protected $db_pass = ''; // Password Database
	protected $db_host = 'localhost'; //  Host Server

	public function __construct()
	{
		session_start();
	}

	/**
	 * Membuat Koneksi ke database
	 *
	 * @param String ( dari global method ^-^ )
	 * @return String
	 **/
	public function connection()
	{
		$connect_db = new mysqli( $this->db_host, $this->db_user, $this->db_pass, $this->db_name );
		
		if ( mysqli_connect_errno() ) :
			printf("Maaf tidak bisa Koneksi : %s", mysqli_connect_error());
			exit();
		endif;
		return $connect_db;
	}

} // END Class
