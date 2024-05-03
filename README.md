# Navigation 

* Date:    May 14, 2015
* Author:  Jaime A. Rodriguez <hi.i.am.jaime@gmail.com>
* Version: 1.5
* License: http://opensource.org/licenses/MIT

Creates a Navigation UL based on a JSON file. Uses JSON to structure navigation pages and attributes. It can detect what page is active and assign classes to them for special treatment.

## Usage

~~~ php
	$topNavData = '{
		"pages": [
			{
				"title": "Nav 1",
				"link": "/nav1/"
			}, {
				"title": "Nav 2",
				"link": "/nav2/",
				"pages": [
					{
						"title": "Subnav 1",
						"link": "/downloads/fpo.pdf",
						"target": "_blank"
					}
				]
			}
		]
	}';

	$topNav = new \Module\Navigation\Builder($topNavData);
~~~

~~~ html
	<!-- In body somewhere -->
	<nav class="top">
		<?= $topNav->show(); ?>
	</nav>
~~~

## Changelog

### Version 1.5

* Added the menu, submenu, and .active.child classes

### Version 1.4

* Now automatically sets $_SERVER["SCRIPT_NAME"] as current page
* Added multiple hook points for manipulating navigations

### Version 1.2

* Added a track parameter