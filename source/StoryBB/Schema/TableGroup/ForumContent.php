<?php
/**
 * Tables relating to forum content in the StoryBB schema.
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

class ForumContent
{
	public static function group_description(): string
	{
		return 'Forum Content';
	}

	public static function return_tables(): array
	{
		return [
			Table::make('forum_category_node',
				[
					'id' => Column::int()->auto_increment(),
				],
				[
					Index::primary(['id']),
				],
				[
					Constraint::from('forum_category_node.id')->to('sitenode.id')->is_1to1(),
				]
			),
			Table::make('forum_board_node',
				[
					'id' => Column::int()->auto_increment(),
				],
				[
					Index::primary(['id']),
				],
				[
					Constraint::from('forum_board_node.id')->to('sitenode.id')->is_1to1(),
				]
			),
			Table::make('forum_topic',
				[
					'id' => Column::mediumint()->auto_increment(),
					'subject' => Column::varchar(255),
					'slug' => Column::varchar(255),
					'forum_node' => Column::int(),
					'first_message' => Column::int(),
					'last_message' => Column::int(),
				],
				[
					Index::primary(['id']),
					Index::key(['slug']),
				],
				[
					Constraint::from('forum_topic.forum_node')->to('forum_board_node.id'),
				]
			),
			Table::make('forum_post',
				[
					'id' => Column::int()->auto_increment(),
					'topic' => Column::mediumint(),
					'posted_user' => Column::mediumint(),
					'posted_character' => Column::int(),
				],
				[
					Index::primary(['id']),
					Index::key(['topic']),
				],
				[
					Constraint::from('forum_post.topic')->to('forum_topic.id'),
					Constraint::from('forum_post.posted_user')->to('user.id'),
					Constraint::from('forum_post.posted_character')->to('character.id'),
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
			'background' => 'LightSkyBlue',
			'border' => 'RoyalBlue',
		];
	}
}
