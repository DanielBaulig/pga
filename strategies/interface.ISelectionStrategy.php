<?php
	/** This interface defines a selection strategy
	 * 
	 * The ISelectionStrategy interface defines how a chromosome
	 * is selected from a population. 
	 */
	interface ISelectionStrategy extends ISingleton
	{
		/** Selects a chromosome from a given population.
		 * 
		 * This method should return a chromsome from the population. The
		 * class implementing this interface must determine the strategy used
		 * to select the chromosome, eg. Pie-Cake strategy or Alpha strategy.
		 * 
		 * @param Population $population
		 * @return Chromsome
		 */
		public function select(Population $population);
	}
?>