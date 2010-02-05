<?php
	//require_once "./../interface.IGene.php";
	/* Gene
	 * 
	 * ArrayMap
	 * 
	 *  $gen_map = array(key1=>"value1", key2=>"value2", key3=>"value3");
	 *  
	 *  $m_MapKey = key2;
	 *  mutate: $m_MapKey = random_key($gen_map);
	 *  
	 *  validation of keys?
	 *  gene map as class?
	 */

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