@extends('layouts.admin')
@section('title') User Comments @endsection
@section('content')
                <div class="content">
                    <div class="card">
                        <div class="card-header bg-light">
                            User Comments
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Post</th>
                                        <th>Content</th>
                                        <th>Created at</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach(Auth::user()->comments as $comment)
                                        <tr>
                                            <td>{{ $comment->id }}</td>
                                            <td class="text-nowrap"><a href="{{ route('singlePost', $comment->id) }}">{{ $comment->post->title }}</a></td>
                                            <td>{{ $comment->content }}</td>
                                            <td>{{ \Carbon\Carbon::parse($comment->created_at)->diffForHumans() }}</td>
                                            <td>
                                                <button type='button' class='btn btn-danger' data-toggle="modal" data-target="#deleteCommentModal-{{ $comment->id }}">X</button>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                @foreach(Auth::user()->comments as $comment)
                    <!-- Modal from bootstrap javascript live demo-->
                    <div class="modal fade" id="deleteCommentModal-{{ $comment->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h4 class="modal-title" id="myModalLabel">Você vai remover o comentário para o post {{ $comment->post->title}}</h4>
                          </div>
                          <div class="modal-body">
                            Tem certeza que quer deletar?
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Não, cancele</button>
                            <form id='deleteComment-{{ $comment->id }}' action="{{ route('deleteComment', $comment->id) }}" method="POST">{{ csrf_field() }}
                                <button type="submit" class="btn btn-primary">Sim, delete</button>
                            </form>
                          </div>
                        </div>
                      </div>
                    </div>
                @endforeach
@endsection

