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
        $where = self::makeWhere();
        if ( $user->role == "PO" )
        {
            $users = self::whereRaw("id IN (SELECT id_assigned_to FROM properties WHERE id_property_owner = $user->id ) $where ")->get();
        }
        if ( $user->role == "M" || $user->role == "AA" )
        {
            $users = self::whereRaw("id IN (SELECT id_property_owner FROM properties WHERE id_assigned_to = $user->id ) OR id_company = $user->id_company AND $where ")->get();
        }
        if ( $user->role == "WA" || $user->role = "SA" )
        {
            $users = self::whereRaw("  $where ")->get();
        }

        return $users;
    }

    static function makeWhere()
    {
        $where = " 1 ";

        if ( isset( $_REQUEST["name"] ) && $_REQUEST["name"] != "" ) $where .= " AND ( name LIKE '%".$_REQUEST["name"]."%' OR surname LIKE '%".$_REQUEST["name"]."%' OR CONCAT(name, ' ', surname) LIKE '%".$_REQUEST["name"]."%' ) ";
        if ( isset( $_REQUEST["email"] ) && $_REQUEST["email"] != "" ) $where .= " AND email LIKE '%".$_REQUEST["email"]."%' ";
        if ( isset( $_REQUEST["phone"] ) && $_REQUEST["phone"] != "" ) $where .= " AND phone LIKE '%".$_REQUEST["phone"]."%' ";
        if ( isset( $_REQUEST["role"] ) && $_REQUEST["role"] != "" ) $where .= " AND role = '".$_REQUEST["role"]."' ";

        return $where;
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
