<?php
	class PieCakeStrategy implements ISelectionStrategy
	{
		public function select(Population $population)
		{
			$rand = lcg_randf(0, $population->getTotalFitness());
			$population->rewind();
			while($population->valid() && $rand > $population->current()->getFitness())
			{
				$rand -= $population->current()->getFitness();
				$population->next();
			}
			if ($rand > 0) // might happen due to numeric effects
			{
				$population->end(); // return last element if it happens
			}
			return $population->current();
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