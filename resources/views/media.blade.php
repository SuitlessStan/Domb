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
                        <div class="modal-body">

                        </div>
                        <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal" id="closeModalButton">Close</button>
                        </div>
                    </div>
                    </div>
                </div>
        </li>
    </ul>
</div>
@endsection
