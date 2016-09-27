<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Roles extends Model {

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function permissions() {
        return $this->belongsToMany(Permissions::class);
	}

    public function assign(Permissions $permission) {
        return $this->permissions()->save($permission);
	}

    public function hasPermission($permission) {
        foreach($this->permissions()->get() as $_permission) {
            if($_permission->name == $permission) {
                return true;
            }
        }
        return false;
    }

}
