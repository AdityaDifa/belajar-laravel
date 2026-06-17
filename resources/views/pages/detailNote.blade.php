@extends('master')

@push('styles')
<style>
    .detail-container,
    .comments-container {
        background-color: white;
        padding: 20px;
        margin-top: 20px;
        color: var(--main);
        border-radius: 8px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
    }

    .comments-container {
        display: flex;
        gap: 12px;
        flex-direction: column;
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

    .comment-input {
        display: flex;
        flex-direction: column;
        gap: 8px;
    }

    .comment-item-name-section {
        display: flex;
        gap: 8px;
        align-items: center
    }

    .comment-item-username {
        background-color: var(--main);
        color: white;
        padding: 8px;
        border-radius: 8px 8px 0 0;
        max-width: 150px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .comment-item-content-section {
        background-color: var(--light-gray);
        padding: 8px;
        border-radius: 0 8px 8px 8px;

    }

    .comment-item-edit-section {
        display: flex;
        gap: 8px;
    }

    .delete-comment {
        color: red;
        transition: transform 0.3s ease;
        background-color: transparent;
    }

    .delete-comment:hover {
        transform: scale(1.25);
    }

    .comments-items-container {
        display: flex;
        gap: 12px;
        overflow: auto;
        max-height: 400px;
        flex-direction: column;
        border-radius: 20px;
        border: 1px solid black;
        padding: 8px;
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

<div class="comments-container">
    <h1 style="font-size: 32px;">Comments</h1>

    <div class="comments-items-container">
        @forelse ($note->comments as $comment)
        <div class="comment-item">
            <div class="comment-item-name-section">
                <p class="comment-item-username"><strong>{{ $comment->user->name }}</strong></p>
                <p class="format-date" data-date="{{ $comment->created_at }}"></p>
            </div>

            <div class="comment-item-content-section">
                <p>{{ $comment->comment }}</p>
            </div>

            @if (auth()->check() && auth()->id() == $comment->user_id)
            <div class="comment-item-edit-section">
                <button class="delete-comment" data-bs-toggle="modal" data-bs-target="#deleteCommentModal" data-id-comment="{{ $comment->id }}" onclick="setIdCommentDelete(this)">Delete</button>
            </div>
            @endif
        </div>
        @empty
        <p class="text-muted">There are no comments yet. Be the first to comment!</p>
        @endforelse
    </div>

    <div class="comment-input">
        <textarea name="comment-input" id="commentInput" style="padding:8px;height:200px" placeholder="input your comments"></textarea>
        <button id="sendCommentButton" class="btn btn-primary" onclick="sendComment(event)">Comment</button>
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

<div class="modal fade" id="deleteCommentModal" tabindex="-1" aria-labelledby="deleteCommentModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteCommentModalLabel">Konfirmasi Hapus</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Apakah kamu yakin ingin menghapus comment ini? Tindakan ini tidak bisa dibatalkan.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-danger" onclick="confirmDeleteComment()">Ya, Hapus Sekarang</button>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $('.format-date').each(function() {
            const tanggalMentah = $(this).data('date');
            const tanggalRapi = formatTanggal(tanggalMentah);

            $(this).text(tanggalRapi);
        });
    });

    const likeButton = $('.like-button');
    const dislikeButton = $('.dislike-button');

    const idNote = "{{ $note->id }}";

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

    function setIdCommentDelete(el) {
        const modalDeleteComment = $('#deleteCommentModal');
        const idComment = $(el).data('id-comment');

        modalDeleteComment.data('id-comment', idComment);

        console.log(idComment)
    }

    function confirmDeleteComment() {
        const deleteCommentModal = $('#deleteCommentModal');
        const idComment = deleteCommentModal.data('id-comment');

        $.ajax({
            url: `/api/notes/comment/delete/${idComment}`,
            type: 'DELETE',
            success: function(response) {
                deleteCommentModal.modal('hide');
                console.log(response)
                refreshComment()
            },
            error: function(xhr) {
                console.log(xhr)
            }
        })
    }

    function refreshComment() {
        $.ajax({
            url: `/api/notes/comment/${idNote}`,
            type: 'GET',
            success: function(response) {
                let commentHTML = '';
                const userId = response.userId;
                response.data.forEach(function(comment) {
                    commentHTML += templateComment(comment, userId);
                    $('.comments-items-container').html(commentHTML);
                });
            }
        })
    }

    function templateComment(comment, userId) {
        const date = formatTanggal(comment.created_at);

        return `
            <div class="comment-item">
            <div class="comment-item-name-section">
                <p class="comment-item-username"><strong>${comment.user.name}</strong></p>
                <p>${date}</p>
            </div>

            <div class="comment-item-content-section">
                <p>${comment.comment}</p>
            </div>

            ${userId == comment.user_id ? `
                <div class="comment-item-edit-section">
                    <button class="delete-comment" data-bs-toggle="modal" data-bs-target="#deleteCommentModal" data-id-comment="${comment.id}" onclick="setIdCommentDelete(this)">Delete</button>
                </div>
            ` : ''}
        </div>
        `
    }

    function sendComment(e){
        e.preventDefault();

        const comment = $('#commentInput').val();
        const sendButton = $('#sendCommentButton');

        if(comment.trim() === ''){
            alert('MASUKAN PESAN COMMENT');
            return;
        }

        $.ajax({
            url:`/api/note/comment/post/${idNote}`,
            type:'POST',
            data:{
                comment:comment
            },
            beforeSend:function(){
                sendButton.prop('disabled', true);
            },
            success:function(response){
                refreshComment();
            },
            error:function(xhr){
                console.log(xhr);
            },
            complete:function(){
                $('#commentInput').val('');

                sendButton.prop('disabled', false);
            }
        })
    }

    function formatTanggal(stringTanggal) {
        const opsi = {
            year: 'numeric',
            month: 'short',
            day: 'numeric',
            hour: '2-digit',
            minute: '2-digit'
        };
        return new Date(stringTanggal).toLocaleDateString('id-ID', opsi);
        // Outputnya nanti rapi seperti: 17 Juni 2026, 21:57
    }
</script>
@endpush