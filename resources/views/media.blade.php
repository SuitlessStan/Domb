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
                                    <div comments id="comments" post-id="">
                                        <div comment class="comments d-flex justify-content-between">
                                            <div class="d-flex flex-row mb-2">
                                                <img src="{{asset('images/david-gonzales-2406949.jpg')}}" width="50" height="50" class="avatar">
                                                <div class="d-flex flex-column ml-2">
                                                    <span class="name" data-source="commentersName">User's name</span>
                                                    <small class="comment-text" data-source="commentBody"></small>
                                                    <div class="d-flex flex-row align-items-center status mb-1"> <small class="mr-2"><a href="#">Like</a></small><small class="mr-2 text-success" data-source="commentCreatedTime"></small></div>
                                                </div>
                                            </div>
                                            <div commentDropdown>
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

<div dropdown class="d-none">
    <div class="dropdown">
        <button class="text-dark" type="button" id="dropdownMenuButton" data-display="static" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-flip="false">
            <i class="fas fa-ellipsis-h"></i>
        </button>
        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
          <a class="dropdown-item" href="#">Edit</a>
          <a class="dropdown-item" href="#">Delete</a>
        </div>
      </div>
</div>
@endsection

@section('javascript')
    <script>

        getMedia();


        function getMedia(){
            $.ajax({
                    url: "/allPosts",
                    type: 'GET',
                    success: function(res) {
                        displayMedia(res);
                        log(res);

                    }
                });
        }

        var $postTemplate = $('[posts]').clone();
        var $commentTemplate = $('[comments]').clone();
        var $dropdownTemplate = $('[dropdown]').clone();


        function displayMedia(response){
           var posts = response.posts;
           $(posts).each((i,post)=>{
               var $post = $postTemplate.clone();
               $post.find('[data-source="postBody"]').html(post.body);
               $post.find('[data-source="postTimeCreated"]').html(post.created_at);
               $post.find('[data-source="commentCount"').html(post.comments.length);
               $('#comments').attr('post-id',post.id);
               $('[posts]').append($post.html());
               if (post.comments){
                   $(post.comments).each((i,comment)=>{
                       var $comment = $commentTemplate.clone();
                       var $dropdown = $dropdownTemplate.clone();
                       $comment.find('[data-source="commentBody"').html(comment.body);
                       $comment.find('[data-source="commentCreatedTime"').html(comment.created_at);
                       $comment.find('[commentDropdown]').html($dropdown.html());

                   });
               }
           });
        }




        $(document).on("submit","#addComments", (e) => {
            e.preventDefault();
            let comment = $(this).find('[name="comment"]').val();
            let _token   = $('meta[name="csrf-token"]').attr('content');
            let postID = $(this).attr('data-post-id');

            $.ajax({
                url:"comments/" + postID,
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

       function addNewComment(response,postID){
           var $comment = $commentTemplate.clone();
           $comment.find('[data-source="commentBody"]').html(response.body);
           $comment.find('[data-source="commentCreatedTime"]').html(response.created_at);
           $('[posts]').find(`[post][data-post-id="${postID}"] > [comments]`).append($comment.html());
       }

       function log(object){
           console.log(object);
       }
    </script>
@endsection
