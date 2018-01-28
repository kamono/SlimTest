<?php

//include 'vendor/autoload.php';
include 'bootstrap.php';
use Chatter\Models\Message as Message;
use Chatter\Middleware\Logging as ChatterLogging;
use Chatter\Middleware\Authentication as ChatterAuth;

$configuration = [
    'settings' => [
        'displayErrorDetails' => true,
    ],
];

//$c = new \Slim\Container($configuration);
//$app = new \Slim\App($c);
//$app->add(new ChatterAuth());
//$app->add(new ChatterLogging()); // Here, we wire our middleware.

$app = new \Slim\App();

$app->get('/', function($request, $response, $args) {
	return $response->getBody()->write("Hello, nate!");
});

$app->get('/messages', function($request, $response, $args) {
	$_message = new Message();
	$messages = $_message->all();

	$payload = [];
	foreach ($messages as $_msg) {
		$payload[$_msg->id] = ['body' => $_msg->body,
								'user_id' => $_msg->user_id,
								'created_at' => $_msg->created_at
							];
	}

	return $response->withStatus(200)->withJson($payload);
});

$app->run();


