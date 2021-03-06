<?php
namespace Redaxscript\Server;

/**
 * children class to get file
 *
 * @since 2.4.0
 *
 * @category Redaxscript
 * @package Server
 * @author Henry Ruhs
 */

class File extends ServerAbstract
{
	/**
	 * get the output
	 *
	 * @since 2.4.0
	 *
	 * @return string
	 */

	public function getOutput()
	{
		$output = basename($this->_request->getServer('SCRIPT_NAME'));
		return $output;
	}
}