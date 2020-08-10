<?php 
	/**
	* user
	*/
	class user
	{

		private $userid;
		private $uaccount;
		private $upwd;
		private $authority;

		public function __get($key)
	    {
	        return $this->$key;
	    }

	    public function __set($key, $value)
	    {
	        $this->$key = $value;
	    }
	}
 ?>