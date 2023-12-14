@extends('layouts.main')

@section('title', 'Product list')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Produk</h1>
                    </div>
                    <div class="col-sm-6">
                        <div class="float-right">
                            <a href="{{ route('product.add') }}" class="btn btn-success">
                                <i class="fas fa-plus-circle"></i>
                                Tambah Produk
                            </a>
                        </div>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>


        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Produk</th>
                                            <th>Kategori</th>
                                            <th>Deskripsi</th>
                                            <th>Harga</th>
                                            <th>Stok</th>
                                            <th>Image</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($products as $product)
                                            <tr>

                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $product->name }}</td>
                                                @foreach ($categories as $category)
                                                    @if ($category->id == $product->product_category_id)
                                                        <td>{{ $category->name }}</td>
                                                    @endif
                                                @endforeach
                                                <td>{{ $product->description }}</td>
                                                <td>{{ number_format($product->price) }}</td>
                                                <td>{{ $product->inventory->quantity }}</td>
                                                <td>
                                                    @foreach ($product->image as $image)
                                                        <img src="{{ asset('storage/' . $image->name) }}"
                                                            alt="{{ $image->name }}" class="img-fluid pr-2 py-2"
                                                            width="80px">
                                                    @endforeach
                                                </td>
                                                <td>
                                                    <a href="{{ route('product.edit', $product) }}"
                                                        class="btn btn-warning w-100 mb-2"><i class="fas fa-edit"></i></a>
                                                    <form action="{{ route('product.destroy', $product) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger w-100"
                                                            onclick="return confirm('Apakah Anda yakin ingin menghapus {{ $product->name }}?')">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </form>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                {{ $products->links() }}
                            </div>
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection
