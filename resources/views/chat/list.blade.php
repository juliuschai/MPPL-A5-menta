@extends('layouts.app')

@section('content')
<main class="py-4 yellow">
    <div style="height: 150px"></div> <!-- padding from header -->
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="col rounded-rectangle white">
                    <div class="row justify-content-center">
                        <h2>Test</h2>
                        <ul class="list-group">
                            @foreach($conversations as $inbox)
                            <li class="list-group-item">
                                @if($inbox->message->conversation->is_accepted)
                                <a href="{{ route('chat.view' , [
                                    'id' => $inbox->message->conversation->id
                                ]) }}">
                                    <div class="about">
                                        <div class="name">{{$inbox->user->name}}</div>
                                        <div class="status">
                                            @if(auth()->user()->id == $inbox->message->sender->id)
                                            <span class="fa fa-reply"></span>
                                            @endif
                                            <span>{{ substr($inbox->message->text, 0, 20)}}</span>
                                        </div>
                                    </div>
                                </a>
                                @else
                                <a href="#">
                                    <div class="about">
                                        <div class="name">{{$inbox->user->name}}</div>
                                        <div class="status">
                                            @if(auth()->user()->id == $inbox->message->sender->id)
                                            <span class="fa fa-reply"></span>
                                            @endif
                                            <span>{{ substr($inbox->message->text, 0, 20)}}</span>
                                        </div>
                                        @if($inbox->message->conversation->second_user_id == auth()->id())
                                        <div>
                                            <a href="{{ route('chat.accept' , [
                                    'conversationId' => $inbox->message->conversation->id
                                ]) }}" class="btn btn-success">Accept Message Request</a>
                                        </div>
                                        @endif
                                    </div>
                                </a>
                                @endif
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
