@extends('layouts.app')
@section('title', 'Expense')
@section('content')
    <x-card>
        <x-slot name="header">Data Baru</x-slot>
        <x-slot name="body">
            <form action="{{ $action == "create" ? route('expense.store') : route('expense.update', ['id'=>$data->id])}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group row mb-4">
                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Image</label>
                    <div class="col-sm-12 col-md-7">
                      @if ($action == "edit")
                        <div id="image-preview" class="image-preview" style="background-image: url('{{ Storage::url($data->image) }}')">
                      @else
                        <div id="image-preview" class="image-preview">
                      @endif
                        <label for="image-upload" id="image-label">Choose File</label>
                        <input type="file" name="image" id="image-upload">
                        @error('image')
                           <div style="color:red">{{ $message }}</div>
                        @enderror
                      </div>
                    </div>
                  </div>
                <div class="form-group row mb-4">
                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Supplier</label>
                    <div class="col-sm-12 col-md-7">
                        <input type="text" name="supplier" class="form-control" placeholder="--Please Insert--" value="{{ $action == 'edit' ? $data->supplier : '' }}">
                        @error('supplier')
                           <div style="color:red">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row mb-4">
                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Address</label>
                    <div class="col-sm-12 col-md-7">
                        <input type="text" name="address" class="form-control" value="{{ $action == 'edit' ? $data->address : '' }}" placeholder="--Please Insert--">
                        @error('address')
                           <div style="color:red">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row mb-4">
                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Item</label>
                    <div class="col-sm-12 col-md-7">
                        <input type="text" name="item" class="form-control" value="{{ $action == 'edit' ? $data->item : '' }}" placeholder="--Please Insert--">
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
                            <input type="text" class="form-control price" id="inlineFormInputGroup" name="price" placeholder="--Silahkan Isi--" value="{{ $action == 'edit' ? $data->price : '0' }}">
                        </div>
                        @error('price')
                           <div style="color:red">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row mb-4">
                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Total Item</label>
                    <div class="col-sm-12 col-md-7">
                        <input type="number" name="total" class="form-control item" value="{{ $action == 'create' ? '0':$data->total }}" placeholder="--Please Insert--">
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
                            <input type="text" class="form-control total_price" id="inlineFormInputGroup" name="total_price" readonly placeholder="0" value="{{ $action == 'edit' ? $data->total_price : '0'}}">
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