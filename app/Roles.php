<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Roles extends Model {

    public function permissions() {
        return $this->belongsToMany(Permissions::class);
	}

    public function assign(Permissions $permission) {
        $this->permissions()->save($permission);
	}

}
