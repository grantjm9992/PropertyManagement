@inject('translator', 'App\Providers\TranslationProvider')
<div role="tabpanel" class="tab-pane {{ $active }}" id="{{ $cat->hashid }}">
    <div class="row">
        <div class="col-12 col-md-6">
            <ul class="menu-dish">
                {!! $left !!}
            </ul>
        </div>
        <div class="col-12 col-md-6">
            <ul class="menu-dish">
                {!! $right !!}
            </ul>
        </div>
    </div>
</div>
