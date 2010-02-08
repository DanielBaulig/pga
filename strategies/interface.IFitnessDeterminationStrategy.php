<?php
	/** This interface defines a fitness determination strategy (fitness function)
	 * 
	 * The IFitnessDeterminationStrategy interface defines how a chromosomes
	 * fitness is determined. 
	 */
	interface IFitnessDeterminationStrategy extends ISingleton
	{
		/** Determines a chromosomes fitness.
		 * 
		 * This method determines a chromosomes fitness. An implementing class
		 * should calculate the given chromosomes fitness and return it to
		 * the caller.
		 * 
		 * @param Chromsome $chromosome
		 * @return Float
		 */
		public function determineFitness(Chromsome $chromosome);
	}
?>