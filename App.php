<?php 
/**
 * Class App.php
 * mengatur Koneksi database, mengatur session login aplikasi
 *
 * @package Utama Aplikasi
 * @author <^--^>
 **/
class App
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

	/**
	 * Authentification login pada aplikasi 
	 *
	 * @param Strig (username, password)
	 * @return String (true or false)
	 **/
	public function authentification($username ='', $password = '',$level)
	{
		$pass_login = md5($password);
		$username = mysqli_real_escape_string($this->connection(), $username);

		$query_user = mysqli_query($this->connection(), "SELECT * FROM tb_user WHERE username = '{$username}' AND password = '{$pass_login}' AND Level = '{$level}'");

		if( ! mysqli_num_rows($query_user) ) :
			return false;
		else :
			$user = mysqli_fetch_array($query_user); 
			$_SESSION['is_login'] = $user['id_user'];
			$_SESSION['status'] = true;
			if($level == "admin")
				header("Location:index.php");
			else
				header("Location:index_kasir.php");
		endif;
	}

	/**
	 * Keluar aplikasi, menghapus sessiom
	 *
	 * @return string ( Redirect to login.php ) 
	 **/
	public function log_out()
	{
		session_destroy();
	}

	/**
	 * Menampilkan Data tb_app
	 *
	 * @return string
	 **/
	public function get_app($param = '')
	{
		$query = mysqli_query($this->connection(), "SELECT * FROM tb_app WHERE app_param = '{$param}'");
		$data = mysqli_fetch_object($query);
		return $data->app_value;
	}

	/**
	 * mengambil data User
	 *
	 * @return string
	 **/
	public function get_user($ID=0)
	{
		$ID = $_SESSION['is_login'];
		$query = mysqli_query($this->connection(), "SELECT * FROM tb_user WHERE id_user = '{$ID}'");
		return mysqli_fetch_object($query);
	}

	/**
	 * Atur Pengaturan Aplikasi , base64_encode
	 *
	 * @return string
	 **/
	public function set_pengaturan(Array $data)
	{
		$password = md5($data['password']);
		mysqli_query($this->connection(),"UPDATE tb_user SET username = '{$data['username']}', password = '{$password}' WHERE id_user = '{$_SESSION['is_login']}'");
		mysqli_query($this->connection(),"UPDATE tb_app SET app_value = '{$data['app-1']}' WHERE app_param = 'company_name'");
		mysqli_query($this->connection(),"UPDATE tb_app SET app_value = '{$data['app-2']}' WHERE app_param = 'company_address'");
		header("location:index.php?p=setting");
	}

} // END Class
