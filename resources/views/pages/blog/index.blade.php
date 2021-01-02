@extends('layouts.app')
@section('title', 'Blog')
@section('content')
    <x-table>
        <x-slot name="form">{{ route('blog.create')}}</x-slot>
    </x-table>
@endsection