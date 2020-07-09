@extends('backend.backend_template')
@section('content')
<div class="container">
     <div class="row">
        <div class="col">
            <h1>Edit Item</h1>
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
            <form method="post" action="{{ route('admin.item.update',$item->id)}}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="">Name<i color="red">*</i></label>   
                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $item->name }}" required autocomplete="title" autofocus>
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="">Supplier<i color="red">*</i></label>  
                    <select class="form-control" name="supplier_id" id="supplier">
                        <option disabled="disabled" selected="selected">Choose Supplier</option>
                        @foreach($suppliers as $supplier)
                            <option value="{{$supplier->id}}" 
                                <?php 
                                    if ($supplier->id == $item->supplier_id) {
                                        echo "selected";
                                    }
                                 ?>
                                >{{$supplier->name}}</option>
                        @endforeach
                    </select>
                </div> 
                <div class="form-group">
                    <label for="image">Image<i color="red">*</i></label>   
                    <input id="image" type="file" class="form-control @error('image') is-invalid @enderror" name="image" value="{{ old('image') }}">
                    <img src="{{asset($item->image)}}" style="width: 100px; height: 100px" class="img-fluid">
                    <input type="hidden" name="old_image" value="{{$item->image}}">
                    @error('image')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="price">Price<i color="red">*</i></label>   
                    <input id="price" type="text" class="form-control @error('price') is-invalid @enderror" name="price" value="{{ $item->price }}" required autocomplete="title" autofocus>
                    @error('price')
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