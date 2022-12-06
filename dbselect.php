<?php
	include_once	'My_HTML.php';

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
	print_r('<br> -------------------------- <br>');
	$a2 = ['q21' => 0,'q22' => 0,'q23' => 0,];
	foreach ($data as $key => $answer) {
		foreach ($a2 as $field => $value) {
			$a2[$field] += $answer[$field];
		}
	}
	print_r($a2);

	$body = '';
	$body = $body.'<p>'.$msg.'</p>';

	$page = new My_HTML();
	$page->setTitle('データベースアクセス');
	$page->setBody( $body );
	$page->display();
?>
