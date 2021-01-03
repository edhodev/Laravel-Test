@extends('layouts.app')
@section('title', 'Profile');
@section('content')
<x-card>
    <x-slot name="header">Hi, update your profile in here</x-slot>
    <x-slot name="body">
        <form action="{{ route('profile.update', ['id'=>User::profile()->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group row mb-4">
                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Image</label>
                <div class="col-sm-12 col-md-7">
                    <div id="image-preview" class="image-preview" style="background-image: url('{{ Storage::url($data->image) }}')">
                        <label for="image-upload" id="image-label">Choose File</label>
                        <input type="file" name="image" id="image-upload">
                        @error('image')
                        <div style="color:red">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="form-group row mb-4">
                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Name</label>
                <div class="col-sm-12 col-md-7">
                    <input type="text" name="name" class="form-control" placeholder="--Please Insert--" value="{{ $data->name }}">
                    @error('name')
                       <div style="color:red">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="form-group row mb-4">
                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Address</label>
                <div class="col-sm-12 col-md-7">
                    <input type="text" name="address" class="form-control" value="{{ $data->address }}" placeholder="--Please Insert--">
                    @error('address')
                       <div style="color:red">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="form-group row mb-4">
                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Phone</label>
                <div class="col-sm-12 col-md-7">
                    <input type="text" name="phone" class="form-control" value="{{ $data->phone }}" placeholder="--Please Insert--">
                    @error('phone')
                       <div style="color:red">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="form-group row mb-4">
                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                <div class="col-sm-12 col-md-7">
                  <button class="btn btn-primary">Submit</button>
                </div>
            </div>
        </form>
    </x-slot>
</x-card>
@endsection