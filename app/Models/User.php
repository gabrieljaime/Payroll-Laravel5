<?php namespace App\Models;

use App\Logic\User\CaptureIp;
use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Database\Eloquent\Model;

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
    protected $fillable = ['employee_id','name', 'email', 'password'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    // REGISTRATION VALIDATION RULES
    public static $rules = [
        'name'                  => 'required',
        'email'                 => 'required|email|unique:users',
        'password'              => 'required|min:6|max:20',
        'password_confirmation' => 'required|same:password'
    ];


    // ACCOUNT EMAIL ACTIVATION
    public function accountIsActive($code)
    {

        // CHECK IF ACTIVATION CODE MATCHES THE ONE WE SENT
        $user = User::where('activation_code', '=', $code)->first();

        // GET IP ADDRESS
        $userIpAddress = new CaptureIp;
        $user->signup_confirmation_ip_address = $userIpAddress->getClientIp();

        // SET THE USER TO ACTIVE
        $user->active = 1;

        // CLEAR THE ACTIVATION CODE
        $user->activation_code = '';

        // SAVE THE USER
        if ($user->save())
        {
            \Auth::login($user);
        }

        return true;
    }

    //Empleado
    public function Empleado()
    {

        return $this->belongsTo('App\Models\Employees', 'employees_id');
    }
    // USER ROLES
    public function roles()
    {
        return $this->belongsToMany('App\Models\Role')->withTimestamps();
    }


    public function hasRole($name)
    {
        foreach ($this->roles as $role)
        {
            if ($role->name == $name) return true;
        }

        return false;
    }

    public function assignRole($role)
    {
        return $this->roles()->attach($role);
    }

    public function removeRole($role)
    {
        return $this->roles()->detach($role);
    }

    // USER PROFILES
    public function profile()
    {
        return $this->hasOne('App\Models\Profile');
    }

    public function profiles()
    {
        return $this->belongsToMany('App\Models\Profile')->withTimestamps();
    }

    public function hasProfile($name)
    {
        foreach ($this->profiles as $profile)
        {
            if ($profile->name == $name) return true;
        }

        return false;
    }

    public function assignProfile($profile)
    {
        return $this->profiles()->attach($profile);
    }

    public function removeProfile($profile)
    {
        return $this->profiles()->detach($profile);
    }

    // SOCIAL MEDIA AUTH
    public function social()
    {
        return $this->hasMany('App\Models\Social');
    }
}