@if(count($errors) > 0)
    @foreach($errors->all() as $error)
        <p class="alert alert-danger mt-3">{{ $error }}</p>
    @endforeach
@endif
