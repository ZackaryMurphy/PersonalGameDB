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
			'Ownership' => 'owned',
			'Special' => '\'special edition\'', 
			'Wishlist' => 'wishlist',);
		
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
		
		protected function composeWhereClause($name, $console, $release, $own, $spec, $wish) 
		{
			$found = false;
			$whereClause = ' WHERE ';
			if ($name !== '' && !ctype_space($name)) 
			{
				$found = true;
				$whereClause .= ($this->getNameColumnName() . ' LIKE \'%' . $name . '%\' ');
			}
			if ($console !== 'ANY') {
				if ($found) {
					$whereClause .= ' AND ';
				}
				$found = true;
				$whereClause .= ($this->getConsoleColumnName() . ' = \'' . $console . '\' ');
			}
			if ($release > 0) {
				if ($found) {
					$whereClause .= ' AND ';
				}
				$found = true;
				$whereClause .= ($this->getYearColumnName() . ' = ' . $release . ' ');
			}
			if ($own !== 'ANY') {
				if ($found) {
					$whereClause .= ' AND ';
				}
				$found = true;
				$truthVal = ($own === 'YES') ? 1 : 0;
				$whereClause .= ($this->getOwnershipColumnName() . ' = (' . $truthVal . ') ');
			}
			if ($spec !== 'ANY') {
				if ($found) {
					$whereClause .= ' AND '; 
				}
				$found = true;
				$truthVal = ($spec === 'YES') ? 1 : 0;
				$whereClause .= ($this->getSpecialColumnName() . ' = ' . $truthVal . ' ');
			}
			if ($wish !== 'ANY') {
				if ($found) {
					$whereClause .= ' AND ';
				}
				$found = true;
				$truthVal = ($spec === 'YES') ? 1 : 0;
				$whereClause .= ($this->getWishlistColumnName() . ' = ' . $truthVal . ' ');
			}
			return $found ? $whereClause : '';
		}
		
		public function composeQuery($name, $console, $release, $own, $spec, $wish) {
			$queryString = 'SELECT * from ' . self::$tablename . $this->composeWhereClause($name, $console, $release, $own, $spec, $wish);
			return $queryString;
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