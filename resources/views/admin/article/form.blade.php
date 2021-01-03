@extends('layouts.app')

@section('content')
<div class="py-4 dark-blue">
    <div style="height: 150px"></div> <!-- padding from header -->
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Create Article') }}</div>

                    <div class="card-body">

                        @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                        @endif

                        @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif

                        <form action="{{ route('admin.article.form', ['article' => $article->id]) }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input id="title" type="text" name="title" class="form-control" value="{{ $article->title }}">
                            </div>
                            <div class="form-group">
                                <label for="shortDescription">Deskripsi</label>
                                <input id="shortDescription" type="text" name="shortDescription" class="form-control" value="{{ $article->short_description }}">
                            </div>
                            <div class="form-group">
                                <label for="title">Isi</label>
                                <textarea name="content" id="content">
                                    {{ $article->content }}
                                </textarea>
                            </div>
                            <button class="btn btn-primary btn-sm">Simpan</button>
                        </form>
                        <form action="{{ route('admin.article.delete', ['article' => $article->id]) }}" method="POST">
                            @csrf
                            <button class="btn btn-danger">
                                Hapus
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')

<script id="ckeditorScript" src="https://cdn.ckeditor.com/4.15.1/standard/ckeditor.js" defer></script>
<script defer>
    let script = document.getElementById('ckeditorScript');

    script.addEventListener('load', function() {
        runonload();
    });

    function runonload() {
        CKEDITOR.replace('content', {
            filebrowserUploadUrl: "{{route('admin.article.image', ['_token' => csrf_token() ])}}",
            filebrowserUploadMethod: 'form'
        });
    }
</script>

@endsection
