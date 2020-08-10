<?php 
	/**
	* file
	*/
	class file
	{

		private $fileid;
		private $content;
		private $inputtime;
		private $filename;

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