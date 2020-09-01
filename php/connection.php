<?php
/*
 * class for connection to DB
 * */
class connection{

    //login connection to DB
	private $login = 'work5';

	//password for DB
	private $pwd = 'R9fmOO8FCjzKJfDU';

	//DB name
	private $db = 'work5';

	private $server = 'localhost';
	private $port = '3306';
	
	public function getLogin(){
		return $this->login;
	}
	
		public function getPwd(){
		return $this->pwd;
	}
	
		public function getDB(){
		return $this->db;
	}
	
		public function getServer(){
		return $this->server;
	}
	
		public function getPort(){
		return $this->port;
	}
	
}



?>