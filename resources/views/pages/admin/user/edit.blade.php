@extends('layouts.main')

@section('title', 'Edit User')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Edit User</h1>
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
                            <h3 class="card-title">Informasi User</h3>

                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('user.update', ['user' => $user->id]) }}"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control" id="name" name="name"
                                        placeholder="Enter name" value="{{ $user->name }}">
                                    @error('name')
                                        <p class="text-small text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="email">Category</label>
                                    <input type="text" class="form-control" id="email" name="email"
                                        placeholder="Enter email" value="{{ $user->email }}">
                                    @error('email')
                                        <p class="text-small text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="isadmin">Unit</label>
                                    <select class="form-control custom-select" id="is_admin" name="is_admin">
                                        <option value="1" {{ $user->is_admin == 1 ? 'selected' : '' }}>Admin</option>
                                        <option value="0" {{ $user->is_admin == 0 ? 'selected' : '' }}>User</option>
                                    </select>
                                    @error('unit')
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
            </div>
            <hr>
            <div class="row">
                <div class="col-6 p-3">
                    <a href="{{ route('user.index') }}" class="btn btn-danger w-100">Kembali ke tabel User</a>
                </div>
            </div>
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection
