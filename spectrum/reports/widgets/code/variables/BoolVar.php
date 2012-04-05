<?php
/*
 * (c) Mikhail Kharitonov <mvkharitonov@gmail.com>
 *
 * For the full copyright and license information, see the
 * LICENSE.txt file that was distributed with this source code.
 */

namespace spectrum\reports\widgets\code\variables;

class BoolVar extends Variable
{
	protected $type = 'bool';

	protected function getHtmlForValue($variable)
	{
		return ' <span class="value">' . ($variable ? 'true' : 'false') . '</span>';
	}
}