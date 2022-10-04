<?php
	include_once  'My_HTML.php';

	session_start();

//	print_r ( $_POST );
//	print_r ( '<br>' );
//	print_r ( $_SESSION );

	$page = new My_HTML();

	if ( isset( $_POST['page'] )  ) {
		if ( $_POST['page'] == '回答' ) {
			$_SESSION = $_POST;
			$page->setTitle( '確認' );
			$body = $page->confirmPage();
			$page->setBody( $body );
		} else if ( $_POST['page'] == '修正' ) {
			$page->setTitle( '修正' );
			$body = $page->modifyPage();
			$page->setBody( $body );
		} else if ( $_POST['page'] == '確認' ) {
			$_SESSION = $_POST;
			$page->setTitle( '確認' );
			$body = $page->confirmPage();
			$page->setBody( $body );
		} else if ( $_POST['page'] == '確定' ) {
			$page->setTitle( '確定' );
			$body = $page->endPage();
			$page->setBody( $body );
			$_SESSION = array();
			setcookie( "PHPSESSID", '', time()-1800, '/' );
			session_destroy();
		} else {
			// 追記しました
			$page->setTitle( 'エラー' );
			$body = '<p>原因不明のエラーが発生しました．</p>';
			$page->setBody( $body );
			$_SESSION = array();
			setcookie( "PHPSESSID", '', time()-1800, '/' );
			session_destroy();
		}
	} else {
		$page->setTitle( '入力' );
		$body = $page->inputPage();
		$page->setBody( $body );
	}
	$page->display();
?>
