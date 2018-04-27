@extends('layouts.admin')
@section('title') Admin Products @endsection
@section('content')
    @section('content')
                <div class="content">
                    <div class="card">
                        <div class="card-header bg-light">
                            Admin Products
                            <a href="{{ route('adminNewProduct') }}" class='btn btn-primary'>New Product</a>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Thumbnail</th>
                                        <th>Title</th>
                                        <th>Description</th>
                                        <th>Price</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($products as $product)
                                        <tr>
                                            <td>{{ $product->id }}</td>
                                            <td><img src="{{ asset($product->thumbnail) }}" width='100' alt=""></td>
                                            <td class="text-nowrap"><a href="{{ route('adminEditProduct', $product->id) }}">{{ $product->title }}</a></td>
                                            <td>{{ $product->description }}</td>
                                            <td>R$ {{ $product->price }}</td>
                                            <td>
                                                <a href="{{ route('adminEditProduct', $product->id) }}" class="btn btn-warning"><i class="icon icon-pencil"></i></a>
                                                <form style='display:none;' id='deleteProduct-{{ $product->id }}' action="{{ route('adminDeleteProduct', $product->id) }}" method="POST">{{ csrf_field() }}</form>
                                                <button type='button' class="btn btn-danger" data-toggle="modal" data-target="#deleteProductModal-{{ $product->id }}">X</button>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
@foreach($products as $product)
                    <!-- Modal from bootstrap javascript live demo-->
                    <div class="modal fade" id="deleteProductModal-{{ $product->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h4 class="modal-title" id="myModalLabel">Você vai remover {{ $product->title}}</h4>
                          </div>
                          <div class="modal-body">
                            Tem certeza que quer deletar?
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Não, cancele</button>
                            <form id='deleteProduct-{{ $product->id }}' action="{{ route('adminDeleteProduct', $product->id) }}" method="POST">{{ csrf_field() }}
                                <button type="submit" class="btn btn-primary">Sim, delete</button>
                            </form>
                          </div>
                        </div>
                      </div>
                    </div>
                @endforeach
@endsection
