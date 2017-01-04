<?php

class Database {

	private $user;
	private $password;
	private $host;
	private $port;
	private $database;
	private $prefix;
	private $RUN_MODE = "run";

	private $connection;

	private static $INSTANCE;

	/**
	 * Konstruktor
	 * @param unknown_type $host
	 * @param unknown_type $user
	 * @param unknown_type $password
	 */
	private function __construct ()
	{
		$this -> $user = 'db348734303';
		$this -> $password = 'london2010';
		$this -> $host = 'db2922.1und1.de';
		$this -> $port = conf_db_port;
		$this -> $database = 'dbo348734303';
		$this->writeLog("DATABASE-OBJECT CREATED","OK");
	}



	/**
	 * Baut eine Verbindung zur Datenbank auf
	 */
	private function connect(){
		// Verbindungsvariable samt Zugangsdaten festlegen
		$db = @mysql_connect ($this->host, $this->user, $this->password) or die("Can not create a database-connection!");

		// Verbindung ueberpruefen
		if (true) {
			$this -> connection = $db;
			mysql_select_db($this->database);

			// Auf UTF8 Konvertierung umstellen
			mysql_query("SET NAMES 'utf8'");
			mysql_query("SET CHARACTER SET 'utf8'");
			$this->writeLog("DATABASE CONNECTED","OK");
			return true;
		}
		$this->writeLog("ERROR! DBCONNECTION FAILED",false);
		return false;
	}

	/**
	 * liefert etwaige SQL-Fehler
	 */
	private function getErrors(){
		return mysql_connect_error();
	}

	/**
	 * Beendet die Datenbankverbindung.
	 */
	private function disconnect(){
		if($this->connection){
			mysql_close($this->connection);
		}
		$this->writeLog("DATABASE CLOSED","");
		return true;
	}

	/**
	 * fï¿½hrt einen Query auf der Datenbank aus und liefert das Ergebniss zurï¿½ck.
	 * @param $sql
	 */
	private function performQuery($sql){
		$result =  mysql_query($sql);
		$this->writeLog($sql,$result);
		return $result;
	}

	/**
	 * Diese Funktion šffnet die Logdatei der Datenbank
	 * und fŸgt dieser eine Zeile hinzu
	 * @param unknown_type $msg
	 */
	private function writeLog($query,$result){
		if(isset($this->RUN_MODE) && !empty($this->RUN_MODE) && $this->RUN_MODE == "debug"){
			$logFile = fopen(dirname(__FILE__)."/database.log", 'a');
			if($logFile != false){
				if($result == null){
					$result = "NULL";
				}else if($result == false){
					$result = "FALSE";
				}else{
					$result = "OK";
				}
				$msg = "[".date("d.m.Y - G:i:s",time())."]:[QUERY: ".$query."] [RESULT:".$result."]";
				$msg = str_replace(chr(10), ' ', $msg);
				$msg = str_replace(chr(13), ' ', $msg);
				$msg = preg_replace('~\s{2,}~', ' ', $msg);
				fwrite($logFile,$msg."\n");
				fclose($logFile);
			}
		}
	}


	/*******************************Static Functions*******************************/

	public static function init(){
		$db = new Database();
		$db->connect();
		Database::$INSTANCE = $db;
	}

	/**
	 * fï¿½hrt eine Abfrage auf der Datenbank aus
	 * @param unknown_type $sql
	 */
	public static function query($sql){
		return Database::$INSTANCE->performQuery($sql);
	}

	/**
	 * Liefert den Datentyp fï¿½r ein bestimmtes Tabellenfeld
	 * @param unknown_type $table
	 * @param unknown_type $column
	 */
	public static function getDatatypeFor($table, $column){
		$sql = "SELECT DATA_TYPE as type FROM INFORMATION_SCHEMA.COLUMNS WHERE table_name = '".$table."' AND column_name LIKE '".$column."'";
		$dbres = Database::query($sql);
		if($dbres->next()){
			return $dbres->getCurrentLine()->type;
		}
		return false;
	}

	/**
	 * escaped den angegebenen String
	 */
	public static function escape($var){
		return mysql_real_escape_string($var);
	}

	/**
	 * trennt die datenbankverbindung
	 */
	public static function quit(){
		Database::$INSTANCE->disconnect();
	}

}
?>