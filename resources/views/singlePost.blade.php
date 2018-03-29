@extends('layouts.master')
@section('content')
    <header class="masthead" style="background-image: url('{{ asset('assets/img/post-bg.jpg')}}')">
      <div class="overlay"></div>
      <div class="container">
        <div class="row">
          <div class="col-lg-8 col-md-10 mx-auto">
            <div class="post-heading">
              <h1>{{ $post->title }}</h1>
              <span class="meta">Posted by
                <a href="#">{{ $post->user->name }}</a>
                on {{ date_format($post->created_at, 'd M, Y') }}</span>
            </div>
          </div>
        </div>
      </div>
    </header>

    <!-- Post Content -->
    <article>
      <div class="container">
        <div class="row">
          <div class="col-lg-8 col-md-10 mx-auto">
            {!! nl2br($post->content) !!}
            <!--php function to insert line break when it occurs-->
          </div>
        </div>
        <div class="comments">
          <hr>
          <h2>Comments</h2>
          <hr>
          @foreach($post->comments as $comment)
            <p>{{ $comment->content }}<br>
            <small>by {{ $comment->user->name }}, on {{ date_format($comment->created_at, 'd M, Y') }}</small></p>
            <hr>
          @endforeach
          @if(Auth::check())
            <form action="{{ route('newComment') }}" method="POST">
              {{ csrf_field() }}
              <div class="form-group">
                <textarea class='form-control' placeholder='Comment...' name="comment" id="" cols="30" rows="4"></textarea>
                <input type="hidden" name='post' value='{{ $post->id }}' >
              </div>
              <div class="form-group">
                <button class='btn btn-primary' type='submit'>Make Comment</button>
              </div>
            </form>
          @endif
        </div>
      </div>
    </article>
@endsection
