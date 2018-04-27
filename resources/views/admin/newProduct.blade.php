@extends('layouts.admin')
@section('title') New Product @endsection
@section('content')
    <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header bg-light">
                                New Product
                            </div>
                            @if(Session::has('success'))
                                <div class="alert alert-success">{{ Session::get('success') }}</div>
                            @endif
                            @if($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <form action="{{ route('adminNewProduct') }}" method="POST" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label for="normal-input" class="form-control-label">Thumbnail</label>
                                                <input type='file' name='thumbnail' id="normal-input" class="form-control" placeholder="Post title">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label for="normal-input" class="form-control-label">Title</label>
                                                <input name='title' id="normal-input" class="form-control" placeholder="Post title">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-4">
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label for="placeholder-input" class="form-control-label">Description</label>
                                                <textarea class='form-control' name="description" id="" cols="30" placeholder='Product description' rows="10"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label for="normal-input" class="form-control-label">Price</label>
                                                <input name='price' id="normal-input" class="form-control" placeholder="10.00">
                                            </div>
                                        </div>
                                    </div>
                                    <button class="btn btn-success" type='submit'>Create product</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
    </div>
@endsection

