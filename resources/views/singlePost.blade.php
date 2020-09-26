@extends ('layouts.master')
@section ('content')

    <!-- Page Header -->
    <header class="masthead" style="background-image: url('{{asset ('frontend/img/post-bg.jpg')}}')">
        <div class="overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-10 mx-auto">
                    <div class="post-heading">
                        <h1>{{ $post->title }}</h1>

                        <span class="meta">Posted by
              <a href="#">{{$post->user['name']}}</a>
              on {{ date_format($post->created_at, 'F d, y')}}</span>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Post Content -->
    <article>
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-10 mx-auto">
                    {{ $post->content}}
                </div>
            </div>
            <div class="comments">
                <hr>
                <h4>Comments</h4>
                <hr>
                @foreach ($post->comment as $comment)
                    <p>{{$comment->content}}</p>
                    <p><small>by {{$post->user['name']}},  on {{ date_format($comment->created_at, 'F d, y')}}</small></p> <hr>
                @endforeach
                @if(Auth::check())
                    <form action="{{route('newComment')}}" method="post">
                        @csrf
                        <div class="form-group">
                            <textarea class="form-control" placeholder="Leave a comment here...." id="" name="comment" cols="30" rows="8"></textarea>
                            <input type="hidden" name="post" value="{{ $post->id }}">
                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary" type="submit">Make Comment</button>
                        </div>
                    </form>

                @endif
            </div>
        </div>
    </article>


@endsection
