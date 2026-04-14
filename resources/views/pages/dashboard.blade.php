@extends('master')


@push('styles')
<style>
    .search-container {
        display: flex;
        justify-content: end;
    }

    .notes-container {
        display: flex;
        flex-direction: column;
        gap: 20px;
        margin-top: 20px;
    }

    .notes-card {
        background-color: #DB8DD0;
        border-left: 4px solid #571a46;
        padding: 8px;
        display: flex;
        flex-direction: column;
        gap: 8px;
        border-radius: 8px;
        cursor: pointer;
    }

    .notes-card:hover {
        background-color: #C562AF;
    }

    .notes-title {
        font-size: 24px;
        color: #571a46;
        font-weight: 600;
    }

    .notes-second-title {
        font-size: 20px;
        font-weight: 400;
    }

    .card-description {
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
</style>

@endpush
@section('content')
<div class="search-container">
    <form action="{{ route('home') }}" method="GET">
        <div class="input-group">
            <input type="text" name="search" class="form-control" style="width:300px"
                placeholder="Cari judul atau streamer..."
                value="{{ request('search') }}"> <button class="btn btn-primary" type="submit" style="background-color: #571a46; border:none;">
                Cari
        </div>
    </form>
</div>

@if (session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

<div class="notes-container">
    @forelse($notes as $note)

    <div class="notes-card" onclick="openNote('{{ $note->id }}')">
        <h1 class="notes-title">{{ $note->title }}</h1>
        <h2 class="notes-second-title">{{ $note->streamer_name }}</h2>
        <a class="truncate-link" href="{{ $note->stream_url }}" target="_blank" onclick="event.stopPropagation();">
            {{ $note->stream_url }}
        </a>
        <p class="card-description">{{ $note->description }}</p>
    </div>
    @empty
    <h1 style="font-size:32px;">Notes tidak ditemukan</h1>

    @endforelse
</div>

<div class="d-flex justify-content-center mt-4">
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