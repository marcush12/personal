@extends('layouts.master')

@section('content')
    <!-- Page Header -->
    <header class="masthead" style="background-image: url('{{asset('assets/img/home-bg.jpg')}}">
      <div class="overlay"></div>
      <div class="container">
        <div class="row">
          <div class="col-lg-8 col-md-10 mx-auto">
            <div class="site-heading">
              <h1>{{$product->title}}</h1>
            </div>
          </div>
        </div>
      </div>
    </header>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <img src="{{ asset($product->thumbnail) }}" alt="">
            </div>
            <div class="col-md-6">
                <h2>{{$product->title}}</h2>
                <hr>
                {{$product->description}}
                <hr>
                <b>R$ {{$product->price}}</b>
                <br>
                <a href="{{ route('shop.orderProduct', $product->id) }}" class="btn btn-primary">Pague com PayPal</a>
            </div>
        </div>
    </div>
@endsection

