<?php
	class IntGene implements IGene
	{
		private $value;
		
		public function getValue()
		{
			return $this->value;	
		}
		public function setValue($value)
		{
			$this->value = $value;
		}
		public function mutate()
		{
			$this->setValue(rand());
		}
		public function __toString()
		{
			return $this->value;
		}	
	} 
?>