@extends('layouts.main')

@section('title', 'Edit Produk')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Edit Produk</h1>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-md-6">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Informasi Produk</h3>

                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('product.update', ['product' => $product->id]) }}"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control" id="name" name="name"
                                        placeholder="Enter name" value="{{ $product->name }}">
                                    @error('name')
                                        <p class="text-small text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea class="form-control" id="description" name="description" placeholder="Enter description">{{ $product->description }}</textarea>
                                    @error('description')
                                        <p class="text-small text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="product_category_id">Category</label>
                                    <select class="form-control custom-select" id="product_category_id"
                                        name="product_category_id">
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}"
                                                {{ $category->id === $product->product_category_id ? 'selected' : '' }}>
                                                {{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('product_category_id')
                                        <p class="text-small text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="unit">Unit</label>
                                    <input type="text" class="form-control" id="unit" name="unit"
                                        placeholder="Enter unit" value="{{ $product->unit }}">
                                    @error('unit')
                                        <p class="text-small text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="sku">sku</label>
                                    <input type="text" class="form-control" id="sku" name="sku"
                                        placeholder="Enter Code" value="{{ $product->sku }}">
                                    @error('sku')
                                        <p class="text-small text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="price">Price</label>
                                    <input type="number" class="form-control" id="price" name="price"
                                        placeholder="Enter price" value="{{ $product->price }}">
                                    @error('price')
                                        <p class="text-small text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="quantity">Stock</label>
                                    <input type="number" class="form-control" id="quantity" name="quantity"
                                        placeholder="Enter quantity" value="{{ $product->inventory->quantity }}">
                                    @error('quantity')
                                        <p class="text-small text-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                                <button class="btn btn-success w-100 " type="submit">Submit</button>
                            </form>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <div class="col-md-6">
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Gambar produk</h3>
                        </div>
                        <div class="card-body p-0">
                            <div class="row">
                                @foreach ($product->image as $image)
                                    <div class="col-md-3">
                                        <div class="card pt-2">
                                            <div class="card-body row justify-content-center py-1 px-2">
                                                <img src="{{ asset('storage/' . $image->name) }}"
                                                    alt="{{ $image->name }}" class="card-img-top">
                                                <form
                                                    action="{{ route('product.image.destroy', ['image' => $image->id]) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <!-- Button trigger modal -->
                                                    <button type="button" class="btn btn-danger" data-toggle="modal"
                                                        data-target="#confirmDelete">
                                                        <i class="fas fa-trash"></i>
                                                    </button>

                                                    <!-- Modal -->
                                                    <div class="modal fade" id="confirmDelete" tabindex="-1" role="dialog"
                                                        aria-labelledby="confirmDeleteLabel" aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="confirmDeleteLabel">
                                                                        Konfirmasi Hapus data</h5>
                                                                    <button type="button" class="close"
                                                                        data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <img src="{{ asset('storage/' . $image->name) }}"
                                                                        alt="{{ $image->name }}"
                                                                        class="card-img-top mb-2">
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-dismiss="modal">Batal</button>
                                                                    <button type="submit" class="btn btn-danger">
                                                                        Hapus
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <hr>
                            <div class="card-secondary">
                                <div class="card-body">
                                    <form action="{{ route('product.image.store') }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group">
                                            <label for="images">Tambah Gambar</label>
                                            <input type="file" class="form-control" id="images" name="images[]"
                                                placeholder="Enter images" multiple>
                                            @error('images')
                                                <p class="text-small text-danger">{{ $message }}</p>
                                            @enderror
                                            @if ($errors->any())
                                                <div class="alert alert-danger">
                                                    <ul>
                                                        @foreach ($errors->all() as $error)
                                                            <li>{{ $error }}</li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            @endif
                                        </div>
                                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                                        <button class="btn btn-primary w-100" type="submit">Submit</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-6 p-3">
                    <a href="{{ route('product.index') }}" class="btn btn-danger w-100">Kembali ke tabel produk</a>
                </div>
            </div>
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection
