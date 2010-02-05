<?php
	//require_once "class.IntGene.php";

	class ConstrainedIntGene extends IntGene
	{
		private $constrain;
		
		public function __construct($constrain)
		{
			$this->constrain = $constrain;
		}
		
		public function setValue($value)
		{
			parent::setValue($value % $this->constrain);
		}
	}
?>