<?php
	function lcg_randf($min, $max)
	{
		return $min + lcg_value() * abs($max - $min);
	}
	
	function PGA_loadClass($className)
	{

		$libdir = dirname(__FILE__);
		$directories = array(
			"",
			"genes/", 
			"strategies/", 
			"strategies/concrete/"
		);
		
		$fileNameFormats = array(
			"interface.%s.php", 
			"class.%s.php", 
		);
		
		foreach($directories as $directory)
	    {
	        foreach($fileNameFormats as $fileNameFormat)
	        {
	            $path = $libdir."/".$directory.sprintf($fileNameFormat, $className);
	            if(file_exists($path))
	            {
	                require_once $path;
	                return;
	            }
	        }
	    }
	}
	spl_autoload_register("PGA_loadClass");
?>