<?php
/*
 * Spectrum
 *
 * Copyright (c) 2011 Mikhail Kharitonov <mvkharitonov@gmail.com>
 * All rights reserved.
 *
 * This source file is subject to the new BSD license that is bundled
 * with this package in the file LICENSE.txt.
 */

namespace net\mkharitonov\spectrum\constructionCommands\baseCommands;
use net\mkharitonov\spectrum\constructionCommands\Manager;

require_once dirname(__FILE__) . '/../../init.php';

/**
 * @author Mikhail Kharitonov <mvkharitonov@gmail.com>
 * @link   http://www.mkharitonov.net/spectrum/
 */
class FailTest extends \net\mkharitonov\spectrum\constructionCommands\baseCommands\Test
{
	public function testShouldBeFailResultToRunResultsBuffer()
	{
		$it = Manager::it('foo', function() use(&$runResultsBuffer){
			Manager::fail('bar baz');
			Manager::fail('foooo', 110);
			$runResultsBuffer = Manager::getCurrentItem()->getRunResultsBuffer();
		});

		$it->run();

		$results = $runResultsBuffer->getResults();

		$this->assertFalse($results[0]['result']);
		$this->assertTrue($results[0]['details'] instanceof \net\mkharitonov\spectrum\constructionCommands\ExceptionFail);
		$this->assertEquals('bar baz', $results[0]['details']->getMessage());
		$this->assertEquals(0, $results[0]['details']->getCode());

		$this->assertFalse($results[1]['result']);
		$this->assertTrue($results[1]['details'] instanceof \net\mkharitonov\spectrum\constructionCommands\ExceptionFail);
		$this->assertEquals('foooo', $results[1]['details']->getMessage());
		$this->assertEquals(110, $results[1]['details']->getCode());
	}
}