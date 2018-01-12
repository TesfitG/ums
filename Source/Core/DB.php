<?php  namespace App\Core;
//this class is responsible for all CRUD operations for this project.
use PDO;
class DB
{
    private static $_instance = null;
    private $_pdo;
	
    private function __construct()
    {
		session_start();
		$dbname='';
		$username='';
		$password='';
		if(isset($_SESSION['univ']))
		{
			switch($_SESSION['univ'])
			{
				case 'astu': 
				$dbname = 'gcp_560d7f4ddd1bd4129f05'; 
				$username='bc1b42e7e30580';
				$password='67a767d6';
				break;
				
				case 'aau': 
				$dbname = 'gcp_7a6e18880e1cd5299b68'; 
				$username='bf794cad1dacca';
				$password='87b7008b';
				break;
				
				case 'aastu': 
				$dbname = 'gcp_9436d56f0606144ebf97'; 
				$username='b8e83f022c3dd7';
				$password='4403f4e0';
				break;
				
				case 'du': 
				$dbname = 'gcp_a4a8800ef254dfac2b96';
				$username='bb1367cc04f65d';
				$password='b30cb857';
				break;
				
				default: 
				$dbname = 'gcp_560d7f4ddd1bd4129f05'; 
				$username='bc1b42e7e30580';
				$password='67a767d6';
			}
		}
		else
		{
			$dbname = 'gcp_560d7f4ddd1bd4129f05'; 
				$username='bc1b42e7e30580';
				$password='67a767d6';
		}
		
        try 
		{		
            $this->_pdo = new PDO('mysql:host=us-cdbr-gcp-east-01.cleardb.net;dbname='.$dbname, $username, $password );
        } 
		catch (PDOException $e) 
		{
            die($e->getMessage());
        }
    }

    //create object for this class by using this function.
    public static function getDB()
    {
		$dbname='';
		$username='';
		$password='';
		if(isset($_SESSION['univ']))
		{
			switch($_SESSION['univ'])
			{
				case 'astu': 
				$dbname = 'gcp_560d7f4ddd1bd4129f05'; 
				$username='bc1b42e7e30580';
				$password='67a767d6';
				break;
				
				case 'aau': 
				$dbname = 'gcp_7a6e18880e1cd5299b68'; 
				$username='bf794cad1dacca';
				$password='87b7008b';
				break;
				
				case 'aastu': 
				$dbname = 'gcp_9436d56f0606144ebf97'; 
				$username='b8e83f022c3dd7';
				$password='4403f4e0';
				break;
				
				case 'du': 
				$dbname = 'gcp_a4a8800ef254dfac2b96';
				$username='bb1367cc04f65d';
				$password='b30cb857';
				break;
				
				default: 
				$dbname = 'gcp_560d7f4ddd1bd4129f05'; 
				$username='bc1b42e7e30580';
				$password='67a767d6';
				break;
			}
		}
		else
		{
			$dbname = 'gcp_560d7f4ddd1bd4129f05'; 
			$username='bc1b42e7e30580';
			$password='67a767d6';
		}
		
        if (!isset(self::$_instance))
		{
			//self::$_instance = new PDO('mysql:host=127.0.0.1;dbname='.$dbname, 'root', '' );    
			self::$_instance = new PDO('mysql:host=us-cdbr-gcp-east-01.cleardb.net;dbname='.$dbname, $username, $password );
        }
        return self::$_instance;
    }

}


?>