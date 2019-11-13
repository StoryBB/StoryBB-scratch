# StoryBB
[![Build Status](https://travis-ci.org/StoryBB/StoryBB.svg?branch=master)](https://travis-ci.org/StoryBB/StoryBB) [![License](https://img.shields.io/badge/License-BSD%203--Clause-blue.svg)](https://opensource.org/licenses/BSD-3-Clause) 
![GitHub last commit](https://img.shields.io/github/last-commit/storybb/storybb/master.svg)

This is StoryBB - a new forum software designed for roleplaying and collaborative storytelling online.
The software is licenced under [BSD 3-clause license](https://opensource.org/licenses/BSD-3-Clause).

Contributions to documentation are licensed under [CC-by-SA 3](https://creativecommons.org/licenses/by-sa/3.0). Third party libraries or sets of images, are under their own licences.

## Notes:

Feel free to fork this repository and make your desired changes.

To get started, <a href="https://www.clahub.com/agreements/StoryBB/StoryBB">sign the Contributor License Agreement</a>.

## Branches organization:
* ***master*** - is the main branch, from where we release
* feature branches exist for working on small features. Please branch from where you intend to merge into. Hotfixes can bypass the release branch. 

## How to contribute:
* fork the repository. If you are not used to Github, please check out [fork a repository](https://help.github.com/fork-a-repo).
* branch your repository, to commit the desired changes.
* send a pull request to us. If you have not signed the contributor agreement, the bot will remind you to do so.
* the bot will also let you know if the code passes coding standards and other automated tests.

## Requirements
* MySQL 5.5 or higher / MariaDB 10.1 or higher
* PHP 7.0 or higher

#### Required PHP extensions
* cURL
* GD
* MySQLi

#### Optional PHP extensions
* mbstring (recommended)
* iconv (recommended)
