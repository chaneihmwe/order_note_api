@extends('backend.backend_template')
@section('content')
<div class="container">
     <div class="row">
         <div class="col">
             <h1>Create Supplier</h1>
         </div>
         <div class="col col-lg-2">
             <a class="btn btn-primary" href="{{route('admin.supplier.index')}}">
                 <i class="fas fa-list-ul"> Supplier List</i>
             </a>
         </div>
     </div>
 </div>
<div class="container">
    <div class="row">
        <div class="col-md-6 offset-3 card p-5">
            <form action="{{route('admin.supplier.store')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="">Supplier Name<i color="red">*</i></label>   
                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="title" autofocus>
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>  
                <div class="form-group">
                    <label for="">Supplier Phone No<i color="red">*</i></label>   
                    <input id="phone_no" type="text" class="form-control @error('phone_no') is-invalid @enderror" name="phone_no" value="{{ old('phone_no') }}" required autocomplete="title" autofocus>
                    @error('phone_no')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>  
                <div class="form-group">
                    <label for="address">Supplier Address<i color="red">*</i></label>   
                    <textarea id="address" type="text" class="form-control @error('address') is-invalid @enderror" name="address"  required autocomplete="title" autofocus>{{ old('address') }}</textarea>
                    @error('address')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div> 
                <div class="form-group">
                    <label for="">Supplier Image<i color="red">*</i></label>   
                    <input id="image" type="file" class="form-control @error('image') is-invalid @enderror" name="image" value="{{ old('image') }}" required autocomplete="title" autofocus>
                    @error('image')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>         
                <div class="form-group col-4 offset-4">
                    <input type="submit" value="Save" class="form-control btn btn-primary" >
                </div>
            </form>    
        </div>
    </div>    
</div>
@endsection