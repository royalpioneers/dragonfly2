<?php
class DataBase
{
	private static $dbName = 'dragonfly';
	private static $dbHost = 'localhost';
	private static $dbUserName = 'root';
	private static $dbUserPassword = '123456';

	private static $cont = null;

	public function __construct()
	{
		die('Inicio de Funcion no es....');		
	}
	
	public static function connect()
	{
		if (null == self::$cont){
			try {
				self::$cont = new PDO(
					"mysql:host=".self::$dbHost.";"."dbname=".self::$dbName, self::$dbUserName, self::$dbUserPassword,
					array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES  \'UTF8\''));
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}
		return self::$cont;
	}
	public static function disconnect()
	{
		self::$cont = null;
	}

}