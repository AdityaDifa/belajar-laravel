@extends('master')

@push('styles')
<style>
    .detail-container {
        background-color: white;
        padding: 20px;
        margin-top: 20px;
        color: var(--main);
        border-radius: 8px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
    }

    .table-detail {
        width: 100%;
    }

    .table-detail tr {
        border: 1px solid var(--main);
    }

    .table-detail tr td {
        padding: 4px;
    }
</style>
@endpush

@section('content')

@if (session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif


<div class="detail-container">
    <table class="table-detail">
        <tr>
            <td>
                <h1 style="font-size: 24px;font-weight:600">{{ $note->title }}</h1>
            </td>
        </tr>
        <tr>
            <td>
                <h2 style="font-size: 16px;">Streamer : {{ $note->streamer_name }}</h2>
            </td>
        </tr>
        <tr>
            <td>
                <h2 style="font-size: 16px;">Created by : {{ $note->user->name }}</h2>
            </td>
        </tr>
        <tr>
            <td>
                <p>Link : <a href="{{ $note->stream_url }}" target="_blank" style="color: #B33791;text-decoration:underline">{{ $note->stream_url }}</a></p>
            </td>
        </tr>
        <tr>
            <td>
                <p style="white-space: pre-line; padding: 4px; border: 1px solid white;border-radius:4px;margin-top:2px">{{ $note->description }}
                </p>
            </td>
        </tr>
    </table>

    <div style="display: flex;justify-content: space-between;">
        <p>
            @if ($note->created_at->ne($note->updated_at))
            updated at {{ $note->updated_at->diffForHumans() }}
            @endif
        </p>
        <p>created at {{ $note->created_at->diffForHumans() }}</p>
    </div>

    @if(auth()->check() && auth()->id() == $note->user_id)
    <div style="display: flex; gap:8px;margin-top:20px">
        <button id="editNote" type="button" class="btn btn-primary" onclick="editNote('{{ $note->id }}')">Edit</button>
        <button id="deleteNote" type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal">Delete</button>
    </div>
    @endif
</div>



<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Apakah kamu yakin ingin menghapus catatan ini? Tindakan ini tidak bisa dibatalkan.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>

                <form action="{{ route('note.delete', $note->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <button type="submit" class="btn btn-danger">Ya, Hapus Sekarang</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    function editNote(idNote) {
        window.location.href = "/edit-note/" + idNote;
    }

    function deleteNote(idNote) {

    }
</script>
@endpush