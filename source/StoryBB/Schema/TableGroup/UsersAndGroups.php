<?php
/**
 * Tables relating to users and groups in the StoryBB schema.
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

class UsersAndGroups
{
	public static function group_description(): string
	{
		return 'Users and Groups';
	}

	public static function return_tables(): array
	{
		return [
			Table::make('user',
				[
					'id' => Column::int()->auto_increment(),
					'username' => Column::varchar(255),
					'displayname' => Column::varchar(255),
					'password' => Column::varchar(255),
					'email' => Column::varchar(255),
				],
				[
					Index::primary(['id']),
				]
			),
			Table::make('character',
				[
					'id' => Column::int()->auto_increment(),
					'user' => Column::int(),
					'displayname' => Column::varchar(255),
				],
				[
					Index::primary(['id']),
				],
				[
					Constraint::from('character.user')->to('user.id'),
				]
			),
			Table::make('group',
				[
					'id' => Column::smallint()->auto_increment(),
					'name' => Column::varchar(255),
					'displayorder' => Column::smallint(),
				],
				[
					Index::primary(['id']),
				]
			),
			Table::make('user_group',
				[
					'id' => Column::int()->auto_increment(),
					'user' => Column::int(),
					'group' => Column::smallint(),
				],
				[
					Index::primary(['id']),
				],
				[
					Constraint::from('user_group.user')->to('user.id'),
					Constraint::from('user_group.group')->to('group.id'),
				]
			),
			Table::make('character_group',
				[
					'id' => Column::int()->auto_increment(),
					'character' => Column::int(),
					'group' => Column::smallint(),
				],
				[
					Index::primary(['id']),
				],
				[
					Constraint::from('character_group.character')->to('character.id'),
					Constraint::from('character_group.group')->to('group.id'),
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
			'background' => 'FireBrick',
			'border' => 'DarkRed',
			'text' => 'White',
		];
	}
}
