@extends('layouts.base')



@section('content')
    @include('layouts.partials.search-bar')
    <div class="row">
        <div class="col-2">
            <div class="list-group">
                @foreach ($category as $value)
                    <a href="{{ url('/').'?cat_id='.$value->id }}" class="list-group-item {{ (app('request')->input('cat_id') == $value->id)?'active':'' }}">{{ $value->name }}</a>
                @endforeach
            </div>
        </div>
        <div class="col-10">
            @foreach ($products as $key => $row)
                @if (count($row))
                <div class="row justify-content-between">
                    <div class="col-3">
                        <h1 class="text-left text-muted">{{ $key }}</h1>
                    </div>
                    @if(!app('request')->input('cat_id') && count($row)==5)
                    <div class="col-3 text-right">
                        <a href="{{ url('/').'?cat_id='.$row[0]->category_id }}" class="btn btn-success" style="color:#fff">View More</a>
                    </div>
                    @endif

                </div>
           
                @endif

                @if(!count($row) && app('request')->input('cat_id')) 
                    <div class="alert alert-danger" role="alert">
                        There is no product in this category.
                    </div>
                @endif
            
                @foreach ($row as $value)

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
                @endforeach
            
                <br><br>
            @endforeach
    
        </div>
    </div>


@endsection
