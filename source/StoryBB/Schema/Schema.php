<?php
/**
 * Returns all the tables in core StoryBB.
 *
 * @package StoryBB (storybb.org) - A roleplayer's forum software
 * @copyright 2019 StoryBB project
 * @license 3-clause BSD (see accompanying LICENSE file)
 *
 * @version 1.0 Alpha 1
 */

namespace StoryBB\Schema;

class Schema
{
	/**
	 * Returns a list of all tablegroups within the schema.
	 *
	 * @return array An array of the classes that are the tablegroups.
	 */
	public static function get_all_tablegroups(): array
	{
		return [
			'\\StoryBB\\Schema\\TableGroup\\UsersAndGroups',
			'\\StoryBB\\Schema\\TableGroup\\Roles',
			'\\StoryBB\\Schema\\TableGroup\\SiteContent',
			'\\StoryBB\\Schema\\TableGroup\\ForumContent',
			'\\StoryBB\\Schema\\TableGroup\\DirectMessages',
			'\\StoryBB\\Schema\\TableGroup\\Tasks',
		];
	}

	/**
	 * Returns all the tables in core StoryBB, without prefixes.
	 *
	 * @return array An array of Table instances representing the schema.
	 */
	public static function get_tables(): array
	{
		$schema = [];

		$tablegroups = static::get_all_tablegroups();
		foreach ($tablegroups as $tablegroup)
		{
			$schema = array_merge($schema, $tablegroup::return_tables());
		}

		return $schema;
	}
}
