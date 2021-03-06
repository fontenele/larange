<?php namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract {

	use Authenticatable, CanResetPassword;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['name', 'email', 'password', 'avatar'];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = ['password', 'remember_token'];

    public function roles() {
        return $this->belongsToMany(Roles::class);
    }

    public function hasAnyRole($roles) {
        if(is_array($roles)) {
            foreach ($roles as $role) {
                if($this->hasRole($role)) {
                    return true;
                }
            }
        } else {
            if($this->hasRole($roles)) {
                return true;
            }
        }
        return false;
    }

    public function hasRole($role) {
        if($this->roles()->where('name', $role)->first()) {
            return true;
        }
        
        return false;
    }

    public function assign($role) {
        if(is_string($role)) {
            return $this->roles()->save(Roles::whereName($role)->firstOrFail());
        }
        return $this->roles()->save($role);
    }

    public function hasPermission($permission) {
        if(\Session::get('user-p')->contains($permission)) {
            return true;
        }
        return false;
    }

    public function permissions() {
        $permissions = collect();
        foreach($this->roles()->get() as $role) {
            foreach($role->permissions()->get() as $permission) {
                $permissions->push($permission->name);
            }
        }
        return $permissions;
    }

}
