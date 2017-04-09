<?php

/**
 * Generate an asset path for the application.
 *
 * @param  string  $path
 * @param  bool    $secure
 * @return string
 */
function assets($path, $secure = null)
{

	$path = explode("::", $path);

	if (isset($path[1])) {
		$path = "src/".$path[0]."/".$path[1];
	} else {
		$path = $path[0];
	}

	if(file_exists($path))
		$path = $path."?v=".filemtime($path);

    $path = asset($path, $secure);

	return $path;
}