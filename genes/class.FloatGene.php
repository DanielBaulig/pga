<?php
	class FloatGene implements IGene
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
			//FIXME: This function is flawed, it will only reduce $value
			$this->setValue($this->value * lcg_randf(0,1));
		}
		public function __toString()
		{
			return $this->value;
		}	
	} 	
?>