@extends('master')


@push('styles')
<style>
    .search-container {
        display: flex;
        justify-content: end;
        align-items: center;
    }

    @media(max-width:768px){
        .search-bar{
            width: 200px !important;
        }
    }

    .notes-container {
        display: flex;
        flex-direction: column;
        gap: 20px;
        margin-top: 20px;
    }

    .notes-card {
        background-color: white;
        border-left: 4px solid var(--main);
        padding: 8px;
        display: flex;
        flex-direction: column;
        gap: 4px;
        border-radius: 8px;
        cursor: pointer;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
    }

    .notes-card:hover {
        background-color: gainsboro;
    }

    .notes-title {
        font-size: 20px;
        color: var(--second);
        font-weight: 600;
    }

    .notes-second-title {
        font-size: 16px;
        font-weight: 400;
    }

    .notes-description {
        white-space: nowrap;
        /* Mencegah teks turun ke baris baru */
        overflow: hidden;
        /* Menyembunyikan teks yang meluap */
        text-overflow: ellipsis;
        /* Memberikan efek titik-titik (...) */

        /* Opsional: Tentukan lebar maksimal jika card-nya tidak punya lebar tetap */
        max-width: 100%;
        display: block;
    }
        
    .notes-you{
        font-weight: 600;
    }

    .truncate-link {
        display: inline-block;
        max-width: 100%;
        /* Supaya tidak melebihi lebar card */
        width: fit-content;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        vertical-align: bottom;
        /* Agar sejajar dengan teks lain */
        color: #571a46;
        /* Warna tema kamu */
        text-decoration: none;
    }

    .truncate-link:hover {
        text-decoration: underline;
    }

    .notes-creator{
        text-align: end;
    }

    .search-btn:hover{
        background-color: var(--second) !important;
    }

    .note-reaction{
        display:flex;
        gap:8px;
        font-size: 12px;
    }
</style>

@endpush
@section('content')
<div class="search-container">
    <form action="{{ route('home') }}" method="GET">
        <div class="input-group">
            <input type="text" name="search" class="form-control search-bar" style="width:300px"
                placeholder="Cari judul atau streamer..."
                value="{{ request('search') }}"> 
                <button class="btn btn-primary search-btn" type="submit" style="background-color: var(--main); border:none;">
                    Cari
                </button>
        </div>
    </form>
</div>

<div class="notes-container">
    @forelse($notes as $note)

    <div class="notes-card" onclick="openNote('{{ $note->id }}')">
        <div style="display: flex;justify-content: space-between">
            <h1 class="notes-title" style="flex: 4;">{{ $note->title }}</h1>
            <span class="notes-creator" style="flex:1">Created by <span class="{{ auth()->id() == $note->user->user_id ? 'notes-you' : '' }}">{{ auth()->id() == $note->user->user_id ? "You" : $note->user->name }}</span></span>
        </div>
        <h2 class="notes-second-title">{{ $note->streamer_name }}</h2>
        <a class="truncate-link" href="{{ $note->stream_url }}" target="_blank" onclick="event.stopPropagation();">
            {{ $note->stream_url }}
        </a>
        <p class="notes-description">{{ $note->description }}</p>
        <div class="note-reaction">
            <p>Likes {{ $note->likes }}</p>
            <p>Dislikes {{ $note->dislikes }}</p>
        </div>
        <div style="display: flex;justify-content: space-between;font-size:12px">
            <span>
                @if ($note->created_at->ne($note->updated_at))
                    <i class="bi bi-calendar"></i>
                    updated at {{ $note->updated_at->diffForHumans() }}
                @endif
            </span>
            <span>
                <i class="bi bi-calendar"></i>
                created at {{ $note->created_at->diffForHumans() }}
            </span>
        </div>
    </div>
    @empty
    <h1 style="font-size:32px;">Notes tidak ditemukan</h1>

    @endforelse
</div>

<div style="margin-top: 20px;">
    {{ $notes->links() }}
</div>

@endsection

@push('scripts')
<script>
    function openNote(idNote) {
        window.location.href = "/notes/" + idNote;
    }
</script>
@endpush