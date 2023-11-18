@foreach (['danger', 'success',] as $alertType)
    @if(Session::has('alert-' . $alertType))
        <p class="alert alert-{{ $alertType }}">{{ Session::get('alert-' . $alertType) }}</p>
    @endif
@endforeach

@foreach($errors->all() as $error)
    <p class="alert alert-danger">{{ $error }}</p>
@endforeach
