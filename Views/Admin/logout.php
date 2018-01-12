<?php
require_once "../../vendor/autoload.php";
use App\ Core\ Session;
use App\ Core\ Redirect;
session_start();

// Deleting student registration No of 'student info page'.
if ( Session::exists( 'regNo' ) ) {
	Session::delete( 'regNo' );
}

// Deleting teachers id of 'Course Assign to teacher' page.
if ( Session::exists( 'teacher' ) ) {
	Session::delete( 'teacher' );
}

if ( Session::exists( 'user' ) ) {
	Session::delete( 'user' );

	if ( isset( $_SESSION[ 'link' ] ) ) {
		$uuu = $_SESSION[ 'link' ];
	} else {
		$uuu = 'astu';
	}
	Redirect::to( '../../index.php?univ=' . $uuu );

} else {
	Redirect::to( '../../index.php' );
}