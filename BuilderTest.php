<?php
/**
 * PHPUnit Unit Tests
 *
 * Unit tests for \Module\Navigation\Builder
 *
 * php version 7.0.0
 *
 * @category Test
 * @package  Sleepy
 * @author   Jaime A. Rodriguez <hi.i.am.jaime@gmail.com>
 * @license  http://opensource.org/licenses/MIT; MIT
 * @link     https://sleepymustache.com
 */

require_once dirname(__FILE__) . '/../../sleepy/core/Loader.php';

use PHPUnit\Framework\TestCase;
use Sleepy\Core\SM;
use Sleepy\Core\Hook;
use Sleepy\Core\Loader;
use Module\Navigation\Builder;

Loader::register();
Loader::addNamespace('Sleepy', dirname(__FILE__) . '/../../sleepy');
Loader::addNamespace('Sleepy\Core', dirname(__FILE__) . '/../../sleepy/core');
Loader::addNamespace('Module', dirname(__FILE__) . '/../../modules');

require_once dirname(__FILE__) . '/../../../settings.php';

/**
 * Builder Unit Test
 *
 * @category Test
 * @package  Module\Navigation
 * @author   Jaime A. Rodriguez <hi.i.am.jaime@gmail.com>
 * @license  http://opensource.org/licenses/MIT; MIT
 * @link     https://sleepymustache.com
 */
class BuilderTest extends TestCase
{
    /**
     * Setup method
     *
     * @return void
     */
    public function setUp() : void
    {
        $this->nav = new \Module\Navigation\Builder('{
            "pages": [
                {
                    "title": "1",
                    "target": "_blank",
                    "link": "1.html",
                    "pages": [
                        {
                            "title": "1.1",
                            "link": "1.1.html"
                        }, {
                            "title": "1.2",
                            "link": "1.2.html"
                        }
                    ]
                }, {
                    "id": "second",
                    "title": "2",
                    "link": "2.html",
                    "class": "second"
                }
            ]
        }');
    }
            
    /**
     * Test if Actions work
     *
     * @return void
     */
    public function testNav() : void 
    {
        $nav = $this->nav->show();
        $this->assertEquals($nav,'<span class="toggle"></span><ul class="menu"><li class="has-children"><a target="_blank" href="1.html">1</a><ul class="submenu"><li><a href="1.1.html">1.1</a></li><li><a href="1.2.html">1.2</a></li></ul></li><li class="second"><a id="second" href="2.html">2</a></li></ul>');
    }
            
    public function testTarget() : void 
    {
        $nav = $this->nav->show();
        $this->assertEquals($nav,'<span class="toggle"></span><ul class="menu"><li class="has-children"><a target="_blank" href="1.html">1</a><ul class="submenu"><li><a href="1.1.html">1.1</a></li><li><a href="1.2.html">1.2</a></li></ul></li><li class="second"><a id="second" href="2.html">2</a></li></ul>');
    }
    
    public function testActive() : void 
    {
        $this->nav->setCurrent('1.html');
        $nav = $this->nav->show();
        $this->assertEquals($nav,'<span class="toggle"></span><ul class="menu"><li class="has-children active"><a target="_blank" href="1.html">1</a><ul class="submenu"><li><a href="1.1.html">1.1</a></li><li><a href="1.2.html">1.2</a></li></ul></li><li class="second"><a id="second" href="2.html">2</a></li></ul>');
    }
    
    public function testSubActive() : void 
    {
        $this->nav->setCurrent('1.1.html');
        $nav = $this->nav->show();
        $this->assertEquals($nav,'<span class="toggle"></span><ul class="menu"><li class="has-children active-child"><a target="_blank" href="1.html">1</a><ul class="submenu"><li class="active"><a href="1.1.html">1.1</a></li><li><a href="1.2.html">1.2</a></li></ul></li><li class="second"><a id="second" href="2.html">2</a></li></ul>');
    }
}