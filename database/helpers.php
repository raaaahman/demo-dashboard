<?php
	function getField($field_name, $array) {
		$result = null;
		if (is_array($array) && array_key_exists($field_name, $array)) {
			$result = $array[$field_name];
		}
		return htmlentities($result, ENT_QUOTES, SITE_CHARSET);
	}

	function hashUserPassword( $password ) {
		return password_hash( $password, PASSWORD_DEFAULT);
	}
