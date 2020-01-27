<?php

namespace App\Classes;

class AppConfig
{
    const id_company = -1;
    const is_project = 1;

    const pages = array(
        "Resort" => array(
            "order"=> 2,
            "editable" => 0,
            "include_menu" => 1,
            "active" => 1,
            "include_slider" => 0
        ),
        "Properties" => array(
            "order" => 3,
            "editable" => 1,
            "active" => 1,
            "include_slider" => 1,
            "include_menu" => 1
        ),
        "Location" => array(
            "order" => 4,
            "editable" => 1,
            "include_menu" => 1,
            "active" => 1,
            "include_slider" => 1
        ),
        "Contact" => array(
            "order" => 5,
            "editable" => 1,
            "include_menu" => 1,
            "include_slider" => 0,
            "active" => 1
        ),
        "Home" => array(
            "order" => 1,
            "editable" => 1,
            "include_menu" => 0,
            "active" => 1,
            "include_slider" => 0,
            "sections" => array(
                array(
                    "title" => "Innovative Property Rental Service",
                    "subtitle" => "My Casa Away makes it simple for property owners to advertise their property online.",
                    "description" => '<div class="medium-text text-center text-lg-left">
                    <h3 class="width100">
                    Maximise Profit Potential
                    </h3>
                    <p class="width100">
                    We provide an end to end holiday rental service for your property all year round that takes all the responsibility away from you.
                    </p>
                    <p class="width100">
                    We take photos, create perfectly worded descriptions, create and manage property listings online multiple platforms, improve search engine optimisation, reach international audiences, liaise with guests, arrange arrivals, organise property management and other property services. 
                    </p>
                    <p class="width100">
                    Get started today by applying online for an analysis of your properties profit potential.
                    </p>
                    <p class="width100">
                    We have no pushy sales representatives and are happy to answer any of your questions about renting a property in Spain.
                    </p>
                </div>',
                "image" => "img/footer.jpg",
                "order" => 1
                ),
                array(
                    "title" => "Free Property Analysis",
                    "subtitle" => "Apply Online, Fast Response Times",
                    "description" => '<div class="medium-text  text-center text-lg-left">
                    <h3 class="width100">
                    Market Research
                    </h3>
                    <p class="width100">
                    We analyse your “Competition Level” across all the major marketing platforms to forecast your monthly visitors and bookings.
                    </p>
                    <h3 class="width100">
                    International Audience
                    </h3>
                    <p class="width100">
                    Our Multilingual team advertise your property worldwide using the most successful online rental platforms on the web.
                    </p>
                    <h3 class="width100">
                    One Unified Calendar
                    </h3>
                    <p class="width100">
                    We automatically update your calendars across all your channels including Airbnb, Booking.com, TripAdvisor, Home Away and more.
                    </p>
                    <h3 class="width100">
                    Messaging Support
                    </h3>
                    <p class="width100">
                    We can boost your response rate even when your sleeping and offer unbeatable customer service catered to an international audience.
                    </p>
                    <h3 class="width100">
                    More Guest Reviews
                    </h3>
                    <p class="width100">
                    Our highly trained professionals pick up and respond to messages from the inquiry stage to asking for a guest review on your pages.
                    </p>
                    <h3 class="width100">
                    Rental Analysis
                    </h3>
                    <p class="width100">
                    Complete our online form in seconds and receive a Free Property Analysis from an online rental expert by email, telephone or Facebook messenger.
                    </p>
                </div>
            </div>',
                    "image" => 'img/team.jpg',
                    "order" => 2
                ),
                array(
                    "title" => "End to End Solution",
                    "subtitle" => "",
                    "description" => '<div class="row no-gutters">
                    <div class="col-12 col-md-6 col-lg-4 text-center text-md-center">
                        <p>
                            <div class="icon-span">
                                <i class="fas fa-globe"></i>
                            </div>
                        </p>
                        <h4>
                        Global Reach
                        </h4>
                        <p>
                        We synchronise your properties availability, rates, messages & policies between the best rental platforms such as Airbnb, Booking.com, Trip Advisor, Home Away and many other property marketing channels.
                        </p>
                    </div>
                    <div class="col-12 col-md-6 col-lg-4 text-center text-md-center">
                        <p>
                            <div class="icon-span">
                                <i class="fas fa-book"></i>
                            </div>
                        </p>
                        <h4>
                        Create your Rules & Sit Back
                        </h4>
                        <p>
                        We will send your guests scheduled information about your property weeks before they arrive, check-in instructions days before their check-in or control messages after their first-night stay to make sure they understand your rules.
                        </p>
                    </div>
                    <div class="col-12 col-md-6 col-lg-4 text-center text-md-center">
                        <p>
                            <div class="icon-span">
                                <i class="fas fa-hand-holding-usd"></i>
                            </div>
                        </p>
                        <h4>
                        Pricing Advice
                        </h4>
                        <p>
                        Our experts provide pricing advice every quarter based on changes in the property market. Our aim is to help you always set a good price for your property and attract the best customers.
                        </p>
                    </div>
                    <div class="col-12 col-md-6 col-lg-4 text-center text-md-center">
                        <p>
                            <div class="icon-span">
                                <i class="fas fa-envelope-square"></i>
                            </div>
                        </p>
                        <h4>
                        We Reply to all the Messages
                        </h4>
                        <p>
                        We answer all your properties initial inquiries and liaise with keyholders to ensure your guests arrive without a hitch. Get calendar updates to your phone, to do’s and reminders in one simple timeline managed by us!
                        </p>
                    </div>
                    <div class="col-12 col-md-6 col-lg-4 text-center text-md-center">
                        <p>
                            <div class="icon-span">
                                <i class="fas fa-calendar-alt"></i>
                            </div>
                        </p>
                        <h4>
                        Professional Reservations & Bookings Policies
                        </h4>
                        <p>
                        A smooth booking operation requires an airtight reservation & bookings policy that protects your investment. We will help configure your reservation process on each new marketing channel so every new booking works in your favour.
                        </p>
                    </div>
                    <div class="col-12 col-md-6 col-lg-4 text-center text-md-center">
                        <p>
                            <div class="icon-span">
                                <i class="fas fa-chart-area"></i>
                            </div>
                        </p>
                        <h4>
                        Monthly Financial Reports
                        </h4>
                        <p>
                        Get a detailed report including price breakdowns from your bookings. Know exactly how much money you have made across each property channel at a glance.
                        </p>
                    </div>
        </div>',
                    "image" => '',
                    "order" => 3
                )
            )
        )
    );
    
    public function __construct()
    {
        
    }

    public static function canView($type, $element)
    {
        switch( $type )
        {
            case "TASK":
                return self::canViewTask( $element );
                break;
                case "RENTAL":
                    return self::canViewRental( $element );
                    break;
                    case "PROPERTY":
                        return self::canViewProperty( $element );
                        break;
                        case "USER":
                            return self::canViewUser( $element );
                            break;
                            case "NOTIFICATION":
                                return self::canViewNotification( $element );
                                break;
        }
    }

    public static function canViewTask( $task )
    {
        $response = false;
        $user = \UserLogic::getUser();
        if ( $user->role == "SA" ) $response = true;
        if ( (int)$task->id_company === (int)$user->id_company && $user->role == "AA"  ) $response = true;
        if ( (int)$task->id_created_by === (int)$user->id ) $response = true;
        if ( (int)$task->id_user === (int)$user->id ) $response = true;
        if ( (int)$task->id_property != "" )
        {
            $property = \App\Properties::where( "id", $task->id_property )->first();
            if ( is_object( $property ) )
            {
                if ( (int)$property->id_property_owner === (int)$user->id ) $response = true;
            }
        }
        return $response;
    }

    public static function canEdit($type, $element)
    {
        switch( $type )
        {
            case "TASK":
                return self::canEditTask( $element );
                break;
                case "RENTAL":
                    return self::canEditRental( $element );
                    break;
                    case "PROPERTY":
                        return self::canEditProperty( $element );
                        break;
                        case "USER":
                            return self::canEditUser( $element );
                            break;
                            case "NOTIFICATION":
                                return self::canEditNotification( $element );
                                break;
        }
    }

    public static function canEditTask( $task )
    {
        $response = false;
        $user = \UserLogic::getUser();
        if ( $user->role == "SA" ) $response = true;
        if ( (int)$task->id_created_by === (int)$user->id ) $response = true;
        if ( (int)$task->id_user === (int)$user->id ) $response = true;

        return $response;
    }

    public static function companyCreate( $company = null )
    {
        if ( $company === null ) $company = \App\Companies::create();

        // CREATE ALL PAGES
        foreach ( self::pages as $name => $page )
        {
            $p = new \App\Pages();
            $p->id_company = $company->id;
            $p->active = $page["active"];
            $p->include_menu = $page["include_menu"];
            $p->include_slider = $page["include_slider"];
            $p->order = $page["order"];
            $p->editable = $page["editable"];
            $p->url = $name;
            $p->menu_title = $name;
            $p->save();
            if ( array_key_exists("sections", $page) )
            {
                // CREATE SECTIONS FOR EACH PAGE
                foreach ( $page["sections"] as $section )
                {
                    $sec = new \App\Sections();
                    $sec->title = $section["title"];
                    $sec->subtitle = $section["subtitle"];
                    $sec->order = $section["order"];
                    $sec->image = $section["image"];
                    $sec->description = $section["description"];
                    $sec->id_company = $company->id;
                    $sec->id_page = $p->id;
                    $sec->save();
                }
            }
        }

        // CREATE SKIN
        $skin = new \App\Skins();
        $skin->id_company = $company->id;
        $skin->c1 = "#222";
        $skin->c2 = "#222";
        $skin->c3 = "#f57e20";
        $skin->c4 = "#680cfa";
        $skin->t1 = "#fff";
        $skin->t2 = "#fff";
        $skin->t3 = "#fff";
        $skin->t4 = "#fff";
        $skin->logo = "img/logo_colour.png";

        return true;
    }

}
