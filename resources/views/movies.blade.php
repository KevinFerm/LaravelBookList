@extends('layouts.app')

@section('content')
<div class="container">
You cant see this if youre not logged in
<div class="form-group">
  {!! Form::open(array('url' => 'search')) !!}
  {{ Form::label("Search books", null, ['class' => 'control-label']) }}
  {{ Form::text("book", "Book", array_merge(['class' => 'form-control'], ['id' => 'typ'])) }}
  {{ Form::text("author", "Author (Optional)", array_merge(['class' => 'form-control'], ['id' => 'typ'])) }}
  {{ Form::submit("SEARCH") }}
{!! Form::close() !!}
</div>
@if(session()->has('result'))
  Search is done!
  @foreach(session('result')['items'] as $key => $value)
    <br>
    @if(isset($value['volumeInfo']['imageLinks']['smallThumbnail']))
      <img src={{ $value['volumeInfo']['imageLinks']['smallThumbnail'] }} alt={{ $value['volumeInfo']['title'] }}>
    @endif
    {!! $value['volumeInfo']['title'] !!} - Author:
    @if(isset($value['volumeInfo']['authors']))
      {!! $value['volumeInfo']['authors'][0] !!} --

        {!! Form::open(array('url' => 'add')) !!}
        Status: {{ Form::select("status",array(1 => 'Finished', 2 => 'Reading',3 => 'Plan to read', 4 => 'Dropped')) }}
        Rating: {{ Form::selectRange("rating", 1,10) }}
        {{ Form::hidden('title', $value['volumeInfo']['title']) }}
        {{ Form::hidden('book_id', $value['volumeInfo']['canonicalVolumeLink']) }}
        {{ Form::hidden('thumbnail', $value['volumeInfo']['imageLinks']['smallThumbnail']) }}
        {{ Form::hidden('user_id', Auth::user()->id) }}

        {{ Form::submit("Add") }}
      {!! Form::close() !!}
    @endif
    <br>
  @endforeach
@endif
</div>
@endsection
