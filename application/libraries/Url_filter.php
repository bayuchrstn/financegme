<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Url_filter {

	function extract($filter)
	{
		// pre($filter);
		if($filter =='0' || $filter =='YTowOnt9'):
			return array();
		else:
			$url_decode = urldecode($filter);
			$base64_decode = base64_decode($url_decode);
			$unserialize = unserialize($base64_decode);
			return $unserialize;
		endif;
	}
}
