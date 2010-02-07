<?php
	class Population implements ArrayAccess, Countable, Iterator
	{
		private $chromosomes = array();
		private $totalFitness = 0;
		private $generation = 0;

		private $bestChromosome = null;
		private $worstChromosome = null;		
		
		protected function selectChromosome(ISelectionStrategy $selectionStrategy)
		{
			$selectionStrategy->select($this);
		}
		
		public function getAverageFitness()
		{
			return $this->totalFitness / $this->count();
		}
		
		public function getTotalFitness()
		{
			return $this->totalFitness;
		}
		
		public function getBestChromosome()
		{
			return $this->bestChromosome;
		}
		
		public function getWorstChromosome()
		{
			return $this->worstChromosome;
		}
		
		public function createNextPopulation(ISelectionStrategy $selectionStrategy, 
											 IRecombinationStrategy $recombinationStrategy,
											 IFitnessDeterminationStrategy $fitnessDeterminationStrategy)
		{
			return $this->mergePopulations($this, $selectionStrategy, $recombinationStrategy, $fitnessDeterminationStrategy);
		}
		
		public function mergePopulations(Population $population,
										 ISelectionStrategy $selectionStrategy,
										 IRecombinationStrategy $recombinationStrategy,
										 IFitnessDeterminationStrategy $fitnessDeterminationStrategy)
		{
			$nextPopulation = new Population();
			$nextPopulation->generation = $this->generation + 1;
			
			while ($this->count() > $nextPopulation->count())
			{
				
				$newChromosome = $this->selectChromosome($selectionStrategy)->recombine
								(
									$recombinationStrategy, 
									$population->selectChromosome($selectionStrategy)
								);
				
				$newChromosome->calculateFitnes($fitnessDeterminationStrategy);
				$nextPopulation->totalFitness += $newChromosome->getFitness();
				
				if($newChromosome->getFitness() > $bestChromosome->getFitness() || $bestChromosome == null)
					$bestChromosome = $newChromosome;
				if ($newChromosome->getFitness() < $worstChromosome->getFitness() || $worstChromosome == null)
					$worstChromosome = $newChromosome;

				array_push( $nextPopulation, $newChromosome );
			}
			
			return $nextPopulation;
		}
		
		public function populate(array $chromosomeTemplate, $count, $randomize=true)
		{
			unset($this->chromosomes);
			while ($this->count() < $count)
			{
				$this->chromosomes[] = new Chromosome($chromosomeTemplate, $randomize);
			}
		}
		
		// Interface Implementations
		public function count()
		{
			return count($this->chromosomes);
		}
		public function rewind()
		{
			reset($this->chromosomes);
		}
		public function current()
		{
			return current($this->chromosomes);
		}
		public function key()
		{
			return key($this->chromosomes);
		}
		public function next()
		{
			return next($this->chromosomes);
		}
		public function valid()
		{
			return $this->current() !== false;
		}
		public function offsetExists($offset)
		{
			return isset($this->chromosomes[$offset]);
		}
		public function offsetGet($offset)
		{
			return isset($this->chromosomes[$offset]) ? ($this->chromosomes[$offset]) : null;
		}
		public function offsetSet($offset, $value)
		{
			// Populations should ony take Chromosome objects!
			if (!($value instanceof Chromosome))
				throw new UnexpectedValueException();
			$this->chromosomes[$offset] = $value;
		}
		public function offsetUnset($offset)
		{
			unset($this->chromosomes[$offset]);
		}

	}
?>