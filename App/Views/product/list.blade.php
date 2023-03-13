@extends('layouts.master')

@section('title', 'list product')

@section('content')
    <?php
    if (isset($_SESSION['mess'])) {
        $message = '<div class="bg-success p-2 text-lg my-2 rounded">' . $_SESSION['mess'] . '</div>';
    } else {
        $message = '';
    }
    unset($_SESSION['mess']);
    echo $message;
    ?>
    <table class="table">
        <a href="{{ BASE_URL }}create" class="btn btn-primary">Thêm</a>
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Image</th>
                <th scope="col">Birthday</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $key => $product)
                <tr>
                    <th scope="row">{{ $key + 1 }}</th> 
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->email }}</td>
                    <td><img width="300px" src="{{ BASE_URL . $product->image }}" alt=""></td>
                    <td>{{ $product->birthday }}</td>
                    <td>
                        <a href="{{ BASE_URL }}/edit/{{ $product->id }}" class="btn btn-warning">Edit</a>
                        <a href="{{ BASE_URL }}/destroy/{{ $product->id }}"
                            onclick="return confirm('Ban co muon xoa khong?')" class="btn btn-danger">Delete</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
</table>@endsection
