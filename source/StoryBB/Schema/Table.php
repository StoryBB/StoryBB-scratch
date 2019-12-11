<?php

/**
 * This class handles tables.
 *
 * @package StoryBB (storybb.org) - A roleplayer's forum software
 * @copyright 2019 StoryBB and individual contributors (see contributors.txt)
 * @license 3-clause BSD (see accompanying LICENSE file)
 *
 * @version 1.0 Alpha 1
 */

namespace StoryBB\Schema;

use StoryBB\Schema\Exception\InvalidIndexException;

/**
 * This class handles tables. Specifically it models a single table and describes the columns and indexes
 * it should have.
 */
class Table
{
	/** @var string $table_name The internal table name, without prefix. */
	protected $table_name = '';

	/** @var array $columns An array of Column objects that are the columns for this table. */
	protected $columns = [];

	/** @var array $indexes An array of Index objects that are the indexes for this table. */
	protected $indexes = [];

	/** @var array $constraints An array of Constraint objects that are the constraints for this table. */
	protected $constraints = [];

	/**
	 * Constructs a Table object. Not to be called publically.
	 *
	 * @param string $table_name The name of the table being investigated or manipulated.
	 * @param array $columns The columns this table object should have.
	 * @param array $indexes The indexes this table object should have.
	 * @param array $constraints The constraints this table object should have.
	 * @return Table The table instance.
	 */
	private function __construct(string $table_name, array $columns, array $indexes = [], array $constraints = [])
	{
		$this->table_name = $table_name;
		$this->columns = $columns;
		$this->indexes = $indexes;
		$this->constraints = $constraints;

		$this->check_index_columns();
		$this->check_auto_increment();
	}

	/**
	 * Make sure all the columns requested in indexes are in the definition.
	 */
	protected function check_index_columns()
	{
		$index_contents = [];
		foreach ($this->indexes as $indexnum => $index)
		{
			foreach ($index->get_raw_columns() as $id => $column)
			{
				if (is_numeric($id) && !is_numeric($column))
				{
					$index_contents[$indexnum][] = $column;
				}
				else
				{
					$index_contents[$indexnum][] = $id;
				}
			}
		}
		foreach ($index_contents as $indexnum => $index_columns)
		{
			foreach ($index_columns as $column)
			{
				if (!isset($this->columns[$column]))
				{
					throw new InvalidIndexException('Table ' . $this->get_table_name() . ' defines an index on column ' . $column . ' which does not exist');
				}
			}
		}
	}

	/**
	 * Make sure that if a column is defined as auto_increment, that it is also the primary key.
	 *
	 * @todo Reimplement from legacy.
	 */
	protected function check_auto_increment()
	{
		return true;
	}

	/**
	 * Factory method.
	 * @param string $table_name The name of the table being investigated or manipulated.
	 * @param array $columns The columns this table object should have.
	 * @param array $indexes The indexes this table object should have.
	 * @param array $constraints The constraints this table object should have.
	 * @return Table The table instance.
	 */
	public static function make(string $table_name, array $columns, array $indexes = [], array $constraints = [])
	{
		return new Table($table_name, $columns, $indexes, $constraints);
	}

	/**
	 * Returns the name of this table.
	 *
	 * @return string The table's name.
	 */
	public function get_table_name(): string
	{
		return $this->table_name;
	}

	/**
	 * Returns the columns in this table.
	 *
	 * @return array An array of Column objects that this table needs to have.
	 */
	public function get_columns(): array
	{
		return $this->columns;
	}

	/**
	 * Returns the indexes in this table.
	 *
	 * @return array An array of Index objects that this table needs to have.
	 */
	public function get_indexes(): array
	{
		return $this->indexes;
	}

	/**
	 * Returns the constraints in this table.
	 *
	 * @return array An array of Constraint objects that this table cares about.
	 */
	public function get_constraints(): array
	{
		return $this->constraints;
	}
}
