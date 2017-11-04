<?php
class DataBase
{
	private static $_objetoDataBase;
	private $_objetoPDO;
	private function __construct()
	{
		try {
			//$this->_objetoPDO = new PDO('mysql:host=localhost;dbname=dbapp;charset=utf8', 'root', '', array(PDO::ATTR_EMULATE_PREPARES => false,PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
			$this->_objetoPDO = new PDO('mysql:host=mysql.hostinger.es;dbname=u695151705_dbest;charset=utf8', 'u695151705_apptp', 'mainola1', array(PDO::ATTR_EMULATE_PREPARES => false,PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
			$this->_objetoPDO->exec("SET CHARACTER SET utf8");
		} catch (PDOException $e) {
			print "Error!!!" . $e->getMessage();
			die();
		}
	}
	public function Query($sql)
	{
		$obj=$this->_objetoPDO->prepare($sql);
		$obj->execute();
		return $obj->fetchAll(PDO::FETCH_ASSOC);
	}
	public function QueryUp($sql)
	{
		$obj=$this->_objetoPDO->prepare($sql);
		$obj->execute();
	}
	public static function Connect()//singleton
	{
		if (!isset(self::$_objetoDataBase)) {
			self::$_objetoDataBase = new DataBase();
		}	return self::$_objetoDataBase;
	}
	// Evita que el objeto se pueda clonar
	public function __clone()
	{
		trigger_error('La clonaci&oacute;n de este objeto no est&aacute; permitida!!!', E_USER_ERROR);
	}
}
// $obj=DataBase::Connect();
// $obj->Query("DELETE FROM usuario WHERE id=1");
// $resultado=$obj->Query("SELECT * FROM usuario");
// var_dump($resultado);
?>