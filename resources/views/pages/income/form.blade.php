@extends('layouts.app')
@section('title', 'Income')
@section('content')
    <x-card>
        <x-slot name="header">Data Baru</x-slot>
        <x-slot name="body">
            <form action="{{ route('income.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group row mb-4">
                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Image</label>
                    <div class="col-sm-12 col-md-7">
                      <div id="image-preview" class="image-preview">
                        <label for="image-upload" id="image-label">Choose File</label>
                        <input type="file" name="image" id="image-upload">
                        @error('image')
                           <div style="color:red">{{ $message }}</div>
                        @enderror
                      </div>
                    </div>
                  </div>
                <div class="form-group row mb-4">
                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Buyer</label>
                    <div class="col-sm-12 col-md-7">
                        <input type="text" name="buyer" class="form-control" value="" placeholder="--Please Insert--">
                        @error('buyer')
                           <div style="color:red">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row mb-4">
                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Address</label>
                    <div class="col-sm-12 col-md-7">
                        <input type="text" name="address" class="form-control" value="" placeholder="--Please Insert--">
                        @error('address')
                           <div style="color:red">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row mb-4">
                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Item</label>
                    <div class="col-sm-12 col-md-7">
                        <input type="text" name="item" class="form-control" value="" placeholder="--Please Insert--">
                        @error('item')
                           <div style="color:red">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row mb-4">
                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Price</label>
                    <div class="col-sm-12 col-md-7">
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                              <div class="input-group-text">IDR</div>
                            </div>
                            <input type="text" class="form-control price" id="inlineFormInputGroup" name="price" placeholder="--Silahkan Isi--" value="0">
                        </div>
                        @error('price')
                           <div style="color:red">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row mb-4">
                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Total Item</label>
                    <div class="col-sm-12 col-md-7">
                        <input type="number" name="total" class="form-control item" value="1" placeholder="--Please Insert--">
                        @error('total')
                           <div style="color:red">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row mb-4">
                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Total Price</label>
                    <div class="col-sm-12 col-md-7">
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                              <div class="input-group-text">IDR</div>
                            </div>
                            <input type="text" class="form-control total_price" id="inlineFormInputGroup" name="total_price" readonly placeholder="0" value="0">
                        </div>
                        @error('total_price')
                           <div style="color:red">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row mb-4">
                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                    <div class="col-sm-12 col-md-7">
                      <a href="{{ route('blog') }}" class="btn btn-danger">Cancel</a>
                      <button class="btn btn-primary">Submit</button>
                    </div>
                  </div>
            </form>
        </x-slot>
    </x-card>
@endsection
@push('scripts')
    <script>
        $("document").ready(function() {
            $(".price").keyup(function() {
                var total = $(".price").val() *  $(".item").val()
                $(".total_price").val(total)
            });
            $(".item").keyup(function() {
                var total = $(".price").val() * $(".item").val()
                $(".total_price").val(total)
            });
        });
    </script>
@endpush