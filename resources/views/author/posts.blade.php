@extends('layouts.admin')
@section('title') Author Posts @endsection
@section('content')
    @section('content')
                <div class="content">
                    <div class="card">
                        <div class="card-header bg-light">
                            Author Posts
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Title</th>
                                        <th>Created at</th>
                                        <th>Updated at</th>
                                        <th>Comments</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach(Auth::user()->posts as $post)
                                        <tr>
                                            <td>{{ $post->id }}</td>
                                            <td class="text-nowrap"><a href="{{ route('singlePost', $post->id) }}">{{ $post->title }}</a></td>
                                            <td>{{ \Carbon\Carbon::parse($post->created_at)->diffForHumans() }}</td>
                                            <td>{{ \Carbon\Carbon::parse($post->updated_at)->diffForHumans() }}</td>
                                            <td>{{ $post->comments->count() }}</td>
                                            <td>
                                                <a href="{{ route('postEdit', $post->id) }}" class="btn btn-warning"><i class="icon icon-pencil"></i></a>
                                                <button type='button' class="btn btn-danger" data-toggle="modal" data-target="#deletePostModal-{{ $post->id }}">X</button>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                 @foreach(Auth::user()->posts as $post)
                    <!-- Modal from bootstrap javascript live demo-->
                    <div class="modal fade" id="deletePostModal-{{ $post->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h4 class="modal-title" id="myModalLabel">Você vai remover {{ $post->title}}</h4>
                          </div>
                          <div class="modal-body">
                            Tem certeza que quer deletar?
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Não, cancele</button>
                            <form id='deletePost-{{ $post->id }}' action="{{ route('deletePost', $post->id) }}" method="POST">{{ csrf_field() }}
                                <button type="submit" class="btn btn-primary">Sim, delete</button>
                            </form>
                          </div>
                        </div>
                      </div>
                    </div>
                @endforeach
@endsection
