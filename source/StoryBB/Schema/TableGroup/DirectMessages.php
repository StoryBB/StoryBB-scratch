<?php
/**
 * Tables relating to direct messages in the StoryBB schema.
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

class DirectMessages
{
	public static function group_description(): string
	{
		return 'Direct Messages';
	}

	public static function return_tables(): array
	{
		return [
			Table::make('direct_message',
				[
					'id' => Column::int()->auto_increment(),
					'subject' => Column::varchar(255),
				],
				[
					Index::primary(['id']),
				]
			),
			Table::make('direct_message_participants',
				[
					'id' => Column::int()->auto_increment(),
					'direct_message' => Column::int(),
					'user' => Column::int(),
				],
				[
					Index::primary(['id']),
					Index::key(['direct_message']),
					Index::key(['user']),
				],
				[
					Constraint::from('direct_message_participants.direct_message')->to('direct_message.id'),
					Constraint::from('direct_message_participants.user')->to('user.id'),
				]
			),
			Table::make('direct_message_messages',
				[
					'id' => Column::int()->auto_increment(),
					'direct_message' => Column::int(),
					'user' => Column::int(),
					'messagebody' => Column::mediumtext(),
					'datetime' => Column::datetime(),
				],
				[
					Index::primary(['id']),
					Index::key(['direct_message']),
					Index::key(['user']),
				],
				[
					Constraint::from('direct_message_messages.direct_message')->to('direct_message.id'),
					Constraint::from('direct_message_messages.user')->to('user.id'),
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
			'background' => 'LightSeaGreen',
			'border' => 'SeaGreen',
		];
	}
}
