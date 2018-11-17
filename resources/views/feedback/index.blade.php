@extends('layouts.app_inner')

@section('content')
<style>
  .uper {
    margin-top: 40px;
  }
</style>
<div class="uper">
  @if(session()->get('success'))
    <div class="alert alert-success alert_message">
      {{ session()->get('success') }}  
    </div><br />
  @endif
@if(Auth::user()->user_type == "U")
<a href="{{ url('admin/feedback/create') }}" class="btn btn-success">Add</a>
@endif
<h3 class="card-header">
  Feedback Index
</h3>
  <table class="table table-striped">
    <thead>
        <tr>
          <td>ID</td>
          <td>Name</td>
          <td>Email</td>
          <td>Title</td>
          <td>Message</td>
          <td colspan="2">Action</td>
        </tr>
    </thead>
    <tbody>
        <?php $i = 1; ?>
        @foreach($feedback_list as $result)
        <tr>
            <td>{{$i}}</td>
            <td>{{$result->name}}</td>
            <td>{{$result->email}}</td>
            <td>{{$result->title}}</td>
            <td>{{$result->message}}</td>
            <td><a href="{{ route('feedback.edit',$result->id)}}" class="btn btn-primary">Edit</a></td>
            <td>
                <form action="{{ route('feedback.destroy', $result->id)}}" method="post">
                  @csrf
                  @method('DELETE')
                  <button class="btn btn-danger" type="submit">Delete</button>
                </form>
            </td>
        </tr>
        <?php $i++; ?>
        @endforeach
    </tbody>
  </table>
<div>
@endsection