@extends('layouts.app')

@section('content')

<div style="height: 150px"></div> <!-- padding from header -->
<div class="container">
    <div class="col rounded-rectangle white">
        <div class="right_col booking" role="main">
            <div class="col-md-12 col-sm-12" role="main">
                <div class="col-md-12 col-sm-12">
                    <h2 class="table-title">Artikel untuk kamu</h2>

                    <hr>
                    @foreach ($articles as $article)
                    <a href="{{ route('article.view', ['article' => $article]) }}">
                        <h3>{{ $article->title }}</h3>
                        <div>{{ $article->short_description }}</div>
                    </a>
                    <hr>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
