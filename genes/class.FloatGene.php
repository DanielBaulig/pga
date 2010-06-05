<?php
	class FloatGene implements IGene
	{
		private $value;
		// to prevent FloatGenes mutate to collapse it's value to 0
		// values closer to zero than +/- zeroLimit will be switched
		// to +/- zeroLimit instead.
		// note: FloatGene can never reach 0 or switch from positive to 
		// negative (and vice versa)
		private static $zeroLimit = 0.0001;
		
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
			// note that this will not work for value == 0, so, we'll prevent value ever reaching 0
			$this->value = $this->value * lcg_randf(0.5,2.0);
			if ($this->value < FloatGene::$zeroLimit && $this->value > 0.0)
			{
				$this->value = FloatGene::$zeroLimit;
			} 
			if ($this->value > - FloatGene::$zeroLimit && $this->value < 0.0)
			{
				$this->value = - FloatGene::$zeroLimit;
			}
			// this should not happen, but could if zeroLimit is chosen to low, yell about it!
			assert($this->value != 0.0);
		}
		public function __toString()
		{
			return $this->value;
		}	
	} 	
?>