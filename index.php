<?php

/**
 * This is the main entry point for StoryBB.
 *
 * @package StoryBB (storybb.org) - A roleplayer's forum software
 * @copyright 2019 StoryBB project
 * @license 3-clause BSD (see accompanying LICENSE file)
 *
 * @version 1.0 Alpha 1
 */

$php_version = phpversion();
if (version_compare($php_version, '7.0.0', '<'))
{
	die("PHP 7.0.0 or newer is required, your server has " . $php_version . ". Please ask your host to upgrade PHP.");
}
