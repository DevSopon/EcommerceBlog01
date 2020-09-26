@extends ('layouts.admin')
@section('title') Author Posts  @endsection
@section('content')

    <div class="content">
        <div class="card">
            <div class="card-header bg-light"> Author Posts </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Created_at</th>
                            <th>Updated_at</th>
                            <th>Comments</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach (Auth::user()->posts as $post)
                            <tr>
                                <td>{{$post->id}}</td>
                                <td class="text-nowrap"> <a href="{{route('singlePost', $post->id)}}"> {{$post->title}}</a></td>
                                <td>{{\Carbon\Carbon::parse($post->created_at)->diffForHumans()}}</td>
                                <td>{{\Carbon\Carbon::parse($post->updated_at)->diffForHumans()}}}</td>
                                <td>{{$post->comment->count()}}</td>
                                <td>
                                    <a href="{{route('postEdit', $post->id)}}" class="btn btn-warning"><i class="icon icon-pencil"></i> </a>
                                    <form style="display: none;" method="Post" id="postDelete--{{$post->id}}" action="{{route ('postDelete', $post->id)}}"> @csrf</form>
                                    <button href="#" class="btn btn-danger" onclick="document.getElementById('postDelete--{{$post->id}}').submit()">X</button>
                                </td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection
