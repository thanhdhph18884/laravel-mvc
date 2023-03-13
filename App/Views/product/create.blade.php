@extends('layouts.master')

@section('title', 'create product')

@section('content')
    <form action="{{ BASE_URL }}store" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="exampleName">Name</label>
            <input type="text" class="form-control" id="exampleName" name="name" placeholder="Enter name">
        </div>
        @if (isset($error['name']))
            <div class="alert alert-danger" role="alert">
                {{ $error['name'] }}
            </div>
        @endif
        <div class="form-group">
            <label for="exampleName">Email</label>
            <input type="email" class="form-control" id="exampleName" name="email" placeholder="Enter email">
        </div>
        @if (isset($error['email']))
            <div class="alert alert-danger" role="alert">
                {{ $error['email'] }}
            </div>
        @endif
        <div class="form-group">
            <label for="exampleName">image</label>
            <input type="file" class="form-control" id="exampleName" name="image">
        </div>
        @if (isset($error['image']))
            <div class="alert alert-danger" role="alert">
                {{ $error['image'] }}
            </div>
        @endif
        <div class="form-group">
            <label for="exampleName">Birthday</label>
            <input type="date" class="form-control" id="exampleName" name="birthday">
        </div>
        @if (isset($error['birthday']))
            <div class="alert alert-danger" role="alert">
                {{ $error['birthday'] }}
            </div>
        @endif
        <button type="submit" class="btn btn-primary">Create</button>
    </form>
@endsection
