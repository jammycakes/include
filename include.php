<?php

/*
Plugin Name: Include
Plugin URI: http://www.jamesmckay.net/code/include/
Description: Includes a file of code in your blog post or page.
Version: 1.0
Author: James McKay
Author URI: http://www.jamesmckay.net/
*/

/* ========================================================================== */

/*
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.

 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
 */



define ('JM_CUSTOM_SCRIPTS_BASE', dirname(__FILE__) . '/scripts/');

class jm_include_file
{
	function jm_include_file()
	{
		add_filter('the_content', array(&$this, 'include_files'));
	}

	function getfile($incfile)
	{
		global $args;
		// Get the filename and arguments if any
		$thefile = preg_split("/\\s+/", $incfile, 2);

		// Now get the arguments

		$matches = array();
		$args = array();
		if (isset($thefile[1])) {
			$r = preg_match_all
					("/([^\\s=]+)(?:\\s*=\\s*((['\"])(.*?)\\3|[^'\"]\S*))?/ims",
					$thefile[1], $matches, PREG_PATTERN_ORDER);

			for ($j = 0; $j < count ($matches[0]); $j++) {
				$tag = $matches[0][$j];
				$key = $matches[1][$j];
				$val = $matches[3][$j] != ''
					? $matches[4][$j]
					: $matches[2][$j];
				if ($key != '') {
					if (isset ($args[$key])) {
						if (is_array($args[$key])) {
							array_push($args[$key], $val);
						}
						else {
							$args[$key] = array($args[$key], $val);
						}
					}
					else {
						$args[$key] = $val;
					}
				}
			}
		}

		unset($matches, $j, $tag, $key, $val);

		$thefile = JM_CUSTOM_SCRIPTS_BASE . $thefile[0];
		if (!file_exists($thefile)) $thefile .= '.php';
		if (file_exists($thefile)) {
			ob_start();
			$including = true;
			include($thefile);
			$result = ob_get_contents();
			ob_end_clean();
			unset ($args);
			return $result;
		}
		else
		{
			return '<strong>Module not found ' . $incfile . '</strong>';
		}
	}


	function include_files($text)
	{
		$textarr = preg_split("/(<!--\\s*#\\s*include\\s+.*\\s*-->)/Uis", $text, -1, PREG_SPLIT_DELIM_CAPTURE);
		$stop = count($textarr);
		$output = '';

		for ($i = 0; $i < $stop; $i++)
		{
			$chunk = $textarr[$i];
			if (preg_match("/^<!--\\s*#\\s*include\s+(.*)\s*-->/Uis", $chunk, $matches))
			{
				$output .= $this->getfile(trim($matches[1]));
			}
			else
			{
				$output .= $chunk;
			}
		}

		return $output;
	}
}

$myincfile = new jm_include_file();

?>