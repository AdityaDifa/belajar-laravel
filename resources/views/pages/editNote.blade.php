@extends('master')

@push('styles')
<style>
    .note-container {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        width: 100%;
    }


    .note-form {
        display: flex;
        flex-direction: column;
        gap: 20px;
        background-color: white;
        border-radius: 4px;
        border: 1px solid #571a46;
        padding: 20px;
        width: 80%;
    }

    #description {
        min-height: 200px;
        padding: 12px 15px;
        border-radius: 4px;
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        width: 100%;
        gap: 8px;
    }
</style>
@endpush

@section('content')
<div class="note-container">
    <form class="note-form" action="{{ route('note.editNote', $note->id) }}" method="POST">
        @csrf
        @method('PUT')

        <h1 style="text-align: center;">Edit Notes Form</h1>

        @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif

        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <div class="input-form">
            <label for="title" class="form-label">Title/Judul</label>
            <input type="text" class="form-control" name="title" id="title" value="{{ $note->title }}" placeholder="Title/ Judul" maxlength="255" required>
        </div>

        <div class="input-form">
            <label for="streamer_name" class="form-label">streamer name</label>
            <input type="text" class="form-control" name="streamer_name" id="streamer_name" value="{{ $note->streamer_name }}" placeholder="streamer name/ nama streamer(tidak perlu masukan nama agensi)" maxlength="255" required>
        </div>

        <div class="input-form">
            <label for="stream_url" class="form-label">stream url</label>
            <input type="text" class="form-control" name="stream_url" id="stream_url" value="{{ $note->stream_url }}" placeholder="stream url/ link stream" required>
            <span id="url-error" style="color: #ff4d4d; font-size: 0.8rem; display: none;">
                URL harus berasal dari YouTube (youtube.com atau youtu.be)
            </span>
        </div>

        <div class="input-form">
            <label for="description" class="form-label">description</label>
            <textarea class="form-control" name="description" id="description" placeholder="description" required>{{ $note->description }}</textarea>
            <span id="desc-error" style="color: red; font-size: 0.8rem; display: none;">
                Deskripsi tidak diperbolehkan mengandung link/URL!
            </span>
        </div>

        <button id="submitButton" class="btn btn-primary" type="submit" disabled>Submit</button>
    </form>
</div>
@endsection

@push('scripts')
<script>
    const urlInput = document.getElementById('stream_url');
    const errorMsg = document.getElementById('url-error');
    const submitBtn = document.getElementById('submitButton');

    urlInput.addEventListener('input', function() {
        const url = this.value;
        const youtubeRegex = /^(https?:\/\/)?(www\.)?(youtube\.com|youtu\.be)\/.*$/;

        if (url === "") {
            errorMsg.style.display = 'none';
            submitBtn.disabled = true;
        } else if (!youtubeRegex.test(url)) {
            errorMsg.style.display = 'block';
            submitBtn.disabled = true;
        } else {
            errorMsg.style.display = 'none';
            submitBtn.disabled = false;
        }
    })

    const descInput = document.getElementById('description');
    const descErrorMsg = document.getElementById('desc-error');

    descInput.addEventListener('input', function() {
        const text = this.value;
        // Regex untuk mendeteksi pola link (http, https, www, atau akhiran domain umum)
        const linkRegex = /(https?:\/\/[^\s]+)|(www\.[^\s]+)|([^\s]+\.(com|net|org|id|io))/gi;

        if (linkRegex.test(text)) {
            descErrorMsg.style.display = 'block';
            submitBtn.disabled = true;
        } else {
            descErrorMsg.style.display = 'none';
            // Hanya aktifkan tombol jika url_streamer juga sudah valid (opsional, tergantung logika kamu)
            submitBtn.disabled = false;
        }
    });
</script>
@endpush