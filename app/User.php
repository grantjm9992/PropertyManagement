<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = "users";
    
    protected $fillable = ["name", "surname", "user", "role", "id_company", "email", "phone", "id_area"];

    public static function boot()
    {
        parent::boot();
    }
    
    public function getCompanySkin()
    {
        $skin = \App\Skins::where('id_company', $this->id_company)->first();
        if ( !is_object( $skin ) ) $skin = \App\Skins::create(array("id_company" => $this->id_company ) );
        return $skin;
    }

    public function setFullnameAttribute()
    {
        $this->attributes['fullname'] = $this->name." ".$this->surname;
    }

    public function getCompanyAttribute()
    {
    }

    public function getPermissionArray()
    {
        $arr = array();

        $permissions = PermissionsRoles::where('code_role', $this->role)->get();
        foreach ( $permissions as $row )
        {
            $arr[] = $row->id_permission;
        }

        return $arr;
    }
}
