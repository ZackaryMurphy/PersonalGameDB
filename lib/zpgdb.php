<?php
	namespace Zpgdb\InterfaceSingleton;
	
	class ZpgdbInterfaceSingleton
	{
		private static $servername = 'localhost';
		private static $username = 'select_client';
		private static $password = '';
		private static $dbname = 'mygamedb';
		private static $tablename = 'games';
		
		private static $columns = array(
			'Name' => 'name',
			'Console' => 'console', 
			'Year' => 'year',
			'Ownership' => 'own',
			'Special' => 'spec', 
			'Wishlist' => 'wish',);
		
		private static $instance;
		
		public static function getInstance() 
		{
			if (null === static::$instance)
			{
				static::$instance = new static();
			}
			
			return static::$instance;
		}
		
		public function getNameColumnName()
		{
			return self::$columns['Name'];
		}
		
		public function getConsoleColumnName()
		{
			return self::$columns['Console'];
		}
		
		public function getYearColumnName() 
		{
			return self::$columns['Year'];
		}
		
		public function getOwnershipColumnName()
		{
			return self::$columns['Ownership'];
		}
		
		public function getSpecialColumnName()
		{
			return self::$columns['Special'];
		}
		
		public function getWishlistColumnName()
		{
			return self::$columns['Wishlist'];
		}
		
		public function getServerName()
		{
			return self::$servername;
		}
		
		public function getUsername()
		{
			return self::$username;
		}
		
		public function getPassword()
		{
			return self::$password;
		}
		
		public function getDatabaseName() 
		{
			return self::$dbname;
		}
		
		public function getTableName()
		{
			return self::$tablename;
		}
		
		protected function __construct() 
		{
			
		}
		
		private function __clone() 
		{
			
		}
		
		private function __wakeup()
		{
			
		}
	}
	
?>