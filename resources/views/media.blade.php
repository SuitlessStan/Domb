@extends('layouts.app')

@section('content')
<div class="task-form">
    <ul class="align-items-start" id="tasksList">
        <li>
            <div class="container align-items-start" id="add_task">
                <div class="taskInteractionContainer">
                    <button type="submit" id="postModal" data-toggle="modal" data-target="#exampleModal"><i class="fas fa-clone"></i></button>
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
                        <form id="addPost" action="/media" method="POST">
                            @csrf
                            <div class="modal-body">
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


        <li>
            <div posts>
                <div post class="container mt-5 mb-5" data-post-id="">
                    <div class="row d-flex">
                        <div class="col-md-12">
                            <div class="card" id="media-content">
                                <div class="d-flex justify-content-between p-2 px-3" style="background: #ab6450">
                                    <div class="d-flex flex-row align-items-center"> <img src="{{asset('images/giftpunditscom-1310474.jpg')}}" width="50" height="50" class="rounded-circle">
                                        <div class="d-flex flex-column ml-2"> <span class="font-weight-bold" style="color: #fff" data-source="user">User's name</span></div>
                                    </div>
                                    <div class="d-flex flex-row mt-1 ellipsis"> <small class="mr-2" data-source="postTimeCreated"></small> <i class="fa fa-ellipsis-h"></i> </div>
                                </div>
                                <div class="p-2">
                                    <p class="text-justify" style="font-size: 20px" data-source="postBody"></p>
                                    <hr>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="d-flex flex-row icons d-flex align-items-center"> <i class="fa fa-heart ml-2"></i> <i class="fa fa-smile-o ml-2"></i> </div>
                                        <div class="d-flex flex-row muted-color"> <span class="mr-2" data-source="commentCount"></span><span>comments</span></div>
                                    </div>
                                    <hr>
                                    <div comments>
                                        <div comment class="comments" data-post-id="">
                                            <div class="d-flex flex-row mb-2"> <img src="{{asset('images/david-gonzales-2406949.jpg')}}" width="50" height="50" class="avatar">
                                                <div class="d-flex flex-column ml-2">
                                                    <span class="name" data-source="commentersName">User's name</span>
                                                    <small class="comment-text" data-source="commentBody"></small>
                                                    <div class="d-flex flex-row align-items-center status mb-1"> <small class="mr-2"><a href="#">Like</a></small><small class="mr-2 text-success" data-source="commentCreatedTime"></small></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <form id="addComments" class="mb-2" data-post-id="" method="POST">
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
        <li>
            <span class="success" style="color:green; margin-top:10px; margin-bottom: 10px;"></span>
        </li>

    </ul>
</div>
@endsection

@section('javascript')
    <script>
        $.ajax(
            {
                type:"GET",
                url:"/allPosts",
                success:function(response){
                    displayMedia(response);
                }
            }
        );

        var $commentTemplate = $('[comments]').clone();
        $('[comments]').html('');

        var $postTemplate = $('[posts]').clone();
        $('[posts]').html('');

        function displayMedia(response){
            $(response.posts).each(function(){

                var $post = $postTemplate.clone();
                $post.find('[data-source="postTimeCreated"]').html(this.created_at);
                $post.find('[data-source="postBody"]').html(this.body);
                $post.find('[data-post-id]').attr('data-post-id',this.id);
                if (this.comments){
                    $.each(this.comments,function(i,val){
                        displayComments($post, val);
                    });
                }
                $('[posts]').append($post.html());
            });
        }


        function displayComments($target, val){
            var $comment = $commentTemplate.clone();
            $comment.find('[data-source="commentBody"]').html(val.body);
            $comment.find('[data-source="commentCreatedTime"]').html(moment().startOf('second').fromNow());
            $target.find('[comments]').append($comment.html());
        }

        $(document).on("submit","#addComments", function (e){
            e.preventDefault();

            let comment = $("input[name=comment]").val();
            let _token   = $('meta[name="csrf-token"]').attr('content');
            let postID = $(this).attr('data-post-id');

            $.ajax({
                url:"/comments/" + postID,
                method:"POST",
                data:{
                    comment:comment,
                    _token:_token,
                    postID:postID,
                },
                success:function(response){
                    console.log(response)
                    addNewComment(response,postID);
                    $('#addComments')[0].reset();
                    // console.log(response)
                }
            });

        });

        $(document).on("submit","#addPost",function(e){
            e.preventDefault();

            let post = $('textarea[name=post]').val();
            let _token = $('meta[name="csrf-token"]').attr('content');
            let url = $(this).attr('action');

            $.ajax({
                url:url,
                method:"POST",
                data: {
                    post:post,
                    _token:_token
                },
                success:function(response){
                    console.log(response);
                    addNewPost(response);
                }
            });

        });

        function addNewPost(response){
            var $post = $postTemplate.clone();
            $post.find('[data-source="postTimeCreated"]').html(response.post.created_at);
            $post.find('[data-source="postBody"]').html(response.post.body);
            $(['posts']).append($post.html());
            $('#closeModalButton').click();
        }

        function addNewComment(response,postID){
            var $comment = $commentTemplate.clone();
            $comment.find('[data-source="commentBody"]').html(response.comment.body);
            $comment.find('[data-source="commentCreatedTime"]').html(moment().startOf('second').fromNow());
            $comment.find('[data-post-id]').attr('data-post-id',postID);
            $('[posts]').find(`[post][data-post-id="${postID}"] > [comments]`).append($comment.html());
            console.log($comment.html())
        }
    </script>
@endsection
