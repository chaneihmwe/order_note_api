@extends('backend.backend_template')
@section('content')
<div class="container">
     <div class="row">
        <div class="col">
            <h1>Edit Supplier</h1>
        </div>
        <div class="col col-lg-2">
            <a class="btn btn-primary" href="{{URL::previous()}}">
                <i class="fas fa-backward">  Back</i>
            </a>
        </div>
     </div>
 </div>
<div class="container ">
    <div class="row">
        <div class="col-md-6 offset-3 card p-5">        
            <form method="post" action="{{ route('admin.supplier.update',$supplier->id)}}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group ">
                    <label for="">Supplier Name:</label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{$supplier->name}}" autofocus>
                     @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="">Supplier Phone No<i color="red">*</i></label>   
                    <input id="phone_no" type="text" class="form-control @error('phone_no') is-invalid @enderror" name="phone_no" value="{{$supplier->phone_no}}" required autocomplete="title" autofocus>
                    @error('phone_no')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>  
                <div class="form-group">
                    <label for="address">Supplier Address<i color="red">*</i></label>   
                    <textarea id="address" type="text" class="form-control @error('address') is-invalid @enderror" name="address"  required autocomplete="title" autofocus>{{$supplier->address}}</textarea>
                    @error('address')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div> 

                <div class="form-group">
                    <label for="image">Supplier Image<i color="red">*</i></label>   
                    <input id="image" type="file" class="form-control @error('image') is-invalid @enderror" name="image" value="{{ old('image') }}">
                    <img src="{{asset($supplier->image)}}" style="width: 100px; height: 100px" class="img-fluid">
                    <input type="hidden" name="old_image" value="{{$supplier->image}}">
                    @error('image')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group col-4 offset-4">
                    <input type="submit" value="Update" class="btn btn-primary ">
                </div>
            </form>
        </div>
    </div>  
</div>
@endsection