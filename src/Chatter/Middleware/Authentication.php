<?php

namespace Chatter\Middleware;
use Chatter\Models\User;

class Authentication {
	// By default you should not implment the auth here, 
	// instead it should be used in the user class.

	public function __invoke($request, $response, $next) {
		// Getting the apikey from the header.
		$auth = $request->getHeader('Authorization');
		$_apikey = $auth[0];
		// This is looking for Bearer _space_ token.
		// We want to pull just the key and not the bearer text portion.
		$apikey = substr($_apikey, strpos($_apikey, ' ') + 1);

		$user = new User();
		if (!$user->authenticate($apikey)) {
			$response->withStatus(404);
			return $response;
		}

		$response = $next($request, $response);
		return $response;
	}
}
