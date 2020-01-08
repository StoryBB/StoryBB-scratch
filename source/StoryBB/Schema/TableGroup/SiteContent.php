<?php
/**
 * Tables relating to site content (nodes) in the StoryBB schema.
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

class SiteContent
{
	public static function group_description(): string
	{
		return 'Site Content';
	}

	public static function return_tables(): array
	{
		return [
			Table::make('sitenode',
				[
					'id' => Column::int()->auto_increment(),
					'name' => Column::varchar(255),
					'parent' => Column::int(),
					'description' => Column::text(),
					'nodetype' => Column::varchar(255),
					'visible' => Column::tinyint(),
				],
				[
					Index::primary(['id']),
				],
				[
					Constraint::from('sitenode.parent')->to('sitenode.id'),
				]
			),
			Table::make('sitenode_access',
				[
					'id' => Column::int()->auto_increment(),
					'sitenode' => Column::int(),
					'group' => Column::smallint(),
					'can_see' => Column::tinyint(),
					'can_access' => Column::tinyint(),
				],
				[
					Index::primary(['id']),
				],
				[
					Constraint::from('sitenode_access.sitenode')->to('sitenode.id'),
					Constraint::from('sitenode_access.group')->to('group.id'),
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
			'background' => 'GhostWhite',
			'border' => 'Gainsboro',
		];
	}
}
