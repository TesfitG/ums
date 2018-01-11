<?php
require_once "../../vendor/autoload.php";
use App\Core\Input;
use App\Core\Session;
use App\Core\Unique;
use App\Core\Redirect;
use App\Core\Validation;
session_start();
//print_r($_POST);exit();

echo '<script language="javascript">';
			echo 'window.alert("welcome alert");';
			echo '</script>';}
if($_SERVER['REQUEST_METHOD'] == 'POST'){
	echo '<script language="javascript">';
			echo 'window.alert("it is ofcourse post");';
			echo '</script>';}
    if (Input::exists('post')){
        if (Validation::valid(Input::get('email')) && Validation::valid(Input::get('password'))){
			echo '<script language="javascript">';
			echo 'window.alert("valid input");';
			echo '</script>';}
            if (Validation::emailValidation(Input::get('email'))){
                if (!Unique::checkUser(Input::get('email'))){
                    $userData = Unique::getUserData();
                    if (Input::get('email') === $userData->email && hash('sha256', Input::get('password')) === $userData->password){
                        Session::put('user', $userData->id);
						echo '<script language="javascript">';
						echo 'window.alert("unable to redirect men");';
						echo '</script>';}

                        Redirect::to('index.php');
						
                    }else{
                        Session::put('error', 'Email or password not valid. please try again.');
                        Redirect::to('../../index.php');
                    }
                }else{
                    Session::put('error', 'Email or password not valid.');
                    Redirect::to('../../index.php');
                }
            }else{
                Session::put('error', 'Email not valid !');
                Redirect::to('../../index.php');
            }
        }else{
            Session::put('error', 'Invalid input !');
            Redirect::to('../../index.php');
        }
    }else{
        Session::put('error', 'Email or Password not be empty!');
        Redirect::to('../../index.php');
    }
}else{
    Redirect::to('../../index.php');
				echo '<script language="javascript">';
			echo 'window.alert("redirecting to main index.php");';
			echo '</script>';}

}
