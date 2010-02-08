<?php
	/** This interface defines a Gene.
	 * 
	 * Each class, that implements the IGene interface may be added
	 * to a chromomsome.
	 */
	interface IGene
	{
		/** Returns the genes value
		 * 
		 * @return mixed
		 */
		public function getValue();
		/** Sets the genes value
		 * 
		 * @param mixed $value
		 */
		public function setValue($value);
		/** Sets the gene to a random new value
		 * 
		 */
		public function mutate();
	}	
?>