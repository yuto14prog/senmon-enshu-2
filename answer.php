<?php
	$body = '';

	// foreach($_POST as $key => $value) {
	// 	$body = $body.$key.'=>';
	// 	$body = $body.$value;
	// 	$body = $body.'<br>';
	// }

	$q1 = array();
	$q1 = [ 1 => '経済学', 2 => '経営学', 3 => '会計学',];
	$q2 = array();
	$q2 = [ 1 => '陸上', 2 => '柔道', 3 => '卓球',];
	$label = array();
	$label = [ 'q1' => '分野', 'q2' => '競技', 'shimei' => 'ID', 'password' => 'パスワード',];

	$body = $body.'<table border="2">';
		$body = $body.'<tr><td>添字</td><td>ラベル</td><td>値</td></tr>';
		foreach($_POST as $key => $value) {
			$body = $body.'<tr>';
				$body = $body.'<td>'.$key.'</td>';
				$body = $body.'<td>'.$label[$key].'</td>';
				$body = $body.'<td>';
					if ($key == 'q1') {
						$body = $body.$q1[$value];
					} else if($key=='q2') {
						$body = $body.'<table border="1">';
							$body = $body.'<tr><td>添字</td><td>値</td></tr>';
							foreach($value as $key2 => $value2){
								$body = $body.'<tr>';
									$body = $body.'<td>'.$key2.'</td>';
									$body = $body.'<td>'.$q2[$value2].'</td>';
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

	print_r($body);
	?>
