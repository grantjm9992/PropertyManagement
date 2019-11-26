@inject('translator', 'App\Providers\TranslationProvider')
<nav id="navbar" class="navbar navbar-expand-lg navbar-dark navbar-fixed  {{ $headerClass }}">
  <a class="navbar-brand" href="{{ url('') }}"><img src="{{ $logo }}" /></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent-333"
    aria-controls="navbarSupportedContent-333" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent-333">
    <ul class="navbar-nav mr-auto">
      @foreach ( $pages as $page )
      <li class="nav-item">
        <a class="nav-link" href="{{ $page->url }}">{{ $page->menu_title }}</a>
      </li>
      @endforeach
      <!--
      <li class="nav-item">
        <a class="nav-link" href="Resort">{{ $translator->get('lbl_resort') }}</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="Properties">{{ $translator->get('lbl_properties') }}</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="Location">{{ $translator->get('lbl_location') }}</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="Contact">{{ $translator->get('lbl_contact') }}</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink-333" data-toggle="dropdown"
          aria-haspopup="true" aria-expanded="false">Dropdown
        </a>
        <div class="dropdown-menu dropdown-default" aria-labelledby="navbarDropdownMenuLink-333">
          <a class="dropdown-item" href="#">Action</a>
          <a class="dropdown-item" href="#">Another action</a>
          <a class="dropdown-item" href="#">Something else here</a>
        </div>
      </li>
    -->
    </ul>
    <ul class="navbar-nav ml-auto nav-flex-icons">
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink-333" data-toggle="dropdown"
          aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-language"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-right dropdown-default"
          aria-labelledby="navbarDropdownMenuLink-333">
          <div class="dropdown-item" onclick="changeLanguage('en')">English</div>
          <div class="dropdown-item" onclick="changeLanguage('es')">Español</div>
        </div>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink-333" data-toggle="dropdown"
          aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-user"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-right dropdown-default"
          aria-labelledby="navbarDropdownMenuLink-333">
          <a class="dropdown-item" href="#">My Account</a>
          <a class="dropdown-item" href="#">Something</a>
          <a class="dropdown-item" href="#">Something</a>
        </div>
      </li>
    </ul>
  </div>
</nav>