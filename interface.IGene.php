<?php
	interface IGene
	{
		public function getValue();
		public function setValue($value);
		public function mutate();
	}	
?>