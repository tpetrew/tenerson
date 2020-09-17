<?php
session_start();

if(empty($_SESSION['person_array'])) {
	$_SESSION['person_array'] = array();
}

use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use Slim\App;

require '../vendor/autoload.php';

$settings = [
    'addContentLengthHeader' => false,
];

$app = new App(['settings' => $settings]);
$app->post('/new', function (ServerRequestInterface $request, ResponseInterface $response, array $args) {

    if($_POST['name']!='') {

    	$username = $_POST['name'];
		$person_array = $_SESSION['person_array'];

    	for($i=0; $i<count($person_array); $i++) {

    	 	if($person_array[$i]['username']==$username){

    	 		$message = true;

    	 	}
    	}


    	if($message!=true) {

	    	$get_profile_url = "https://instalkr.com/api/getprofile/".$username;

	    	$curl_handle=curl_init();
			curl_setopt($curl_handle, CURLOPT_URL, $get_profile_url);
			curl_setopt($curl_handle, CURLOPT_CONNECTTIMEOUT, 2);
			curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($curl_handle, CURLOPT_USERAGENT, '');
			$response = curl_exec($curl_handle);
			curl_close($curl_handle);

			$response = json_decode($response, true);

			if($response['code'] == 404){

		    	echo "[response: 'Нет пользователя либо акк закрыт']";

			} else {

				$person_array = array();
			    $person_array = $_SESSION['person_array'];
				$data['username'] = $response['username'];
				$data['userpic']  = $response['userpic'];
				

			    if(isset($person_array[9])) {

			    	array_shift($person_array);
			    	array_push($person_array, $data);

			    } else array_push($person_array, $data);

			    $person_array = array_reverse($person_array);
			    $_SESSION['person_array'] = $person_array;

			}

		} else echo "[response: 'Такой профиль уже есть']";

	} else echo "[response: 'Заполните поле']";

    
});

$app->get('/getprofiles', function (ServerRequestInterface $request, ResponseInterface $response, array $args) {

	$posts_array = array();
    $person_array = $_SESSION['person_array'];

    for($i=0; $i<count($person_array); $i++) {

    	$username = $person_array[$i]['username'];

    	$get_posts_url = "https://instalkr.com/api/getposts/".$username;

		$curl_handle=curl_init();
		curl_setopt($curl_handle, CURLOPT_URL, $get_posts_url);
		curl_setopt($curl_handle, CURLOPT_CONNECTTIMEOUT, 2);
		curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curl_handle, CURLOPT_USERAGENT, '');
		$response_posts = curl_exec($curl_handle);
		curl_close($curl_handle);

		$response_posts = json_decode($response_posts, true);

		$data['username']         = $person_array[$i]['username'];
		$data['userpic']          = $person_array[$i]['userpic'];
		$data['description']      = $response_posts[0]['description'];
		$data['location_name']    = $response_posts[0]['location_name'];
		$data['preview_standart'] = $response_posts[0]['preview_standart'];
		$data['type']             = $response_posts[0]['type'];
		$data['src']             = $response_posts[0]['src'];
		$data['created_at']       = date("F j, Y, g:i a",$response_posts[0]['created_at']/1000);

		array_push($posts_array, $data);

	}

    if(count($posts_array)==0) {
    	echo "[response: 'Добавьте профиль']";
    } else { 
    	echo json_encode($posts_array);
    }
    
});

$app->get('/delete', function (ServerRequestInterface $request, ResponseInterface $response, array $args) {

	$delete_id = $_GET['delete_id'];
	$person_array = array();
	$person_array = $_SESSION['person_array'];
	unset($person_array[$delete_id]);
	$_SESSION['person_array'] = $person_array;

});


$app->run();
