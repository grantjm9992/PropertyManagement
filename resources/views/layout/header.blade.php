@inject('translator', 'App\Providers\TranslationProvider')
<!--Navbar -->
<header class="header-section pl-4 {{ $headerClass }}" id="navbar">
	<a href="{{ url('/') }}" class="site-logo">
		<img src="{{ $logo }}" alt="">
  </a>
  <!--
  <div class="drop-drop">
    <div class="drop-tag" toggle="languages">
      <i class="fas fa-language"></i>
    </div>
    <div class="drop-section" toggleAtt="languages">
      <div>English</div>
      <div>Spanish</div>
    </div>
  </div>
  -->
	<div class="nav-switch">
		<i class="fa fa-bars"></i>
	</div>
	<nav class="main-menu">
		<ul>
      <li>
        <a href="{{ url('/') }}">Home</a>
      </li>
      @foreach ( $pages as $page )
      <li>
        <a href="{{ $page->url }}">{{ $page->menu_title }}</a>
      </li>
      @endforeach
      <!--
			<li>
        <a href="Resort">{{ $translator->get('lbl_resort') }}</a>
      </li>
			<li>
        <a href="Properties">{{ $translator->get('lbl_properties') }}</a>
      </li>
			<li>
        <a href="Location">{{ $translator->get('lbl_location') }}</a>
      </li>
      <li>
        <a href="{{ url('HelpToBuy') }}">Help to buy</a>
      </li>
      <li>
        <a href="{{ url('Gallery') }}">Gallery</a>
      </li>
			<li>
        <a href="Contact">{{ $translator->get('lbl_contact') }}</a>
      </li>
      -->
		</ul>
	</nav>
</header>
<!--
-->
<!--/.Navbar -->
@if ( $headerClass == "" )
<script>
$(document).ready( function() {  
	var navbar = document.getElementById("navbar");
	var sticky = navbar.offsetTop;
	function myFunction() {
	  if (window.pageYOffset >= 90) {
		navbar.classList.add("default-color")
	  } else {
		navbar.classList.remove("default-color");
	  }
	}
	window.onscroll = function() {myFunction()};
})
@endif
</script>