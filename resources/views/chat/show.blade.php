@extends('layouts.app')

@section('content')

<style>
   .chat-wrapper {
    height: calc(100vh - 80px);
    display: flex;
    font-family: 'Poppins', sans-serif;
    background: #f5f5f5;
    overflow: hidden;
    margin-left: 300px; /* ← ajuste selon la largeur de ta sidebar */
}

    /* ── COLONNE GAUCHE ── */
    .chat-sidebar {
        width: 340px;
        min-width: 340px;
        background: #fff;
        border-right: 1px solid #e8e8e8;
        display: flex;
        flex-direction: column;
        overflow: hidden;
    }

    .chat-sidebar-header {
        padding: 24px 20px 16px;
        border-bottom: 1px solid #f0f0f0;
    }

    .chat-sidebar-header h2 {
        font-size: 1.4rem;
        font-weight: 700;
        color: #1d3557;
        margin-bottom: 14px;
    }

    .chat-search {
        position: relative;
    }

    .chat-search input {
        width: 100%;
        padding: 10px 16px 10px 38px;
        border: 1.5px solid #e8e8e8;
        border-radius: 12px;
        font-size: 0.875rem;
        background: #f8f8f8;
        color: #333;
        transition: border-color .2s;
        outline: none;
    }

    .chat-search input:focus {
        border-color: #B24592;
        background: #fff;
    }

    .chat-search i {
        position: absolute;
        left: 12px;
        top: 50%;
        transform: translateY(-50%);
        color: #aaa;
        font-size: 0.85rem;
    }

    .conversations-list {
        flex: 1;
        overflow-y: auto;
        padding: 8px 0;
    }

    .conversations-list::-webkit-scrollbar { width: 4px; }
    .conversations-list::-webkit-scrollbar-track { background: transparent; }
    .conversations-list::-webkit-scrollbar-thumb { background: #e0e0e0; border-radius: 4px; }

    .conversation-item {
        display: flex;
        align-items: center;
        padding: 12px 20px;
        cursor: pointer;
        transition: background .15s;
        text-decoration: none !important;
        border-left: 3px solid transparent;
    }

    .conversation-item:hover {
        background: #fdf5fb;
    }

    .conversation-item.active {
        background: #fdf5fb;
        border-left-color: #B24592;
    }

    .conv-avatar {
        position: relative;
        margin-right: 12px;
        flex-shrink: 0;
    }

    .conv-avatar img {
        width: 46px;
        height: 46px;
        border-radius: 50%;
        object-fit: cover;
        border: 2px solid #f0f0f0;
    }

    .online-dot {
        position: absolute;
        bottom: 1px;
        right: 1px;
        width: 11px;
        height: 11px;
        background: #22c55e;
        border-radius: 50%;
        border: 2px solid #fff;
    }

    .conv-info {
        flex: 1;
        min-width: 0;
    }

    .conv-top {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 2px;
    }

    .conv-name {
        font-weight: 600;
        font-size: 0.9rem;
        color: #1d3557;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .conv-time {
        font-size: 0.75rem;
        color: #aaa;
        flex-shrink: 0;
        margin-left: 8px;
    }

    .conv-workshop {
        font-size: 0.78rem;
        color: #B24592;
        margin-bottom: 2px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .conv-last {
        font-size: 0.8rem;
        color: #888;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .conv-badge {
        background: #B24592;
        color: #fff;
        font-size: 0.7rem;
        font-weight: 700;
        border-radius: 20px;
        padding: 1px 7px;
        margin-left: 6px;
        flex-shrink: 0;
    }

    /* ── COLONNE CENTRALE ── */
    .chat-main {
        flex: 1;
        display: flex;
        flex-direction: column;
        overflow: hidden;
        background: #f9f9f9;
    }

    .chat-main-header {
        background: #fff;
        padding: 16px 24px;
        border-bottom: 1px solid #e8e8e8;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .chat-main-header-left {
        display: flex;
        align-items: center;
        gap: 14px;
    }

    .header-avatar {
        position: relative;
    }

    .header-avatar img {
        width: 48px;
        height: 48px;
        border-radius: 50%;
        object-fit: cover;
        border: 2px solid #f0f0f0;
    }

    .header-avatar .online-dot {
        width: 12px;
        height: 12px;
    }

    .header-user-info h3 {
        font-size: 1rem;
        font-weight: 700;
        color: #1d3557;
        margin: 0;
    }

    .header-user-info .workshop-name {
        font-size: 0.82rem;
        color: #B24592;
        margin: 0;
    }

    .header-user-info .response-time {
        font-size: 0.78rem;
        color: #888;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 4px;
    }

    .btn-voir-atelier {
        background: #fff;
        border: 2px solid #1d3557;
        color: #1d3557 !important;
        font-weight: 600;
        font-size: 0.85rem;
        padding: 8px 18px;
        border-radius: 10px;
        text-decoration: none !important;
        transition: all .2s;
    }

    .btn-voir-atelier:hover {
        background: #1d3557;
        color: #fff !important;
    }

    /* Messages */
    .chat-messages {
        flex: 1;
        overflow-y: auto;
        padding: 24px;
        display: flex;
        flex-direction: column;
        gap: 12px;
    }

    .chat-messages::-webkit-scrollbar { width: 4px; }
    .chat-messages::-webkit-scrollbar-track { background: transparent; }
    .chat-messages::-webkit-scrollbar-thumb { background: #ddd; border-radius: 4px; }

    .message-group {
        display: flex;
        flex-direction: column;
    }

    .message-bubble {
        max-width: 60%;
        padding: 12px 16px;
        border-radius: 18px;
        font-size: 0.9rem;
        line-height: 1.5;
        position: relative;
    }

    .message-bubble.received {
        background: #fff;
        color: #333;
        border-bottom-left-radius: 4px;
        box-shadow: 0 1px 3px rgba(0,0,0,.06);
        align-self: flex-start;
    }

    .message-bubble.sent {
        background: #1d3557;
        color: #fff;
        border-bottom-right-radius: 4px;
        align-self: flex-end;
    }

    .message-time {
        font-size: 0.72rem;
        color: #aaa;
        margin-top: 4px;
    }

    .message-time.sent { text-align: right; }

    .message-date-separator {
        text-align: center;
        font-size: 0.75rem;
        color: #aaa;
        margin: 8px 0;
        position: relative;
    }

    .message-date-separator::before,
    .message-date-separator::after {
        content: '';
        position: absolute;
        top: 50%;
        width: 35%;
        height: 1px;
        background: #e8e8e8;
    }

    .message-date-separator::before { left: 0; }
    .message-date-separator::after { right: 0; }

    /* Zone d'envoi */
    .chat-input-area {
        background: #fff;
        border-top: 1px solid #e8e8e8;
        padding: 16px 24px;
    }

    .chat-input-form {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .chat-input-form input[type="text"] {
        flex: 1;
        border: 1.5px solid #e8e8e8;
        border-radius: 24px;
        padding: 12px 20px;
        font-size: 0.9rem;
        outline: none;
        transition: border-color .2s;
        background: #f8f8f8;
    }

    .chat-input-form input[type="text"]:focus {
        border-color: #B24592;
        background: #fff;
    }

    .btn-send {
        background: #1d3557;
        color: #fff !important;
        border: none;
        border-radius: 24px;
        padding: 12px 24px;
        font-size: 0.875rem;
        font-weight: 600;
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 8px;
        transition: background .2s, transform .1s;
        text-decoration: none !important;
    }

    .btn-send:hover { background: #B24592; }
    .btn-send:active { transform: scale(0.97); }

    /* ── COLONNE DROITE ── */
    .chat-details {
        width: 280px;
        min-width: 280px;
        background: #fff;
        border-left: 1px solid #e8e8e8;
        overflow-y: auto;
        padding: 24px 20px;
    }

    .chat-details::-webkit-scrollbar { width: 4px; }
    .chat-details::-webkit-scrollbar-track { background: transparent; }
    .chat-details::-webkit-scrollbar-thumb { background: #e0e0e0; border-radius: 4px; }

    .chat-details h4 {
        font-size: 1rem;
        font-weight: 700;
        color: #1d3557;
        margin-bottom: 16px;
    }

    .workshop-img {
        width: 100%;
        height: 160px;
        object-fit: cover;
        border-radius: 12px;
        background: #f0f0f0;
        margin-bottom: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #ccc;
        font-size: 2rem;
    }

    .workshop-img img {
        width: 100%;
        height: 160px;
        object-fit: cover;
        border-radius: 12px;
    }

    .workshop-detail-name {
        font-size: 1rem;
        font-weight: 700;
        color: #1d3557;
        margin-bottom: 16px;
    }

    .detail-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 8px 0;
        border-bottom: 1px solid #f5f5f5;
        font-size: 0.82rem;
    }

    .detail-row:last-of-type { border-bottom: none; }

    .detail-label { color: #888; }
    .detail-value { font-weight: 600; color: #1d3557; text-align: right; }

    .btn-fiche {
        display: block;
        width: 100%;
        text-align: center;
        margin-top: 16px;
        padding: 10px;
        border: 2px solid #1d3557;
        border-radius: 10px;
        color: #1d3557 !important;
        font-weight: 600;
        font-size: 0.85rem;
        text-decoration: none !important;
        transition: all .2s;
    }

    .btn-fiche:hover {
        background: #1d3557;
        color: #fff !important;
    }

    /* Responsive */
    @media (max-width: 992px) {
        .chat-details { display: none; }
    }
    @media (max-width: 768px) {
        .chat-sidebar { display: none; }
        .chat-main { width: 100%; }
    }
</style>

<div class="chat-wrapper">

    {{-- ── COLONNE GAUCHE : liste des conversations ── --}}
    <div class="chat-sidebar">
        <div class="chat-sidebar-header">
            <h2>Messages</h2>
            <div class="chat-search">
                <i class="fas fa-search"></i>
                <input type="text" id="search-conv" placeholder="Rechercher une conversation...">
            </div>
        </div>

        <div class="conversations-list" id="conversations-list">
            @forelse($conversations as $conv)
                @php
                    $other = $conv->participant_id === Auth::id()
                        ? $conv->organizer
                        : $conv->participant;
                    $unread = $conv->unreadCount(Auth::id());
                    $last   = $conv->lastMessage;
                @endphp
                <a href="{{ route('chat.show', $conv) }}"
                   class="conversation-item {{ $conv->id === $conversation->id ? 'active' : '' }}">
                    <div class="conv-avatar">
                        <img src="{{ $other->avatar() }}" alt="{{ $other->firstname }}">
                        <span class="online-dot"></span>
                    </div>
                    <div class="conv-info">
                        <div class="conv-top">
                            <span class="conv-name">{{ $other->firstname }} {{ $other->lastname }}</span>
                            @if($last)
                                <span class="conv-time">{{ $last->created_at->format('H:i') }}</span>
                            @endif
                        </div>
                        <div class="conv-workshop">{{ $conv->workshop->name }}</div>
                        <div class="conv-last">
                            <span>
                                @if($last)
                                    @if($last->sender_id === Auth::id()) <span style="color:#B24592">Vous : </span> @endif
                                    {{ mb_strimwidth($last->body, 0, 30, '...') }}
                                @else
                                    <em>Aucun message</em>
                                @endif
                            </span>
                            @if($unread > 0)
                                <span class="conv-badge">{{ $unread }}</span>
                            @endif
                        </div>
                    </div>
                </a>
            @empty
                <div class="p-4 text-center text-muted">
                    <p>Aucune conversation.</p>
                </div>
            @endforelse
        </div>
    </div>

    {{-- ── COLONNE CENTRALE : messages ── --}}
    <div class="chat-main">
        {{-- Header --}}
        <div class="chat-main-header">
            <div class="chat-main-header-left">
                <div class="header-avatar">
                    <img src="{{ $otherUser->avatar() }}" alt="{{ $otherUser->firstname }}">
                    <span class="online-dot"></span>
                </div>
                <div class="header-user-info">
                    <h3>{{ $otherUser->firstname }} {{ $otherUser->lastname }}</h3>
                    <p class="workshop-name">{{ $workshop->name }}</p>
                    <p class="response-time">
                        <i class="far fa-clock"></i> Répond généralement en moins d'une heure
                    </p>
                </div>
            </div>
            <a href="{{ route('workshop.show', $workshop->slug) }}" class="btn-voir-atelier">
                Voir l'atelier
            </a>
        </div>

        {{-- Messages --}}
        <div class="chat-messages" id="messages-container">
            @forelse($messages as $message)
                @php $mine = $message->sender_id === Auth::id(); @endphp
                <div class="message-group">
                    <div class="message-bubble {{ $mine ? 'sent' : 'received' }}">
                        {{ $message->body }}
                    </div>
                    <div class="message-time {{ $mine ? 'sent' : '' }}">
                        {{ $message->created_at->format('H:i') }}
                    </div>
                </div>
            @empty
                <div class="text-center text-muted mt-5">
                    <i class="far fa-comment-dots fa-2x mb-2"></i>
                    <p>Démarrez la conversation !</p>
                </div>
            @endforelse
        </div>

        {{-- Zone d'envoi --}}
        <div class="chat-input-area">
            <form action="{{ route('chat.store', $conversation) }}" method="POST" class="chat-input-form">
                @csrf
                <input type="text" name="body" placeholder="Écrivez votre message..." autocomplete="off" required>
                <button type="submit" class="btn-send">
                    <i class="fas fa-paper-plane"></i> Envoyer
                </button>
            </form>
        </div>
    </div>

    {{-- ── COLONNE DROITE : détails atelier ── --}}
    <div class="chat-details">
        <h4>Détails de l'atelier</h4>

        {{-- Image atelier --}}
        <div class="workshop-img">
            @if($workshop->picture)
                <img src="{{ asset('storage/' . $workshop->picture) }}" alt="{{ $workshop->name }}">
            @else
                <i class="fas fa-image"></i>
            @endif
        </div>

        <div class="workshop-detail-name">{{ $workshop->name }}</div>

        <div class="detail-row">
            <span class="detail-label">Date</span>
            <span class="detail-value">
                {{ \Carbon\Carbon::parse($workshop->date)->translatedFormat('l j F Y') }}
            </span>
        </div>
        <div class="detail-row">
            <span class="detail-label">Horaire</span>
            <span class="detail-value">{{ $workshop->begining }} – {{ $workshop->end }}</span>
        </div>
        <div class="detail-row">
            <span class="detail-label">Prix</span>
            <span class="detail-value">{{ $workshop->price }} €</span>
        </div>
        <div class="detail-row">
            <span class="detail-label">Âge</span>
            <span class="detail-value">{{ $workshop->age_mini }} – {{ $workshop->age_maxi }} ans</span>
        </div>
        <div class="detail-row">
            <span class="detail-label">Places max</span>
            <span class="detail-value">{{ $workshop->effectif_max }}</span>
        </div>
        <div class="detail-row">
            <span class="detail-label">Ville</span>
            <span class="detail-value">{{ $workshop->city }}</span>
        </div>

        <a href="{{ route('workshop.show', $workshop->slug) }}" class="btn-fiche">
            Voir la fiche atelier
        </a>
    </div>
</div>

<script>
    // Scroll auto vers le bas
    const container = document.getElementById('messages-container');
    if (container) container.scrollTop = container.scrollHeight;

    // Recherche dans la liste de conversations
    document.getElementById('search-conv').addEventListener('input', function () {
        const q = this.value.toLowerCase();
        document.querySelectorAll('.conversation-item').forEach(item => {
            item.style.display = item.textContent.toLowerCase().includes(q) ? '' : 'none';
        });
    });

    // Polling toutes les 5 secondes
    let lastId = {{ $messages->last()?->id ?? 0 }};

    setInterval(async () => {
        try {
            const res = await fetch('{{ route('chat.poll', $conversation) }}?last_id=' + lastId, {
                headers: { 'X-Requested-With': 'XMLHttpRequest' }
            });
            const data = await res.json();
            if (data.messages && data.messages.length > 0) {
                data.messages.forEach(msg => {
                    const group = document.createElement('div');
                    group.className = 'message-group';
                    group.innerHTML = `
                        <div class="message-bubble ${msg.mine ? 'sent' : 'received'}">${msg.body}</div>
                        <div class="message-time ${msg.mine ? 'sent' : ''}">${msg.created_at}</div>
                    `;
                    container.appendChild(group);
                    lastId = msg.id;
                });
                container.scrollTop = container.scrollHeight;
            }
        } catch (e) {}
    }, 5000);
</script>

@endsection