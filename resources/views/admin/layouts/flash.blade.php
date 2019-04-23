@foreach (['success','error','danger'] as $msg)
    @if (session()->has($msg))
        <div class="alert alert-{{$msg}}">
            {{session()->get($msg)}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
@endforeach