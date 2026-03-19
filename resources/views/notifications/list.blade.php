@extends('layouts.app')

@section('content')
    <!-- Content Section -->
    <div class="site-content">
        <div class="content-header">
            <h2 class="content-title">Notifications</h2>
            <hr class="content-divider">
            <div class="content-button-group"></div>
        </div>

        <div class="container">
            <div class="content-subtitle">
                Nouvelles notifications
            </div>
            <div class="row">

                @foreach ($user->unreadNotifications as $notification)
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <a href="{{ $user->getNotificationsLink($notification->type) }}"><strong>{{ $notification->data['user'] }}</strong> {{ $user->getNotificationsMessage($notification->type) }}
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="content-subtitle">
                Anciennes notifications
            </div>
            <div class="row">
                @foreach ($user->readNotifications as $notification)
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <a href="{{ $user->getNotificationsLink($notification->type) }}"><strong>{{ $notification->data['user'] }}</strong> {{ $user->getNotificationsMessage($notification->type) }}
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection

{{ $user->unreadNotifications->markAsRead() }}
