<?php
	/**************************************************************************
	* Sanitizer.php defines Cleaner class - a set of faux type specific
	* methods to agrressively sanitize user input.
	* Usage:
	*	'require Sanitize.php;' in <head>
	*	'$cleaner = new Cleaner();'
	*	'$theInt2bTested = $cleaner->CleanInt($theInt2bTested);' or
	*	'$theDecimal2bTested = $cleaner->CleanDecimal($theDecimal2bTested);' or
	*	'$theString2bTested = $cleaner->CleanString($theString2bTested);' or
	* 	'$theDate2bTested = $cleaner->CleanDate($theDate2bTested);'
	***************************************************************************/
	class Cleaner {
	 
	 	// Removes everything that is not an integer.
		function CleanInt($integer) {
			$integer = preg_replace('/[^0-9]/', '', $integer);
			return $integer;
		}

		/* Removes everything but "0-9 . -", thus allows negatively
		   signed or unsigned decimal, English only, thus no \d allowed!
		   Dependency: BootStrap int and float input fields utilize
		   min=0 & input type delimiters as needed to preclude "embeded
		   '-' and '.' " chars in parameter $decimal before it gets here! */
		function CleanDecimal($decimal) {
			$decimal = preg_replace('/[^0-9.-]/', '', $decimal);
			return $decimal;
		}
	 
		// Removes everything not 'alphanumeric' '.' '-' ','.  
		function CleanString($string) {
			$string = preg_replace('/[^0-9A-Za-z.-,]+/' ,'', $string);
			return $string;
		}

		// Removes everything no numeric or '-'.
		function CleanDate($date) {
			$date = preg_replace('/[^0-9-]/', '', $date);
			return $date;
		}
	
	}

?>
