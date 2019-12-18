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

    public static function getContactsForUser($user)
    {
        if ( $user->role == "PO" )
        {
            $users = self::whereRaw("id IN (SELECT id_assigned_to FROM properties WHERE id_property_owner = $user->id ) ")->get();
        }
        if ( $user->role == "M" || $user->role == "AA" )
        {
            $user = self::whereRaw("id IN (SELECT id_property_owner FROM properties WHERE id_assigned_to = $user->id ) OR id_company = $user->id_company ")->get();
        }
        if ( $user->role == "WA" || $user->role = "SA" )
        {
            $user = self::get();
        }

        return $user;
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
