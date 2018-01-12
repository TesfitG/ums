<?php
require_once "../../vendor/autoload.php";
use App\ Core\ Input;
use App\ Core\ Session;
use App\ Core\ Unique;
use App\ Core\ Redirect;
use App\ Core\ Validation;
session_start();
//print_r($_POST);exit();

error_reporting( E_ALL );
ini_set( 'display_errors', '1' );



if ( $_SERVER[ 'REQUEST_METHOD' ] == 'POST' ) {
	if ( Input::exists( 'post' ) ) {
		if ( Validation::valid( Input::get( 'email' ) ) && Validation::valid( Input::get( 'password' ) ) ) {
			if ( Validation::emailValidation( Input::get( 'email' ) ) ) {
				if ( !Unique::checkUser( Input::get( 'email' ) ) ) {
					$userData = Unique::getUserData();
					if ( Input::get( 'email' ) === $userData->email && hash( 'sha256', Input::get( 'password' ) ) === $userData->password ) {
						Session::put( 'user', $userData->id );
						echo "here1==>".$_SESSION['univ'];
						//Redirect::to( 'index.php' );

					} else {
						echo "here2==>".$_SESSION['univ'];
						Session::put( 'error', 'Email or password not valid. please try again.' );
					//	Redirect::to( '../../index.php' );
					}
				} else {
						echo "here3==>".$_SESSION['univ'];
					Session::put( 'error', 'Email or password not valid.' );
					//Redirect::to( '../../index.php' );
				}
			} else {
				Session::put( 'error', 'Email not valid !' );
				//Redirect::to( '../../index.php' );

			}
		} else {

			Session::put( 'error', 'Invalid input !' );

			Redirect::to( '../../index.php' );

		}
	} else {

		Session::put( 'error', 'Email or Password not be empty!' );
		Redirect::to( '../../index.php' );

	}
} else {
		//echo "here6";
Redirect::to( '../../index.php' );

}