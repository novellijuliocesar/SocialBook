@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <!--Muestra la Publicaciones de los usuarios seguidos por el usuario identificado-->            
            @foreach ($posts as $post)

                @foreach($users as $user)
                    @if($post->user_id == $user->id)
                        @include('includes.post', ['post' => $post])
                    @endif
                @endforeach

            @endforeach

        </div>
    </div>
</div>
@endsection
