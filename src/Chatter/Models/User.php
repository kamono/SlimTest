<?php

namespace Chatter\Models;

use Illuminate\Database\Eloquent\Model as Model;

class User extends Model {

	public function authenticate($apikey) {
		// We ask for an array of items, an take the 1st item.
		$user = User::where('apikey', '=', $apikey)->take(1)->get();
		// Capture user for later processing. Here, we take 
		// the 1st item.
		$this->details = $user[0];
		// Now we check if the user exists in the database.
		return ($user[0]->exists) ? true : false;
	}
}