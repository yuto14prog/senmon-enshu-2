<?php
	include_once	'Page.php';

	$dbfile = '/xampp/sqlite/answer.db';

	if ( ! file_exists( $dbfile ) ) {
		$msg = $dbfile.'　がありません．<br>';
	} else {
		$msg = $dbfile.'　を開きます．<br>';
		$dsn = 'sqlite:'.$dbfile;

		$sql = 'SELECT * FROM kaitou';

		$db = new PDO( $dsn );
		$result = $db->query($sql);
		$db = null;
	}

	$data = $result->fetchAll();
	print_r($data);

	$body = '';
	$body = $body.'<p>'.$msg.'</p>';

	$page = new Page();
	$page->setTitle('データベースアクセス');
	$page->setBody( $body );
	$page->display();
?>