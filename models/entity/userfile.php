<?php 
	/**
	* userfile
	*/
	class userfile
	{

		private $userid;
		private $fileid;

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