<?php

class Chromosome implements ArrayAccess, Countable, Iterator
{

	private $genes = array();
	private $fitness = 0;
	
	public function printGenes()
	{
		print_r($this->genes);
		print_r(current($this->genes));
	}
	
	public function __clone()
	{
		// All genes in $genes need to be cloned if we create a clone of the chromosome
		$copy = $this->genes;
		$this->genes = array();
		foreach($copy as $key => $value)
		{
			$this->genes[$key] = clone $value;
		}
	}
	
	// Interface Implementations
	public function count()
	{
		return count($this->genes);
	}
	public function rewind()
	{
		reset($this->genes);
	}
	public function current()
	{
		return current($this->genes);
	}
	public function key()
	{
		return key($this->genes);
	}
	public function next()
	{
		return next($this->genes);
	}
	public function valid()
	{
		return $this->current() !== false;
	}
	public function offsetExists($offset)
	{
		return isset($this->genes[$offset]);
	}
	public function offsetGet($offset)
	{
		return isset($this->genes[$offset]) ? ($this->genes[$offset]) : null;
	}
	public function offsetSet($offset, $value)
	{
		// Chromosomes should only take objects implementing the IGene interface!
		if (!($value instanceof IGene))
			throw new UnexpectedValueException();
		$this->genes[$offset] = $value;
	}
	public function offsetUnset($offset)
	{
		unset($this->genes[$offset]);
	}
	public function calculateFitness(IFitnessDeterminationStrategy $strategy)
	{
		$this->fitness = $strategy->determineFitness($this);
	}
	public function getFitness()
	{
		return $this->fitness;
	}
	public function recombine($partner, IRecombinationStrategy $strategy)
	{
		return $strategy->recombine($this, $partner);
	}
}

?>