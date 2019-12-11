#!/usr/bin/env php
<?php
/**
 * Command line runner for StoryBB.
 *
 * @package StoryBB (storybb.org) - A roleplayer's forum software
 * @copyright 2019 StoryBB project
 * @license 3-clause BSD (see accompanying LICENSE file)
 *
 * @version 1.0 Alpha 1
 */

use StoryBB\ClassManager;
use Symfony\Component\Console\Application;

require_once __DIR__ . '/source/vendor/autoload.php';

$cli_commands = ClassManager::get_classes_implementing('StoryBB\\Cli\\Command');

$app = new Application();
foreach (ClassManager::get_classes_implementing('StoryBB\\Cli\\Command') as $command)
{
	$app->add(new $command);
}
$app->run();
