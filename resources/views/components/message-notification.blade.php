@if($errors->any())
    <div class="alert alert-light text-danger small">
        @foreach($errors->all() as $error)
            {!! $error !!}<br>
        @endforeach
    </div>
@endif

@if(session('message'))
    <div class="alert alert-light text-success small">
        {!! session('message') !!}
    </div>
@endif