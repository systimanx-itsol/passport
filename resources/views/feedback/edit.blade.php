@extends('layouts.app_inner')

@section('content')
<style>
  .uper {
    margin-top: 40px;
  }
</style>
<div class="card uper">
  <h3 class="card-header">
    Edit Feedback
  </h3>
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
      <form method="post" action="{{ route('feedback.update', $feedback->id) }}">
        @method('PATCH')
          <div class="form-group">
              @csrf
              <label for="name"> Title:</label>
          <input type="text" class="form-control" name="title" id="title" value="{{ $feedback->title }}"/>
          </div>
          <div class="form-group">
              <label for="message">Message :</label>
          <textarea name="message" id="message" class="form-control">{{$feedback->message}}</textarea>
          </div>
          <input type="submit" class="btn btn-primary" value="Update">
          <a href="{{ url('admin/feedback') }}" class="btn btn-success">Back</a>
      </form>
  </div>
</div>
@endsection