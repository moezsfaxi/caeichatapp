@extends('layouts.app')

@section('content')
<h1> LIST of the groups</h1>
<ol>
@foreach($groups as $group )
<li><a href="{{route('sendinggroup' , ['groupId' => $group->id ])}}">{{$group->name }}</a> </li>
@endforeach
</ol>
<!-- creating the button  -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#userListModal">
create a group chat
</button>

<!-- Modal -->
<div class="modal fade" id="userListModal" tabindex="-1" role="dialog" aria-labelledby="userListModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="userListModalLabel">Select Users</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- List of Users with checkboxes -->
        <form action="{{ route('createagroupchat') }}" method="POST">
          @csrf
          <div class="form-group row"> 
            <label for="groupname" class="col-md-4 col-form-label"  >group name :</label>
            <div class="col-sm-10"> 
              <input type="text" id="groupname"  name="groupname" class="form-control"  required>

            </div>

          </div>
          <div class="form-check">
            @foreach($users as $user)
              <div class="form-check">
                <input class="form-check-input" type="checkbox" name="selected_users[]" value="{{ $user->id }}" id="user{{ $user->id }}">
                <label class="form-check-label" for="user{{ $user->id }}">
                  {{ $user->name }}
                </label>
              </div>
            @endforeach
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">create a group chat</button>
      </div>
        </form>
    </div>
  </div>
</div>
        <!-- end modal -->

@endsection
@section('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
@endsection