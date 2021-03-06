<?php
/*
 * (c) Mikhail Kharitonov <mail@mkharitonov.net>
 *
 * For the full copyright and license information, see the
 * LICENSE.txt file that was distributed with this source code.
 */

namespace spectrum\constructionCommands\baseCommands;
use spectrum\constructionCommands\Manager;

require_once __DIR__ . '/../../init.php';

class DescribeTest extends \spectrum\constructionCommands\baseCommands\Test
{
	public function testShouldBeAllowToCallAtDeclaringState()
	{
		$describe = Manager::describe('', function(){});
		$this->assertTrue($describe instanceof \spectrum\core\SpecContainerDescribeInterface);
	}

	public function testShouldBeThrowExceptionIfCalledAtRunningState()
	{
		$this->assertThrowException('\spectrum\constructionCommands\Exception', '"describe"', function()
		{
			$it = new \spectrum\core\SpecItemIt();
			$it->errorHandling->setCatchExceptions(false);
			$it->setTestCallback(function(){
				Manager::describe('', function(){});
			});
			$it->run();
		});
	}

	public function testShouldBeReturnNewSpecContainerDescribeInstance()
	{
		$describe = Manager::describe('', function(){});
		$this->assertTrue($describe instanceof \spectrum\core\SpecContainerDescribeInterface);
	}
}