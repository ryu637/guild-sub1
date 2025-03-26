@extends('layouts.company')

@section('title', 'Message')

@section('content')
<style>
    body {
        margin: 0;
        overflow: hidden; /* 画面全体のスクロールを防ぐ */
        height: 100vh;
    }

    .sidebar {
        width: 25%;
        background-color: #e3d9c3;
        height: 100vh;
        overflow-y: auto;
        padding: 10px;
    }

    .main-content {
        width: 75%;
        background-color: #F4EEE0;
        height: 100vh;
        padding: 10px;
    }

    .message-container {
        margin-top: 90px;
        overflow-y: auto;
        height: 60vh;
        padding-right: 10px;
    }

    .message-input {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 10px;
    }

    .message-box {
        max-width: 50%;
        border: 2px solid black;
        border-radius: 15px;
        padding: 10px;
        box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.2);
    }

    .message-left {
        display: flex;
        align-items: start;
    }

    .message-right {
        display: flex;
        align-items: start;
        justify-content: end;
    }

    a {
    color: inherit;  /* 親要素の色を継承 */
    text-decoration: none;  /* 下線を削除 */
}

</style>

<div class="d-flex">
    <!-- サイドバー -->
    <div class="sidebar">
        @foreach ($all_users as $user_all)
            <div class="mt-2 d-flex align-items-start border-bottom border-black">
                <a href="{{ route('company.freelancer.profile.show', $user_all->id)}}" class="text-black"><i class="fa-solid fa-circle-user fa-3x"></i></a>
                <a href="{{ route('company.contact.with_freelancer', $user_all->id )}}" class="mt-2 fs-5 ms-2">{{ $user_all->name }}</a>
            </div>
        @endforeach
    </div>

    <!-- メインコンテンツ -->
    <div class="main-content">
        @if($user->id == Auth::user()->id)
            <div class="none-message text-center">
                <h1 class="border-bottom mt-3">User name:</h1>
                <div class="message-container d-flex justify-content-center align-items-center">
                    <div>
                        <i class="fa-regular fa-comment text-dark fa-4x"></i>
                        <h4>Your messages</h4>
                        <p class="text-secondary">Send a message to start a chat.</p>
                        <a href="{{ route('company.freelancer.list')}}" class="btn btn-secondary">Send message</a>
                    </div>
                </div>
            </div>
        @else
            <h1 class="border-bottom mt-3">User name: {{ $user->name }}</h1>
            <div class="message-container">
                @foreach ($messages as $message)
                    @if ($message->sender_id == Auth::user()->id)
                        <div class="message-right">
                            <p class="message-box me-3">{{ $message->content }}</p>
                        </div>
                    @else
                        <div class="message-left">
                            <i class="fa-solid fa-circle-user fa-3x"></i>
                            <p class="message-box ms-3">{{ $message->content }}</p>
                        </div>
                    @endif
                @endforeach
            </div>

            <!-- メッセージ送信フォーム -->
            <form action="{{route('company.contact.store', $user->id)}}" method="post">
                @csrf
                <div class="message-input">
                    <input type="hidden" name="receiver_id" value="{{$user->id}}">
                    <input type="text" name="content" class="form-control w-75 rounded-pill py-2 px-3" placeholder="Type your message...">
                    <button type="submit" class="btn btn-secondary rounded-pill px-4 py-2">Send</button>
                </div>
            </form>
        @endif
    </div>
</div>
@endsection
