@extends('layouts.app')

@section('title', 'Blog')

@section('content')
    <x-card>
        <x-slot name="header">Data Baru</x-slot> 
        <x-slot name="body">
            <form action="{{ $action == "create" ? route('blog.store') : route('blog.update', ['id' => $data->id ]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group row mb-4">
                  <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Title</label>
                  <div class="col-sm-12 col-md-7">
                    <input type="text" name="title" class="form-control" value="{{ $action == 'edit' ? $data->title : '' }}">
                    @error('title')
                      <div style="color:red">{{ $message }}</div>
                    @enderror
                  </div>
                </div>
                <div class="form-group row mb-4">
                  <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Category</label>
                  <div class="col-sm-12 col-md-7">
                    <select name="category"  class="form-control selectric">
                      @if ($action == "create")
                        <option value="Tech">Tech</option>
                        <option value="News">News</option>
                        <option value="Political">Political</option>
                      @else 
                        <option value="Tech" {{ $data->category == "Tech" ? "selected" : ""}}>Tech</option>
                        <option value="News" {{ $data->category == "News" ? "selected" : ""}}>News</option>
                        <option value="Political" {{ $data->category == "Political" ? "selected" : ""}}>Political</option>
                      @endif
                    </select>
                    @error('category')
                      <div style="color:red">{{ $message }}</div>
                    @enderror
                  </div>
                </div>
                <div class="form-group row mb-4">
                  <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Content</label>
                  <div class="col-sm-12 col-md-7">
                    <textarea name="content" class="summernote">
                      {{ $action == "edit" ? $data->body : ""}}
                    </textarea>
                    @error('content')
                      <div style="color:red">{{ $message }}</div>
                    @enderror
                  </div>
                </div>
                <div class="form-group row mb-4">
                  <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                  <div class="col-sm-12 col-md-7">
                    <a href="{{ route('blog') }}" class="btn btn-danger">Cancel</a>
                    <button class="btn btn-primary">Publish</button>
                  </div>
                </div>
            </form>
        </x-slot>
    </x-card>
@endsection