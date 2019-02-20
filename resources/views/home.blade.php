@extends('layouts.app')

@section('content')
<div class="container">
@if($cart==NULL)
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">add cart if not</div>

                <div class="card-body">
                    <form method="POST" action="{{ url('/cart') }}">
                        @csrf                        
                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary btn-large" style="width: 50%;">
                                    new cart
                                </button>
                            </div>
                        </div>
                    </form>

                    
                </div>
            </div>
        </div>
    </div>
@else
     <div class="row justify-content-center" style="margin:20px">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">add new product</div>

                <div class="card-body">
                    
                <form method="POST" action="{{ url('/cart/add') }}">
                        @csrf                        

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name"  required autofocus>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="price" class="col-md-4 col-form-label text-md-right">price</label>

                            <div class="col-md-6">
                                <input id="price" type="text" class="form-control" name="price" required>

                            
                            </div>
                        </div>
                                <input id="currency_iso_code" type="text" class="form-control" name="currency_iso_code" required hidden value="ILS">
                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary btn-large" style="width: 50%;">
                                    add product
                                </button>
                            </div>
                        </div>
                    </form>
                    
                </div>
            </div>
        </div>
    </div>

@endif 
@if ($cart != NULL)
<div class="row justify-content-center" style="margin:20px">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">general info</div>
                <div class="card-body">
                    <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <p> tottal : {{ $count }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <p> price : {{ $total }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
@endif

@if ($products != NULL)
@foreach ($products as $p)
<div class="row justify-content-center" style="margin:20px">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Product id {{ $p->id }}</div>

                <div class="card-body">
                    <div class="form-group row mb-0">
                        <div class="col-md-8 offset-md-4">
                            <p> Name : {{ $p->id }} </p>
                        </div>
                    </div>
                    <div class="form-group row mb-0">
                        <div class="col-md-8 offset-md-4">
                            <p> Price : {{ $p->price }}</p>
                        </div>
                    </div>
                </div>
                <div class="form-group row mb-0">
                        <div class="col-md-8 offset-md-4">
                            <p> Currency : {{ $p->currency_iso_code }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endforeach
@endif
</div>
@endsection
