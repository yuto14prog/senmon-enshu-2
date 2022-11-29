<?php
	/* Page.php の内容を拡張する */

include_once	'Page.php';

class My_HTML extends Page {

	private	$q1;
	private	$q2;

	function __construct() {
		$this->q1 = array();
		$this->q1 = [ 1 => '経済学', 2 => '経営学', 3 => '会計', 4 => '情報',];

		$this->q2 = array();
		$this->q2 = [ 1 => '陸上', 2 => '柔道', 3 => '卓球', ];
	}

	function make_cmd_sql_insert() {
		$q1 = $_SESSION['q1'];
		$q2 = $_SESSION['q2'];
		$shimei = $_SESSION['shimei'];
		$password = $_SESSION['password'];
		$q2_data = [1 => 0, 2 => 0, 3 => 0,];
		foreach($q2 as $key => $value) {
			$q2_data[$value] = 1;
		}

		$str = '';
		foreach ($q2_data as $q2key => $q2value) {
				$str = $str.$q2value.',';
		}

		$sql = 'INSERT INTO kaitou VALUES ('.$q1.','.$str.'"'.$shimei.'","'.$password.'")';
		return $sql;
	}

	function endPage() {
		// $body = '';
		// $body = $body.'<p>終わりです</p>';

		$dbfile = '/xampp/sqlite/answer.db';
		if ( ! file_exists( $dbfile ) ) {
			$msg = $dbfile.'　がありません．<br>';
		} else {
			$msg = $dbfile.'　を開きます．<br>';
			$dsn = 'sqlite:'.$dbfile;

			$sql = $this->make_cmd_sql_insert();

			$db = new PDO( $dsn );
			$db->query($sql);
			$db = null;
		}
		$body = '';
		$body = $body.'<p>'.$msg.'</p>';
		$body = $body.'<p>終わりです</p>';

		return $body;
	}

	function modifyPage() {

		$s = $_SESSION['shimei'];
		$p = $_SESSION['password'];

		$body = '';
		$body = $body.'<form method="post" action="index.php">';

//		foreach ( $this->q1 as $key => $value ) {
//			if ( $_SESSION['q1'] == $key ) {
//				$body = $body.'<input type="radio" name="q1" value ="'.$key.'" checked >　'.$value.'<br>';
//			} else {
//				$body = $body.'<input type="radio" name="q1" value ="'.$key.'">　'.$value.'<br>';
//			}
//		}

		$button = $this->radioButton( $this->q1, 'q1', $_SESSION['q1'] );
		$body = $body.$button;

//		foreach ( $this->q2 as $key => $value ) {
//			if ( in_array( $key, $_SESSION['q2']  ) ) {
//				$body = $body.'<input type="checkbox" name="q2[]" value ="'.$key.'" checked >　'.$value.'<br>';
//			} else {
//				$body = $body.'<input type="checkbox" name="q2[]" value ="'.$key.'">　'.$value.'<br>';
//			}
//		}

		$box = $this->checkBox( $this->q2, 'q2', $_SESSION['q2'] );
		$body = $body.$box;


		$v = ' value="'.$s.'"';
		$body = $body.'ユーザID<input type="text" name="shimei"'.$v.' ><br>';

		$v = ' value="'.$p.'"';
		$body = $body.'パスワード<input type="password" name="password"'.$v.'><br>';

		$body = $body.'<input type="submit" name="page" value="確認">';
		$body = $body.'</form>';

		return $body;
	}

	function confirmPage() {

	$label = array();
	$label = [ 'q1' => '分野', 'q2' => '競技', 'shimei' => 'ID', 'password' => 'パスワード', 'page' => '処理', ];

	$body = '';
	$body = $body.'<form method="post" action="index.php">';

	$body = $body.'<table border="1">';
	$body = $body.'<tr>';
	$body = $body.'<td>添え字</td>';
	$body = $body.'<td>ラベル</td>';
	$body = $body.'<td>値</td>';
	$body = $body.'</tr>';

	foreach( $_SESSION as $key => $value ) {
		$body = $body.'<tr>';
		$body = $body.'<td>'.$key.'</td>';
		$body = $body.'<td>'.$label[$key].'</td>';
		$body = $body.'<td>';
		if ( $key == 'q1' ) {
			$body = $body.$this->q1[$value];
		} else if ( $key == 'q2' ) {
			$body = $body.'<table border="1">';
			$body = $body.'<tr>';
			$body = $body.'<td>添え字</td>';
			$body = $body.'<td>値</td>';
			$body = $body.'</tr>';
			foreach( $value as $key2 => $value2 ) {
				$body = $body.'<tr>';
				$body = $body.'<td>'.$key2.'</td>';
				$body = $body.'<td>'.$this->q2[$value2].'</td>';
				$body = $body.'</tr>';
			}
			$body = $body.'</table>';
		} else {
			$body = $body.$value;
		}
		$body = $body.'</td>';
		$body = $body.'</tr>';
	}
	$body = $body.'</table>';

	$body = $body.'<input type="submit" name="page" value="修正">';
	$body = $body.'<input type="submit" name="page" value="確定">';
	$body = $body.'</form>';

	return $body;
	}

	function inputPage() {
		$body = '';
		$body = $body.'<form method="post" action="index.php">';

//		foreach ( $this->q1 as $key => $value ) {
//			$body = $body.'<input type="radio" name="q1" value="'.$key.'">　'.$value.'<br>';
//		}

		$button = $this->radioButton( $this->q1, 'q1', 0 );
		$body = $body.$button;

//		foreach ( $this->q2 as $key => $value ) {
//			$body = $body.'<input type="checkbox" name="q2[]" value="'.$key.'">　'.$value.'<br>';
//		}

		$box = $this->checkBox( $this->q2, 'q2', [] );
		$body = $body.$box;

		$body = $body.'ユーザID<input type="text" name="shimei"><br>';
		$body = $body.'パスワード<input type="password" name="password"><br>';

		$body = $body.'<input type="submit" name="page" value="回答">';
		$body = $body.'</form>';

		return $body;
	}
}

?>
