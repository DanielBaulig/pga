<?php
	class PieCakeStrategy implements ISelectionStrategy
	{
		public function select(Population $population)
		{
			$rand = lcg_randf(0, $population->getTotalFitness());
			reset($population);
			while(current($population) && $rand > current($population)->getFitness())
			{
				$rand -= current($population)->getFitness();
				next($population);
			}
			if ($rand > 0) // might happen due to numeric effects
			{
				end($population); // return last element if it happens
			}
			return current($population);
		}
		protected function __construct() { }
		private static $instance = null;
		public static function getInstance()
		{
			if (PieCakeStrategy::$instance == null)
				PieCakeStrategy::$instance = new PieCakeStrategy();
			return PieCakeStrategy::$instance;
		}		
	}
?>