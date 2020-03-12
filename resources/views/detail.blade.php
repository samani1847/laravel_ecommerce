@extends('layouts.base')


@section('cssfile')
    <link href="{{ asset('jssocial/jssocials.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('jssocial/jssocials-theme-flat.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('plyr/plyr.css') }}" rel="stylesheet" type="text/css" />
    <style>
        .product-title{
            margin-bottom: 2rem;
        }
        .product-title h1{
            font-weight: 1000;
        }
    </style>
  @endsection


@section('content')
    <div class="row">
        <div class="col-3 offset-1">
            <img src="{{ url($product->image) }}" style="max-width:300px">
        </div>
        <div class="col-7">
            <div class="product-title"><h1>{{ $product->name }}</h1></div>
            <div class="product-rating"><i class="fa fa-star-o"></i> <i class="fa fa-star-o"></i> <i class="fa fa-star-o"></i> <i class="fa fa-star-o"></i> <i class="fa fa-star-o"></i></div>
            <div class="total-review">0 Review</div>
            <div id="share"></div>
            <hr>
            <br>
            <h5>Rp {{ $product->price }}</h5>
            <br>
            <button class="btn btn-primary addToCartBtn"  data-product="{{ $product->id }}">Add to Cart</button>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-10 offset-1">
            <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#description" role="tab">Description</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link"  data-toggle="tab" href="#reviews" role="tab">Reviews</a>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="description" role="tabpanel">
                    <br><br>
                    {{$product->description}}
                    <br>
                    @if ($product->sample_file)
                    <video controls>
                        <source src="{{ url($product->sample_file)}}" type="video/mp4">
                     </video>
                    @endif
                </div>
                <div class="tab-pane" id="reviews" role="tabpanel">...</div>
               
            </div>
            <br><br>
        </div>
    </div>
   
@endsection

@section('scriptfile')
    <script src="{{ asset('jssocial/jssocials.min.js') }}"></script>
    <script src="{{ asset('plyr/plyr.js') }}"></script>
    <script>plyr.setup();</script>
    <script>
        $(function(){
            $("#share").jsSocials({
                text: "{{ $product->name }}",
                shareIn: "popup",
                shares: ["twitter", "facebook", "googleplus", "linkedin"]
            });
        })
    </script>

@endsection
