@extends('admin.layouts.layout')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Редактирование категории</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Blank Page</li>
            </ol>
        </div>
        </div>
    </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

    <div class="card card-primary">
            <div class="card-header">
            <h3 class="card-title">
                Категория "{{ $category->title }}"
            </h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form method="POST" action="{{ route('categories.update', ['category' => $category->id ]) }}">
                @csrf
                @method('PUT')
                <div class="card-body">
                    <div class="form-group">
                    <label for="title">Название</label>
                    <input 
                        type="text"
                        class="
                            form-control
                            @error('title') is-invalid @enderror
                        "
                        id="title"
                        name="title"
                        value="{{ $category->title }}"
                    />
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Сохранить</button>
                </div>
            </form>
        </div>

    </section>
    <!-- /.content -->
@endsection