@extends('layouts.app')

@section('content')
<div class="container">
  Finished
<table class="table table-condensed" id="finished">
  <thead class="thead-inverse">
    <tr>
      <th>#</th>
      <th>Title</th>
      <th>Rating</th>
      <th></th>
    </tr>
  </thead>
  <tbody>
    @foreach($list as $book)
      @if($book->state == 1)
        <tr>
          <td><img src={{ $book->thumbnail }} alt={{ $book->title }} height="100" width="100"></td>
          <td>{{$book->title}}</td>
          <td>{{$book->rating}}</td>
          <td></td>
        </tr>
      @endif
    @endforeach
  </tbody>
</table>
<br><br>
Reading
<table align="left" class="table table-condensed" id="finished">
  <thead class="thead-inverse">
    <tr>
      <th>#</th>
      <th>Title</th>
      <th>Rating</th>
      <th></th>
    </tr>
  </thead>
  <tbody>
    @foreach($list as $book)
      @if($book->state == 2)
        <tr>
          <td><img src={{ $book->thumbnail }} alt={{ $book->title }} height="100" width="100"></td>
          <td>{{$book->title}}</td>
          <td>{{$book->rating}}</td>
          <td></td>
        </tr>
      @endif
    @endforeach
  </tbody>
</table>
<br><br>
Plan to read
<table class="table" align="left" id="finished">
  <thead class="thead-inverse">
    <tr>
      <th>#</th>
      <th>Title</th>
      <th>Rating</th>
      <th></th>
    </tr>
  </thead>
  <tbody>
    @foreach($list as $book)
      @if($book->state == 3)
        <tr>
          <td><img src={{ $book->thumbnail }} alt={{ $book->title }} height="100" width="100"></td>
          <td>{{$book->title}}</td>
          <td>{{$book->rating}}</td>
          <td></td>
        </tr>
      @endif
    @endforeach
  </tbody>
</table>
<br><br>
Dropped
<table class="table" id="finished">
  <thead class="thead-inverse">
    <tr>
      <th>#</th>
      <th>Title</th>
      <th>Rating</th>
      <th></th>
    </tr>
  </thead>
  <tbody>
    @foreach($list as $book)
      @if($book->state == 4)
        <tr>
          <td><img src={{ $book->thumbnail }} alt={{ $book->title }} height="100" width="100"></td>
          <td>{{$book->title}}</td>
          <td>{{$book->rating}}</td>
          <td></td>
        </tr>
      @endif
    @endforeach
  </tbody>
</table>
</div>
@endsection
