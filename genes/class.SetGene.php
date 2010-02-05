<?php
	abstract class SetGene implements IGene
	{
		protected static $set_of_legal_values = array();
		protected $value;
		
		public function setValue($value)
		{
			assert(in_array($value, SetGene::$set_of_legal_values));
			$this->value = $value;
		}
		public function getValue()
		{
			return $this->value;
		}
		public function mutate()
		{
			$this->value = SetGene::$set_of_legal_values[array_rand(SetGene::$set_of_legal_values, 1)];
		}
		public function __toString()
		{
			return $this->value;
		}
	} 
?>