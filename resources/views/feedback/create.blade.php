@extends('layouts.app_inner')

@section('content')
<style>
  .uper {
    margin-top: 40px;
  }
</style>
<div class="card uper">
  <h3 class="card-header">
    Add Feedback
  </h3>
  
  @if(session()->get('success'))
    <div class="alert alert-success alert_message">
      {{ session()->get('success') }}  
    </div><br />
  @endif
  <div class="card-body">
    @if ($errors->any())
      <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
        </ul>
      </div><br />
    @endif
      <form method="post" action="{{ route('feedback.store') }}">
        <div class="form-group">
            @csrf
            <label for="name"> Title:</label>
        <input type="text" class="form-control" name="title" id="title"/>
        </div>
        <div class="form-group">
            <label for="message">Message :</label>
        <textarea name="message" id="message" class="form-control"></textarea>
        </div>
        <input type="submit" class="btn btn-primary" value="Add">
      </form>
  </div>
</div>
@endsection