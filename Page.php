<?php
class Page {
	private $title;
	private $body;

	function radioButton( $kv_array, $name, $init_val ) {
		$button = '';
		foreach ( $kv_array as $key => $value ) {
			if ( $init_val == $key ) {
				$button = $button.'<input type="radio" name="'.$name.'" value ="'.$key.'" checked >'.$value.'<br>';
			} else {
				$button = $button.'<input type="radio" name="'.$name.'" value ="'.$key.'">'.$value.'<br>';
			}
		}
		return $button;
	}

	function checkBox( $kv_array, $name, $init_array ) {
		$box = '';
		foreach ( $kv_array as $key => $value ) {
			if ( in_array( $key, $init_array ) ) {
				$box = $box.'<input type="checkbox" name="'.$name.'[] " value ="'.$key.'" checked >'.$value.'<br>';
			} else {
				$box = $box.'<input type="checkbox" name="'.$name.'[] " value ="'.$key.'">'.$value.'<br>';
			}
		}
		return $box;
	}

	function setTitle( $title ) {
		$this->title = $title;
	}

	function setBody( $body ) {
		$this->body = $body;
	}

	function display() {
		print '<!DOCTYPE html>'."\n";
		print '<html>'."\n";
		print '<head>'."\n";
		print '<title>'.$this->title.'</title>'."\n";
		print '</head>'."\n";
		print '<body>'."\n";
		print $this->body;
		print '</body>'."\n";
		print '</html>'."\n";
	}
}
?>
