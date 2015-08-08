<?php
class sql
{
	
	
	protected $_host = '';
	protected $_user = '';
	protected $_pwd = '';
	protected $_db = '';
	protected $_con = '';
	
	protected $_requete = '';
	public $_nbRequetes = 0;
	
	//méthodes
	public function __construct($_host,$_user,$_pwd,$_db){
		$this->_host=$_host;	
		$this->_user=$_user;	
		$this->_pwd=$_pwd;	
		$this->_db=$_db;	
		
		$this->connect();
	}
	
	
	protected function connect(){
		
		$this->_con = mysql_connect($this->_host, $this->_user, $this->_pwd);
		mysql_select_db($this->_db,$this->_con);
		
	}
	
	public function query($request){
		$this->_requete = mysql_query($request) or die("Erreur requete :".mysql_error());
		$this->_nbRequetes++;
		return $this->_requete;
	}
	
	public function nbLignes(){
		return mysql_num_rows($this->_requete);
	}
	
	public function __destruct(){
		mysql_close($this->_con);	
		
	}
	
	
	
	
	
	
}


?>