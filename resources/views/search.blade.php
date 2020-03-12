@extends('layouts.base')



@section('content')
    @include('layouts.partials.search-bar')
    <div class="row ">
       
        @if(!count($products))
            <div class="col-6"> 
                <div class="alert alert-danger" role="alert">
                    No product found.
                </div>
            </div>
        @endif
        <div class="col-12">
           
            
            @foreach ($products as $key => $value)
              
                    @if ($loop->index % 5 == 0)
                    <div class="card-deck">
                    @endif
                        <div class="card" style="max-width:15rem !important;">
                            <a href="{{ url('/detailproduct/')}}/{{$value->id}}"><img class="card-img-top"  src="{{ $value->image ? url($value->image) : url('/storage/product_image/default.jpg')}}" alt="Card image cap"></a>
                            <div class="card-block">
                                <h4 class="card-title" style="max-height:60px;overflow:hidden">{{ $value->name }}</h4>
                            </div>
                            <div class="card-footer">
                            <p class="card-text text-right text-warning" style="font-size:1.5em" >Rp {{ $value->price }}</p>
                            </div>
                        </div>
                    @if ($loop->index % 5 == 4)
                        </div>
                    @endif
              
                <br><br>
            @endforeach
    
        </div>
    </div>


@endsection
