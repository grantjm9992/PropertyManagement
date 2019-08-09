@inject('translator', 'App\Providers\TranslationProvider')
<nav class="navbar navbar-expand-lg">
  <a class="navbar-brand" href="{{ url('') }}">
	  <img style="margin-left: 20px; height: 82px;" src="{{ asset('img/logo.png') }}" alt="">
  </a><!--
  <a class="navbar-brand white" href="{{ url('') }}">
	  <img style="margin-left: 20px; height: 82px;" src="{{ asset('img/logo_white.png') }}" alt="">
  </a>-->
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <i style="font-size: 24px;" class="fas fa-chevron-circle-down"></i>
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto" style="margin: auto;">
      <!--<li class="nav-item active">
        <a class="nav-link" href="{{ url('') }}">Nueva Ribera Beach Club<span class="sr-only">(current)</span></a>
      </li>-->
      <li class="nav-item">
        <a class="nav-link" href="Properties">Buying Guide</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="Resort">Resort</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="Location">Location</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="Availability" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Properties
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          @foreach ( $properties as $property )
            <a href="Apartment?ref={{ $property->code }}" class="dropdown-item">{{ $property->phase }}</a>
          @endforeach
        </div>
      </li>
      <li class="nav-item">
        <div onclick="register()" class="nav-link">Register</div>
      </li>
      <li class="nav-item">
        <a href="Contact" class="nav-link">Contact Us</a>
      </li>
      <!--
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Services
        </a>
        <div class="dropdown-menu dropdown-menu-right text-right" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="#">Costa Calida Viewing Trips</a>
          <a class="dropdown-item" href="#">Costa Blanca Viewing Trips</a>
          <a class="dropdown-item" href="#">Spanish Mortgages</a>
        </div>
      </li>-->
    </ul>
  </div>
	
</nav>