@inject('translator', 'App\Providers\TranslationProvider')
<li>
    <figure class="dish-entry">
        <div class="dish-img" style="background-image: url({{$item->image}});"></div>
    </figure>
    <div class="text">
        <span class="price">{{ $item->price }}€</span>
        <h3>{{ $item->name }}</h3>
        <p class="cat">{{ $item->description }}</p>
    </div>
</li>