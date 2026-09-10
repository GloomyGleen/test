@extends('admin.layouts.layout')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Редактирование статьи</h1>
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
                <h3 class="card-title">Редактирование статьи "{{ $post->title }}"</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form method="POST" action="{{ route('posts.update', ['post' => $post->id ]) }}" enctype="multipart/form-data">
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
                            value="{{ $post->title }}"
                        />
                    </div>
                    <div class="form-group">
                        <label for="description">Цитата</label>
                        <textarea
                            class="form-control @error('description') is-invalid @enderror" 
                            id="description"
                            name="description"
                            rows="5"
                        >{{ $post->description }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="content">Контент</label>
                        <textarea
                            class="form-control @error('content') is-invalid @enderror" 
                            id="content"
                            name="content"
                            rows="5"
                        >{{ $post->content }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for=""category_id>Категория</label>
                        <select
                            class="form-control @error('category_id') is-invalid @enderror"
                            id="category_id"
                            name="category_id"
                        >
                            <option>Выбор категории</option>
                            @foreach ($categories as $key => $value)
                                <option
                                    value="{{ $key }}"
                                    @if($key == $post->category_id) selected @endif
                                > {{ $value }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="tags">Теги</label>
                        <select
                            name="tags[]"
                            id="tags"
                            class="select2 form-control"
                            multiple="multiple"
                            data-placeholder="Выбор тегов"
                        >
                            @foreach ($tags as $key => $value)
                                <option
                                    value="{{ $key }}"
                                    @if(in_array($key, $post->tags->pluck('id')->all())) selected @endif
                                >{{ $value }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="thumbnail">Изображение</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input
                                    type="file"
                                    class="custom-file-input @error('thumbnail') is-invalid @enderror"
                                    name="thumbnail"
                                    id="thumbnail"
                                >
                                <label class="custom-file-label" for="thumbnail">Choose file</label>
                            </div>
                        </div>
                        <div>
                            <img src="{{ $post->getImg() }}" class="img-thumbnail"/>
                        </div>
                    </div>
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