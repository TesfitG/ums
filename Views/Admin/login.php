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

if ( isset( $_SESSION[ 'reload' ] ) )
	$_SESSION[ 'reload' ] = 'No'
else
	$_SESSION[ 'reload' ] = 'Yes';

if ( $_SESSION[ 'reload' ] == 'Yes' && isset( $_GET[ 'univ' ] ) )
	$initial_univ = $_GET[ 'univ' ];
else if ($_SESSION[ 'reload' ] == 'Yes' && !isset( $_GET[ 'univ' ] ))
	$initial_univ = "";

if ( $_SERVER[ 'REQUEST_METHOD' ] == 'POST' ) {
	if ( Input::exists( 'post' ) ) {
		if ( Validation::valid( Input::get( 'email' ) ) && Validation::valid( Input::get( 'password' ) ) ) {
			if ( Validation::emailValidation( Input::get( 'email' ) ) ) {
				if ( !Unique::checkUser( Input::get( 'email' ) ) ) {
					$userData = Unique::getUserData();
					if ( Input::get( 'email' ) === $userData->email && hash( 'sha256', Input::get( 'password' ) ) === $userData->password ) {
						Session::put( 'user', $userData->id );
							Redirect::to( 'index.php');

					} else {

						Session::put( 'error', 'Email or password not valid. please try again.' );
						if ( !$initial_univ == "" )
							Redirect::to( '../../index.php?univ=' . $initial_univ );
						else
							Redirect::to( '../../index.php);
					}
				} else {
					Session::put( 'error', 'Email or password not valid.' );
					if ( !$initial_univ == "" )
						Redirect::to( '../../index.php?univ=' . $initial_univ );
					else
						Redirect::to( '../../index.php);
				}
			} else {
				Session::put( 'error', 'Email not valid !' );
				if ( !$initial_univ == "" )
					Redirect::to( '../../index.php?univ=' . $initial_univ );
				else
					Redirect::to( '../../index.php);

			}
		} else {

			Session::put( 'error', 'Invalid input !' );

			if ( !$initial_univ == "" )
				Redirect::to( '../../index.php?univ=' . $initial_univ );
			else
				Redirect::to( '../../index.php);

		}
	} else {


		Session::put( 'error', 'Email or Password not be empty!' );
		if ( !$initial_univ == "" )
			Redirect::to( '../../index.php?univ=' . $initial_univ );
		else
			Redirect::to( '../../index.php);


	}
} else {

	if ( !$initial_univ == "" )
		Redirect::to( '../../index.php?univ=' . $initial_univ );
			else
							Redirect::to( '../../index.php);

}