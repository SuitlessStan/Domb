@extends('layouts.app')

@section('content')
<div class="task-form">
    <ul class="align-items-start" id="tasksList">
        <li>
            <div class="container align-items-start" id="add_task">
                <div class="taskInteractionContainer">
                    <button type="submit" id="showForm" data-toggle="modal" data-target="#exampleModal"><i class="fas fa-plus"></i></button>
                    <p>Create a new post</p>
                </div>
            </div>
        </li>
        <li>
            <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <div class="header-details w-100">
                                <div class="user-details">
                                    <a href="javascript:;" class="avatar">
                                        <img alt="Image placeholder" src="https://demos.creative-tim.com/argon-dashboard-pro/assets/img/theme/team-4.jpg">
                                    </a>
                                    <div class="user-name">
                                        <p>{{ date('H:i') }}</p>
                                        <p>User's name</p>
                                    </div>
                                </div>
                                <h5 class="modal-title" id="exampleModalLabel">New post</h5>
                            </div>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="closeModal">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        </div>
                        <form action="/media" method="POST">
                            <div class="modal-body">
                                @csrf
                                <textarea name="post" id="post" placeholder="Remember, be nice!"></textarea>
                            </div>
                            <div class="modal-footer">
                            <button type="submit" class="btn btn-primary" id="submitPost">Submit Post</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal" id="closeModalButton">Close</button>
                            </div>
                        </form>
                    </div>
                    </div>
                </div>
        </li>
        @if ($posts)
            @foreach ($posts as $post)
            <li>
                <div class="container mt-5 mb-5">
                    <div class="row d-flex">
                        <div class="col-md-12">
                            <div class="card" id="media-content">
                                <div class="d-flex justify-content-between p-2 px-3" style="background: #ab6450">
                                    <div class="d-flex flex-row align-items-center"> <img src="{{asset('images/giftpunditscom-1310474.jpg')}}" width="50" class="rounded-circle">
                                        <div class="d-flex flex-column ml-2"> <span class="font-weight-bold" style="color: #fff">Jeanette Sun</span></div>
                                    </div>
                                    <div class="d-flex flex-row mt-1 ellipsis"> <small class="mr-2">{{$post->created_at}}</small> <i class="fa fa-ellipsis-h"></i> </div>
                                </div>
                                <div class="p-2">
                                    <p class="text-justify" style="font-size: 20px">{{$post->body}}</p>
                                    <hr>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="d-flex flex-row icons d-flex align-items-center"> <i class="fa fa-heart ml-2"></i> <i class="fa fa-smile-o ml-2"></i> </div>
                                        <div class="d-flex flex-row muted-color"> <span class="mr-2">{{$post->comments->count()}} comments</span> </div>
                                    </div>
                                    <hr>
                                    @if($post->comments)
                                    @foreach ($post->comments as $comment )
                                    <div class="comments">
                                        <div class="d-flex flex-row mb-2"> <img src="{{asset('images/david-gonzales-2406949.jpg')}}" width="50" class="avatar">
                                            <div class="d-flex flex-column ml-2"> <span class="name">David Gonazales</span> <small class="comment-text">{{$comment->body}}</small>
                                                <div class="d-flex flex-row align-items-center status"> <small class="mr-1">Like</small> <small class="mr-1">Reply</small> <small class="mr-1">{{$comment->created_at}}</small> </div>
                                            </div>
                                        </div>
                                    @endforeach
                                    @endif
                                        <form action="{{route('addComment', ['postID' => $post->id])}}" method="POST">
                                            @csrf
                                            <div class="comment-input"> <input type="text" name="comment" class="form-control" placeholder="Write a new comment">
                                            </div>
                                        </form>
                                    </div>


                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </li>
            @endforeach
            @endif

    </ul>
</div>
@endsection
