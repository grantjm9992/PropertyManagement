@inject('translator', 'App\Providers\TranslationProvider')
<div class="task">
    <div class="row">
        <div class="col-12">
            {{ $task->title }}
        </div>
        <div class="col-12 col-lg-4">
            <i class="fas fa-clock green"></i>
            {{ $task->date_start }}
        </div>
        <div class="col-12 col-lg-4">
            <i class="fas fa-clock red"></i>
            {{ $task->date_end }}        
        </div>
        <div class="col-12 col-lg-4">
            @if ( (int)$task->status === 1 )
                <i title="{{ $translator->get('pending') }}" class="fas fa-times-circle red"></i>
            @elseif ( (int)$task->status === 2 )
                <i title="{{ $translator->get('in_progress') }}" class="fas fa-hourglass-half orange"></i>
            @else ( (int)$task->status === 3 )
                <i title="{{ $translator->get('completed') }}" class="fas fa-check-circle green"></i>
            @endif
        </div>
    </div>
</div>