<?php

namespace Chatter\Middleware;

class Logging {
	// Write middleware, then wire it.
	// The __invoke function says: here's what happens.
	// Most middleware will use this function and takes
	// these 3 parameters.
	// When middleware is called, it is passed in to a chain.
	// Each link of the chain gets these 3 arguments.
	// The $next var, specifies where to go next.

	public function __invoke($request, $response, $next) {
		// getMethod, gets the actual http method sent. This is what 
		// we want to happen.

		error_log($request->getMethod() . '--' . $request->getUri());

		// $next is a variable function and is determined on the fly.
		$response = $next($request, $response);
		return $response; // This is all we need for a simple middleware.
	}
}

/*
API keys
do not use it in the url, as this is logged by servers, routers, etc. and is less secure because of that.

use in headers instead as bearer token.

PHP FIG, PSR-15 Middleware Defines:
(By using these definitions, you will be able to use your middleware with other frameworks)
MiddlewareInterface (overall how all middleware should be defined)
ClientMiddelwareInterface (how middleware should be used on the client)
ServerMIddlewareInterface (how middleware should be used for server to server )
FrameInterface
StackInterface
*/
