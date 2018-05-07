@extends('layouts.master')

@section('content')

    <div class="container dashboard">
        <div class="row" id="items-list">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-info">
                    <div class="panel-heading">Roles</div>
                    <div class="panel-body">
                        <table class="table roles-table table-striped table-hover">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Created</th>
                                <th>Updated</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @if($roles)
                                @foreach($roles as $x)
                                    <tr>
                                        <td>{{$x->id}}</td>
                                        <td>{{$x->name}}</td>
                                        <td>{{$x->description}}</td>
                                        <td>{{$x->created_at->diffForHumans()}}</td>
                                        <td>{{$x->updated_at->diffForHumans()}}</td>
                                        <td>
                                            <button type='button' class='btn btn-primary btn-circle' id='btnEditRole' data-toggle="modal" data-target="#RoleModalCenter" data-desc="{{$x->description}}" data-id="{{$x->id}}">
                                                <i class='fa fa-edit'></i> </button>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-warning">
                    <div class="panel-heading">Roles</div>
                    <div class="panel-body">
                        <table class="table  users-table table-striped table-hover">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Created</th>
                                <th>Updated</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @if($users)
                                @foreach($users as $X)
                                    <tr>
                                        <td>{{$X->id}}</td>
                                        <td>{{$X->name}}</td>
                                        <td>{{$X->email}}</td>
                                        <td>{{$X->role->name}}</td>
                                        <td>{{$X->created_at->diffForHumans()}}</td>
                                        <td>{{$X->updated_at->diffForHumans()}}</td>
                                        <td>
                                            @if($X->id != 1)
                                                <button type='button' class='btn btn-primary btn-circle'
                                                        id='btnEditUser'
                                                        data-toggle="modal" data-target="#UserModalCenter"
                                                        data-role="{{$X->role_id}}" data-id="{{$X->id}}">
                                                    <i class='fa fa-edit'></i></button>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="RoleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Edit Role</h5>
                </div>
                <form method="post" action="{{route('adminSave')}}">
                <div class="modal-body">
                    <div class="form-group">

                            {{csrf_field()}}
                            <label>Description</label>
                            <input class="form-control" placeholder="Enter Description" id="desc_txt" name="desc_txt" required>
                            <input type="hidden" id="roleId" name="roleId">

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button id="saveRole" class="btn btn-primary" >Save</button>
                </div>
                </form>
            </div>
        </div>
    </div>


    <div class="modal fade" id="UserModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Edit User</h5>
                </div>
                <form method="post" action="{{route('adminSave')}}">
                <div class="modal-body">
                    <div class="form-group">

                            {{csrf_field()}}
                            <label>Role</label>
                            <select class="form-control" id="role" name="role" required>
                                @foreach($roles as $x)
                                    <option value="{{$x->id}}">{{$x->name}}</option>
                                @endforeach
                            </select>
                            <input type="hidden" id="userId" name="userId">

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button id="saveUser" class="btn btn-primary" >Save</button>
                </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('javascript')
    <script>
        $('.roles-table').on('click', 'tr', function(event) {
            if((event.originalEvent.originalTarget || event.originalEvent.srcElement).tagName=="TD" ){
                if($(this).hasClass('active')){
                    $(this).removeClass('active');
                } else {
                    $(this).addClass('active').siblings().removeClass('active');
                }
            }
        });
        $('.users-table').on('click', 'tr', function(event) {
            if((event.originalEvent.originalTarget || event.originalEvent.srcElement).tagName=="TD" ){
                if($(this).hasClass('active')){
                    $(this).removeClass('active');
                } else {
                    $(this).addClass('active').siblings().removeClass('active');
                }
            }
        });
        $('#RoleModalCenter').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget) // Button that triggered the modal
            var desc = button.data('desc') // Extract info from data-* attributes
            var id = button.data('id');
            var modal = $(this);
            modal.find('#desc_txt').val(desc);
            modal.find('#roleId').val(id);

        });
        $('#UserModalCenter').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget) // Button that triggered the modal
            var role_id = button.data('role') // Extract info from data-* attributes
            var id = button.data('id');
            var modal = $(this);
            modal.find('#role').val(role_id);
            modal.find('#userId').val(id);
        });
        $('#saveUser').on('click', function (e) {
            $(this).closest('form').submit();
        });
        $('#saveRole').on('click', function (e) {
            $(this).closest('form').submit();
        });


    </script>
    <style>
        tr.active > td {
            color: #1abf2f;
        }
        .table > tbody > tr > td{
            line-height: 2.5;
        }
        .roles-table tr button[data-toggle="modal"],.users-table tr button[data-toggle="modal"]{
            display: none;
        }
        .roles-table tr.active button[data-toggle="modal"],.users-table tr.active button[data-toggle="modal"]{
            display: block;
        }
        h5#exampleModalLongTitle {
            font: 27px/30px FANTASY;
            color: #17365a;
            display: inline-block;
        }
    </style>
@endsection