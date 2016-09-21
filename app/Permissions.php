<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Permissions extends Model {

	public function roles() {
	    return $this->belongsToMany(Roles::class);
    }

}
