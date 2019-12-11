<?php
/**
 * Tables relating to background tasks in the StoryBB schema.
 *
 * @package StoryBB (storybb.org) - A roleplayer's forum software
 * @copyright 2019 StoryBB project
 * @license 3-clause BSD (see accompanying LICENSE file)
 *
 * @version 1.0 Alpha 1
 */

namespace StoryBB\Schema\TableGroup;

use StoryBB\Schema\Table;
use StoryBB\Schema\Column;
use StoryBB\Schema\Index;
use StoryBB\Schema\Constraint;

class Tasks
{
	public static function group_description(): string
	{
		return 'Tasks';
	}

	public static function return_tables(): array
	{
		return [
			Table::make('task_adhoc',
				[
					'id' => Column::int()->auto_increment(),
					'class' => Column::varchar(255),
					'data' => Column::blob(),
					'time_added' => Column::datetime(),
				],
				[
					Index::primary(['id']),
				]
			),
			Table::make('task_scheduled',
				[
					'id' => Column::smallint()->auto_increment(),
					'class' => Column::varchar(255),
				],
				[
					Index::primary(['id']),
				]
			),
		];
	}

	/**
	 * Return the colour scheme that the UML builder should use.
	 *
	 * @return array Array of named or hex colours for PlantUML.
	 */
	public static function plantuml_colour_scheme(): array
	{
		return [
			'background' => 'LightGray',
			'border' => 'Gray',
		];
	}
}
