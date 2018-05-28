<?php

function show_pre($array = array(),$name = '')
{
	echo "<pre>";
	if($name != '')
		echo "$name\n";
	
	print_r($array);
	echo "</pre>";
}

/**
 * Doctrine Dumps the given data
 * 
 * @param mixed $data
 * @param bool $exit
 */
function ddump($data = NULL, $exit = FALSE){
	Doctrine\Common\Util\Debug::dump($data);
	if ($exit) exit;
}

function normalizeFileSize($bytes)
{
	$kb = number_format($bytes/1024,2);
	
	if($kb > 500)
	{
		$mb = number_format($kb/1024,2);
		return $mb." MB";
	}
	
	return $kb." KB";
}

function is_serialized($data) {
	
	# courtesy: wordpress
		if ( !is_string( $data ) )   return false;
		$data = trim( $data );
		if ( 'N;' == $data )
			return true;
		if ( !preg_match( '/^([adObis]):/', $data, $badions ) )
			return false;
		switch ( $badions[1] ) {
			case 'a' :
			case 'O' :
			case 's' :
				if ( preg_match( "/^{$badions[1]}:[0-9]+:.*[;}]\$/s", $data ) )
					return true;
				break;
			case 'b' :
			case 'i' :
			case 'd' :
				if ( preg_match( "/^{$badions[1]}:[0-9.E-]+;\$/", $data ) )
					return true;
				break;
		}
		return false;

}
?>