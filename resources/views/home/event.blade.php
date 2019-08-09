@inject('translator', 'App\Providers\TranslationProvider')
<article class="article-entry">
	<div data-id="{{ $event->id }}" class="blog-img" style="background-image: url({{ $event->image }});"></div>
	<div class="desc">
		<p class="meta"><span class="day">{{ $event->date->format('d') }}</span><span class="month">{{ $event->date->format('F') }}</span></p>
		<h2>{{ $event->str_title }}</h2>
		<p>{{ $event->str_description }}</p>
	</div>
</article>