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

namespace spectrum\core;
require_once dirname(__FILE__) . '/../init.php';

class SpecContainerPatternTest extends SpecContainerTest
{
	protected $currentSpecClass = '\spectrum\core\SpecContainerPattern';

	/**
	 * @var SpecContainerArgumentsProvider
	 */
	private $spec;
	protected function setUp()
	{
		parent::setUp();
		$this->spec = new SpecContainerPattern();
	}

/**/

	public function testSetArguments_ShouldBeThrowExceptionIfNotAllowSpecsModifyWhenRunning()
	{
		Config::setAllowSpecsModifyWhenRunning(false);
		$specs = $this->createSpecsTree('
			' . $this->currentSpecClass . '
			->It
		');

		$specs[0]->errorHandling->setCatchExceptions(false);
		$specs[1]->setTestCallback(function() use($specs){
			$specs[0]->setArguments('foo');
		});

		$this->assertThrowException('\spectrum\core\Exception', 'Modify specs when running deny', function() use($specs){
			$specs[0]->run();
		});
	}
}