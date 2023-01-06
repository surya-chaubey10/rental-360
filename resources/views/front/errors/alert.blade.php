@if ($errors->any())
    <div class="alert alert-danger alert-dismissible">
         @foreach ($errors->all() as $error)
            {!! $error !!}
        @endforeach
    </div>
@endif


@if(session('success') or session('status'))
    <div class="alert alert-success alert-dismissible">
        {!! session("success") ?? session('status') !!}
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger alert-dismissible">
         {!! session("error") !!}
    </div>
@endif
