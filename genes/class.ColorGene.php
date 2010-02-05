<?php	
	//require_once "./class.SetGene.php";

	class ColorGene extends SetGene
	{
		public function __construct()
		{
			ColorGene::$set_of_legal_values = 
				array("green", "red", "blue", "yellow", "purple", "orange");
		}
	}
?>