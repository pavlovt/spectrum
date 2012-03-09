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

namespace net\mkharitonov\spectrum\core\plugins\basePlugins\report\components\code\variables;

/**
 * @author Mikhail Kharitonov <mvkharitonov@gmail.com>
 * @link   http://www.mkharitonov.net/spectrum/
 */
abstract class VariableHierarchical extends Variable
{
	public function getStyles()
	{
		$componentSelector = '.g-code-variables-' . htmlspecialchars($this->type);

		return
			'<style type="text/css">' . $this->getNewline() .
				$this->getIndention() . "$componentSelector { display: inline-block; vertical-align: top; }" . $this->getNewline() .
				$this->getIndention() . "$componentSelector $componentSelector { display: inline;  }" . $this->getNewline() .
				$this->getIndention() . "$componentSelector>.elements:before { content: '\\2026'; }" . $this->getNewline() .
				$this->getIndention() . "$componentSelector>.elements>.element { display: none; }" . $this->getNewline() .
				$this->getIndention() . "$this->expandedParentSelector $componentSelector>.elements:before { display: none; }" . $this->getNewline() .
				$this->getIndention() . "$this->expandedParentSelector $componentSelector>.elements>.element { display: block; margin-left: 1px; padding-left: 20px; border-left: 1px solid rgba(150, 150, 150, 0.5); }" . $this->getNewline() .
			'</style>' . $this->getNewline();
	}

	protected function getHtmlForElement($key, $val)
	{
		$codeComponent = new \net\mkharitonov\spectrum\core\plugins\basePlugins\report\components\code\Code($this->getReport());

		$keyHtml = '<span class="key">' . htmlspecialchars("[$key]") . '</span>';
		$operatorHtml = ' ' . $codeComponent->getHtmlForOperator('=>') . ' ';
		$valHtml = $this->trimNewline($codeComponent->getHtmlForVariable($val));

		return '<span class="element">' . $keyHtml . $operatorHtml . $valHtml . '</span>';
	}
}