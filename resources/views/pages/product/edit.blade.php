@extends('layouts.main')

@section('title', 'Tambah Produk')

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
                            <h3 class="card-title">General</h3>

                        </div>
                        <div class="card-body">
                            <form action="{{ route('product.update', $product->product_id) }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="inputName" class="form-label">Nama Produk</label>
                                    <input type="text" id="inputName" class="form-control" name="product_name"
                                        value="{{ $product->product_name }}">
                                </div>
                                <div class="from-group">
                                    <label for="inputCategory" class="form-label">Kategori</label>
                                    <select id="inputCategory" class="form-control custom-select" name="category_id">
                                        <option selected disabled>Select one</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}"
                                                {{ $category->id == $product->category_id ? 'selected' : '' }}>
                                                {{ $category->category_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="inputDescription" class="form-label">Deskripsi</label>
                                    <textarea id="inputDescription" class="form-control" rows="4" name="description">{{ $product->description }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="inputPrice" class="form-label">Harga</label>
                                    <input type="text" id="inputPrice" class="form-control" name="price"
                                        value="{{ $product->price }}">
                                </div>
                                <div class="form-group">
                                    <label for="inputUnit" class="form-label">Satuan</label>
                                    <input type="text" id="inputUnit" class="form-control" name="unit"
                                        value="{{ $product->unit }}">
                                </div>
                                <div class="form-group">
                                    <label for="inputImage" class="form-label">Gambar</label>
                                    <input type="file" id="inputImage" class="form-control" name="image" multiple>
                                </div>

                                @if (count($product->image) > 0)
                                    <div class="form-group">
                                        <label for="currentImages" class="form-label">Gambar saat ini</label>
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>Gambar</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            {{-- <tbody>
                                                @foreach ($product->image as $image)
                                                    <tr>
                                                        <td><img src="{{ asset('template/' . $image) }}" alt=""
                                                                width="100"></td>
                                                        <td>

                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody> --}}
                                        </table>
                                    </div>
                                @endif

                            </form>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <div class="col-md-6">
                    <div class="card card-secondary">
                        <div class="card-header">
                            <h3 class="card-title">image</h3>
                        </div>
                        <div class="card-body">

                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <a href="#" class="btn btn-secondary">Cancel</a>
                    <input type="submit" value="Save Changes" class="btn btn-success float-right">
                </div>
            </div>
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection
