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

    @media(max-width:768px) {
        .datetime-container {
            flex-direction: column;
            gap: 4px;
            /* align-items: end; */
            margin-top: 8px;
        }
    }
</style>
@endpush

@section('content')

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
                <h2 style="font-size: 16px;">Created by : <a style="color: var(--second);text-decoration:underline" href="{{ url('/profile/'.str_replace(' ','-',$note->user->name)) }}">{{ $note->user->name }}</a></h2>
            </td>
        </tr>
        <tr>
            <td>
                <p>Link : <a href="{{ $note->stream_url }}" target="_blank" style="color: var(--second);text-decoration:underline">{{ $note->stream_url }}</a></p>
            </td>
        </tr>
        <tr>
            <td>
                <p style="white-space: pre-line; padding: 4px; border: 1px solid white;border-radius:4px;margin-top:2px">{{ $note->description }}
                </p>
            </td>
        </tr>
    </table>

    <div class="datetime-container" style="display: flex;justify-content: space-between;font-size:12px">
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

    <div style="display: flex;justify-content:space-between; margin-top:20px;align-items:center">
        <div style="display: flex; gap: 8px;">
            @if(auth()->check() && auth()->id() == $note->user_id)
            <button id="editNote" type="button" class="btn btn-primary" onclick="editNote('{{ $note->id }}')">Edit</button>
            <button id="deleteNote" type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal">Delete</button>
            @endif
        </div>
        <div style="font-size:16px">
            @if(auth()->check() && auth()->id() == $note->user_id)
            <button class="like-button" onclick="likeReaction('{{ $note->id }}')"><i class="bi {{ $note->likes_exists ?  'bi-hand-thumbs-up-fill' : 'bi-hand-thumbs-up'}}"></i>
                <p>{{ $note->likes }}</p>
            </button>
            <button class="dislike-button" onclick="dislikeReaction('{{ $note->id }}')"><i class="bi {{ $note->dislikes_exists ?  'bi-hand-thumbs-down-fill' : 'bi-hand-thumbs-down'}}"></i>
                <p>{{ $note->dislikes }}</p>
            </button>
            @endif
            @guest
            <p>{{ $note->likes }} likes</p>
            <p>{{ $note->dislikes }} dislikes</p>
            @endguest
        </div>
    </div>
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

                <form action="{{ url('/delete-note/'.$note->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Ya, Hapus Sekarang</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    const likeButton = $('.like-button');
    const dislikeButton = $('.dislike-button');

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            'Accept': 'application/json'
        }
    });

    function editNote(idNote) {
        window.location.href = "/edit-note/" + idNote;
    }

    function likeReaction(idNote) {
        $.ajax({
            url: `/api/notes/${idNote}/like`,
            type: 'POST',
            dataType: 'json',
            beforeSend: function() {
                likeButton.prop('disabled', true);
                likeButton.css('opacity', 0.6);
            },
            success: function(response) {
                console.log('success=', response.condition)
                likeButton.find('p').text(response.like_count);
                dislikeButton.find('p').text(response.dislike_count);
                dislikeButton.find('i').removeClass('bi-hand-thumbs-down-fill').addClass('bi-hand-thumbs-down');
                if (response.condition) {
                    likeButton.find('i').removeClass('bi-hand-thumbs-up').addClass('bi-hand-thumbs-up-fill')
                } else {
                    likeButton.find('i').removeClass('bi-hand-thumbs-up-fill').addClass('bi-hand-thumbs-up')
                }
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            },
            complete: function() {
                likeButton.prop('disabled', false);
                likeButton.css('opacity', 1);
            }
        })
    }

    function dislikeReaction(idNote) {

        $.ajax({
            url: `/api/notes/${idNote}/dislike`,
            type: 'POST',
            dataType: 'json',
            beforeSend: function() {
                dislikeButton.prop('disabled', true);
                dislikeButton.css('opacity', 0.6);
            },
            success: function(response) {
                console.log('success=', response.condition)
                dislikeButton.find('p').text(response.dislike_count);
                likeButton.find('p').text(response.like_count);
                likeButton.find('i').removeClass('bi-hand-thumbs-up-fill').addClass('bi-hand-thumbs-up')
                if (response.condition) {
                    dislikeButton.find('i').removeClass('bi-hand-thumbs-down').addClass('bi-hand-thumbs-down-fill')
                } else {
                    dislikeButton.find('i').removeClass('bi-hand-thumbs-down-fill').addClass('bi-hand-thumbs-down')
                }
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            },
            complete: function() {
                dislikeButton.prop('disabled', false);
                dislikeButton.css('opacity', 1);
            }
        })
    }
</script>
@endpush