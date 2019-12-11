<?php
/**
 * Tables relating to roles in the StoryBB schema.
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

class Roles
{
	public static function group_description(): string
	{
		return 'Roles';
	}

	public static function return_tables(): array
	{
		return [
			Table::make('role',
				[
					'id' => Column::mediumint()->auto_increment(),
					'name' => Column::varchar(255),
				],
				[
					Index::primary(['id']),
				]
			),
			Table::make('role_group',
				[
					'id' => Column::int()->auto_increment(),
					'role' => Column::mediumint(),
					'group' => Column::smallint(),
				],
				[
					Index::primary(['id']),
				],
				[
					Constraint::from('role_group.role')->to('role.id'),
					Constraint::from('role_group.group')->to('group.id'),
				]
			),
			Table::make('role_permission',
				[
					'id' => Column::int()->auto_increment(),
					'role' => Column::mediumint(),
					'permission' => Column::varchar(255),
				],
				[
					Index::primary(['id']),
				],
				[
					Constraint::from('role_permission.role')->to('role.id'),
				]
			),
			Table::make('role_sitenode',
				[
					'id' => Column::int()->auto_increment(),
					'role' => Column::mediumint(),
					'sitenode' => Column::mediumint(),
				],
				[
					Index::primary(['id']),
				],
				[
					Constraint::from('role_sitenode.sitenode')->to('sitenode.id'),
					Constraint::from('role_sitenode.role')->to('role.id'),
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
			'background' => 'Wheat',
			'border' => 'Tan',
		];
	}
}
