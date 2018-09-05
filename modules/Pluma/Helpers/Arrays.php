<?php
namespace Pluma\Helpers;

use StdClass;

/*
|--------------------------------------------------------------------------
| Array Helpers
|--------------------------------------------------------------------------
|
| Here are some functions to help in manipulating arrays.
|
*/
class Arrays
{
	/**
	 * Converts an array into object.
	 *
	 * @param  Array  $array The array to be transformed
	 * @return object
	 */
	public static function to_object( Array $array )
	{
		$obj = new stdClass;
		foreach ( $array as $k => $v ) {
			if ( strlen( $k ) ) {
				$obj->{ $k } = $v;
			}
		}

		return $obj;
	}

	/**
	 * Converts an array into object recursively.
	 *
	 * @param  mixed  $array The array/object to be transformed
	 * @return object
	 */
	public static function to_object_recursive( $array, $depth = false )
	{
		$obj = new stdClass;

           if ( is_object( $array ) ) $array = (array) $array;

           $d = 1;
           foreach ( $array as $k => $v ) {
			if ( strlen( $k ) ) {
				if ( is_array( $v ) ) {
    					$obj->{ $k } = self::to_object_recursive( $v ); //Recursion
				} else {
					$obj->{ $k } = $v;
				}
			}
                $d++;
		}

		return $obj;
	}

	public static function to_key_value_string( Array $array, $remove_empty_value = true, $separator = " " )
	{
		$str = array();
		foreach ( $array as $k => $v ) {
                if ( is_array( $v ) || is_object( $v ) ) {
                    $v = implode( $separator, (array) $v );
                }
			if ( $remove_empty_value ) {
				if ( ! empty( $v ) ) $str[] = "$k='$v'";
			} else {
				$str[] = "$k='$v'";
			}
		}

		return implode( $separator, $str );
	}
}