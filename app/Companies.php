<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Companies extends Model
{
    protected $fillable = ['application_url', 'name', "email", "phone", "address", "send_address", "google_coordinates", "link_facebook", "link_instagram", "link_twitter", "link_google", "link_linkdin", "link_youtube", "facebook_feed"];

    public function isEmpty()
    {

        return true;
    }
}
