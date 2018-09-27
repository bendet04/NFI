@extends('layouts/base')
@section('content')
<button class="add-modal btn btn-primary">
    <span class="glyphicon glyphicon-plus"></span> Tambah User
</button>
</br>
</br>

<div class="box">
    <!-- /.box-header -->
    <div class="box-body">
        {{ csrf_field() }}
        <table id="table" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th class="text-center">#</th>
                    <th class="text-center">Name</th>
                    <th class="text-center">Email</th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>
            @php
            $no = 1;
            @endphp
            @foreach($data as $item)
            <tr class="item{{$item->id}}">
                <td>{{$no++}}</td>
                <td>{{$item->name}}</td>
                <td>{{$item->email}}</td>
                <td><button class="edit-modal btn btn-info"
                    data-info="{{$item->id}},{{$item->first_name}},{{$item->last_name}},{{$item->email}},{{$item->gender}},{{$item->country}},{{$item->salary}}">
                    <span class="glyphicon glyphicon-edit"></span> Edit
                </button>
                <button class="delete-modal btn btn-danger"
                data-info="{{$item->id}},{{$item->first_name}},{{$item->last_name}},{{$item->email}},{{$item->gender}},{{$item->country}},{{$item->salary}}">
                <span class="glyphicon glyphicon-trash"></span> Delete
            </button></td>
        </tr>
        @endforeach
    </table>
</div>
</div>
<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"></h4>

            </div>
            <div class="modal-body">
                <form class="form-horizontal" role="form">
                    <input type="hidden" class="form-control" id="id">
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="fname">Username</label>
                        <div class="col-sm-10">
                            <input type="name" class="form-control" id="username">
                        </div>
                    </div>
                    <p class="username_error error text-center alert alert-danger hidden"></p>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="lname">Nama Lengkap</label>
                        <div class="col-sm-10">
                            <input type="name" class="form-control" id="nama_lengkap">
                        </div>
                    </div>
                    <p class="nama_lengkap_error error text-center alert alert-danger hidden"></p>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="role">Role</label>
                        <div class="col-sm-10">
                            <select class="form-control" id="role" name="gender">
                                <option value="" disabled selected>Pilih role</option>
                                <option value="admin">admin</option>
                                <option value="ac">ac</option>
                                <option value="phone_call">phone_call</option>
                                <option value="final_review">final_review</option>
                                <option value="dc">desk_call</option>
                            </select>
                        </div>
                    </div>
                    <p class="role_error error text-center alert alert-danger hidden"></p>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="country">No Hp</label>
                        <div class="col-sm-10">
                            <input type="name" class="form-control" id="no_hp">
                        </div>
                    </div>
                    <p class="no_hp_error error text-center alert alert-danger hidden"></p>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="email">Email </label>
                        <div class="col-sm-10">
                            <input type="name" class="form-control" id="email">
                        </div>
                    </div>
                    <p class="email_error error text-center alert alert-danger hidden"></p>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="salary">Alamat </label>
                        <div class="col-sm-10">
                            <input type="name" class="form-control" id="alamat">
                        </div>
                    </div>
                    <p class="alamat_error error text-center alert alert-danger hidden"></p>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="status">Status </label>
                        <div class="col-sm-10">
                            <select class="form-control" id="status" name="status">
                                <option value="" disabled selected>Pilih status</option>
                                <option value="enable">Enable</option>
                                <option value="disable">Disable</option>
                            </select>
                        </div>
                    </div>
                    <p class="status_error error text-center alert alert-danger hidden"></p>
                </form>
                <div class="deleteContent">
                    Are you Sure you want to delete <span class="dname"></span> ? <span
                    class="hidden did"></span>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn actionBtn" data-dismiss="modal">
                        <span id="footer_action_button" class='glyphicon'> </span>
                    </button>
                    <button type="button" class="btn btn-warning" data-dismiss="modal">
                        <span class='glyphicon glyphicon-remove'></span> Close
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
$(document).ready(function() {
    $('#table').DataTable();
});
</script>
<script>

$(document).on('click', '.add-modal', function() {
    $('#footer_action_button').text(" Tambah");
    $('#footer_action_button').addClass('glyphicon-check');
    $('#footer_action_button').removeClass('glyphicon-trash');
    $('.actionBtn').addClass('btn-success');
    $('.actionBtn').removeClass('btn-danger');
    $('.actionBtn').removeClass('delete');
    $('.actionBtn').addClass('add');
    $('.modal-title').text('Tambah Operator');
    $('.deleteContent').hide();
    $('.form-horizontal').show();
    clearmodalData();
    $('#myModal').modal('show');
});

$(document).on('click', '.edit-modal', function() {
    $('#footer_action_button').text(" Update");
    $('#footer_action_button').addClass('glyphicon-check');
    $('#footer_action_button').removeClass('glyphicon-trash');
    $('.actionBtn').addClass('btn-success');
    $('.actionBtn').removeClass('btn-danger');
    $('.actionBtn').removeClass('delete');
    $('.actionBtn').addClass('edit');
    $('.modal-title').text('Edit');
    $('.deleteContent').hide();
    $('.form-horizontal').show();
    var stuff = $(this).data('info').split(',');
    fillmodalData(stuff)
    $('#myModal').modal('show');
});

$(document).on('click', '.delete-modal', function() {
    $('#footer_action_button').text(" Delete");
    $('#footer_action_button').removeClass('glyphicon-check');
    $('#footer_action_button').addClass('glyphicon-trash');
    $('.actionBtn').removeClass('btn-success');
    $('.actionBtn').addClass('btn-danger');
    $('.actionBtn').removeClass('edit');
    $('.actionBtn').addClass('delete');
    $('.modal-title').text('Delete');
    $('.deleteContent').show();
    $('.form-horizontal').hide();
    var stuff = $(this).data('info').split(',');
    $('.did').text(stuff[0]);
    $('.dname').html(stuff[1] +" "+stuff[2]);
    $('#myModal').modal('show');
});

function fillmodalData(details){
    $('#id').val(details[0]);
    $('#username').val(details[1]);
    $('#nama_lengkap').val(details[2]);
    $('#role').val(details[3]);
    $('#no_hp').val(details[4]);
    $('#email').val(details[5]);
    $('#alamat').val(details[6]);
    $('#status').val(details[7]);
}

function clearmodalData(){
    $('#id').val('');
    $('#username').val('');
    $('#nama_lengkap').val('');
    $('#role').val('');
    $('#no_hp').val('');
    $('#email').val('');
    $('#alamat').val('');
    $('#status').val('');
}

$('.modal-footer').on('click', '.add', function() {
    $.ajax({
        type: 'post',
        url: '/register',
        data: {
            'username': $('#username').val(),
            'nama_lengkap': $('#nama_lengkap').val(),
            'role': $('#role').val(),
            'no_hp': $('#no_hp').val(),
            'email': $('#email').val(),
            'alamat': $('#alamat').val(),
            'status': $('#status').val()
        },
        success: function(data) {
            if (data.errors){
                $('#myModal').modal('show');
                if(data.errors.username) {
                    $('.username_error').removeClass('hidden');
                    $('.username_error').text("Username tidak boleh kosong !");
                }
                if(data.errors.nama_lengkap) {
                    $('.nama_lengkap_error').removeClass('hidden');
                    $('.nama_lengkap_error').text("Nama Lengkap tidak boleh kosong !");
                }
                if(data.errors.no_hp) {
                    $('.no_hp_error').removeClass('hidden');
                    $('.no_hp_error').text("No. Hp tidak boleh kosong !");
                }
                if(data.errors.email) {
                    $('.country_error').removeClass('hidden');
                    $('.country_error').text("Email harus valid !");
                }
                if(data.errors.alamat) {
                    $('.alamat_error').removeClass('hidden');
                    $('.alamat_error').text("Alamat tidak boleh kosong !");
                }
            }
        }
    });
});

$('.modal-footer').on('click', '.edit', function() {
    $.ajax({
        type: 'post',
        url: '/editItem',
        data: {
            '_token': $('input[name=_token]').val(),
            'id': $("#fid").val(),
            'fname': $('#fname').val(),
            'lname': $('#lname').val(),
            'email': $('#email').val(),
            'gender': $('#gender').val(),
            'country': $('#country').val(),
            'salary': $('#salary').val()
        },
        success: function(data) {
            if (data.errors){
                $('#myModal').modal('show');
                if(data.errors.fname) {
                    $('.fname_error').removeClass('hidden');
                    $('.fname_error').text("First name can't be empty !");
                }
                if(data.errors.lname) {
                    $('.lname_error').removeClass('hidden');
                    $('.lname_error').text("Last name can't be empty !");
                }
                if(data.errors.email) {
                    $('.email_error').removeClass('hidden');
                    $('.email_error').text("Email must be a valid one !");
                }
                if(data.errors.country) {
                    $('.country_error').removeClass('hidden');
                    $('.country_error').text("Country must be a valid one !");
                }
                if(data.errors.salary) {
                    $('.salary_error').removeClass('hidden');
                    $('.salary_error').text("Salary must be a valid format ! (ex: #.##)");
                }
            }
        }
    });
});

$('.modal-footer').on('click', '.delete', function() {
    $.ajax({
        type: 'post',
        url: '/deleteItem',
        data: {
            '_token': $('input[name=_token]').val(),
            'id': $('.did').text()
        },
        success: function(data) {
            $('.item' + $('.did').text()).remove();
        }
    });
});
</script>
@endsection
