@extends('layouts.app')

@section('content')
<div class="site-content">
    <div class="container py-4">
        <div class="row">
            <div class="col-md-12">
                <h2 class="mb-4">Mes conversations</h2>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <input type="text" id="search" class="form-control" placeholder="Rechercher une conversation...">
                    </div>
                    <div class="list-group list-group-flush" id="conversations-list">
                        @forelse($conversations as $conversation)
                            @php
                                $otherUser = $conversation->participant_id === Auth::id()
                                    ? $conversation->organizer
                                    : $conversation->participant;
                                $unread = $conversation->unreadCount(Auth::id());
                                $last = $conversation->lastMessage;
                            @endphp
                            <a href="{{ route('chat.show', $conversation) }}"
                               class="list-group-item list-group-item-action">
                                <div class="d-flex align-items-center">
                                    <img src="{{ $otherUser->avatar() }}"
                                         class="rounded-circle mr-3"
                                         width="45" height="45"
                                         alt="{{ $otherUser->firstname }}">
                                    <div class="flex-grow-1 min-width-0">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <strong>{{ $otherUser->firstname }} {{ $otherUser->lastname }}</strong>
                                            @if($last)
                                                <small class="text-muted">{{ $last->created_at->diffForHumans() }}</small>
                                            @endif
                                        </div>
                                        <small class="text-muted d-block">{{ $conversation->workshop->name }}</small>
                                        <small class="text-muted text-truncate d-block">
                                            @if($last)
                                                @if($last->sender_id === Auth::id())
                                                    <span class="text-primary">Vous : </span>
                                                @endif
                                                {{ $last->body }}
                                            @else
                                                <em>Aucun message</em>
                                            @endif
                                        </small>
                                    </div>
                                    @if($unread > 0)
                                        <span class="badge badge-primary badge-pill ml-2">{{ $unread }}</span>
                                    @endif
                                </div>
                            </a>
                        @empty
                            <div class="list-group-item text-center text-muted py-5">
                                <p>Aucune conversation pour l'instant.</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>

            <div class="col-md-8">
                <div class="card">
                    <div class="card-body text-center text-muted py-5">
                        <p>Sélectionnez une conversation pour afficher les messages.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.getElementById('search').addEventListener('input', function() {
    const query = this.value.toLowerCase();
    document.querySelectorAll('#conversations-list a').forEach(item => {
        item.style.display = item.textContent.toLowerCase().includes(query) ? '' : 'none';
    });
});
</script>
@endsection