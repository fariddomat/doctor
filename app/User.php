<?php
namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Permission\Models\Role;
class User extends Authenticatable
{
    use HasRoles;
    use Notifiable;
 /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'status', 'mobile'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getNameAttribute($value)
    {
        return ucfirst($value);
    }

    public function scopeWhereRole($query,$role_name)
    {
        return $query->whereHas('roles',function($q) use ($role_name){
            return $q->whereIn('name', (array)$role_name)
                    ->orWhereIn('id',(array)$role_name);
        });
    }
    public function scopeWhereRoleNot($query,$role_name)
    {
        return $query->whereHas('roles',function($q) use ($role_name){
            return $q->whereNotIn('name', (array)$role_name)
                    ->WhereNotIn('id',(array)$role_name);
        });
    }
    public function scopeWhenSearch($query,$search)
    {
        return $query->when($search,function($q) use ($search){
            return $q->where('name','like',"%$search%" );
        });
    }

    public function scopeWhenRole($query,$role_id)
    {
        return $query->when($role_id,function($q) use ($role_id){
            return $this->scopeWhereRole($q,$role_id);
        });
    }

    // relations

    // public function appointments()
    // {
    //     return $this->hasMany(Appointment::class);
    // }

    public function doctor()
    {
        return $this->hasOne(Doctor::class);
    }
    public function patient()
    {
        return $this->hasOne(Patient::class);
    }

}
