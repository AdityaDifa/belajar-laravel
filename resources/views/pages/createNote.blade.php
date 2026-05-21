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

    @media(max-width:768px){
        .note-form{
            width: 100%;
            padding:12px;
        }
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
    <form class="note-form" action="{{ route('createNote') }}" method="POST">
        @csrf

        <h1 style="text-align: center;">Create Notes Form</h1>

        <div class="input-form">
            <label for="title" class="form-label">Title/Judul</label>
            <input type="text" class="form-control" name="title" id="title" value="{{ old('title') }}" placeholder="Title/ Judul" maxlength="255" required>
        </div>

        <div class="input-form">
            <label for="streamer_name" class="form-label">streamer name</label>
            <input type="text" class="form-control" name="streamer_name" id="streamer_name" value="{{ old('streamer_name') }}" placeholder="streamer name/ nama streamer(tidak perlu masukan nama agensi)" maxlength="255" required>
        </div>

        <div class="input-form">
            <label for="stream_url" class="form-label">stream url</label>
            <input type="text" class="form-control" name="stream_url" id="stream_url" value="{{ old('stream_url') }}" placeholder="stream url/ link stream" required maxlength="255">
            <span id="url-error" style="color: #ff4d4d; font-size: 0.8rem; display: none;">
                URL harus berasal dari YouTube (youtube.com atau youtu.be)
            </span>
        </div>

        <div class="input-form">
            <label for="description" class="form-label">description</label>
            <textarea class="form-control" name="description" id="description" placeholder="description" required maxlength="2000">{{ old('description') }}</textarea>
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
    $(document).ready(function() {
        function validateNormalInput(idInput) {
            return $(`#${idInput}`).val().trim() !== "";
        }

        function validateStreamURL() {
            const inputStreamURL = $('#stream_url');
            const youtubeRegex = /^(https?:\/\/)?(www\.)?(youtube\.com|youtu\.be)\/.+$/;
            const errorMessage = $('#url-error');

            const isValid = youtubeRegex.test(inputStreamURL.val().trim());
            errorMessage.css('display', isValid ? 'none' : 'block');

            if (isValid) {
                return true;
            } else {
                return false;
            }
        }

        function validateDescription() {
            const descriptionInput = $('#description');
            const descriptionErrorMessage = $('#desc-error');
            const linkRegex = /(https?:\/\/[^\s]+)|(www\.[^\s]+)|([^\s]+\.(com|net|org|id|io))/gi;

            const isValid = linkRegex.test(descriptionInput.val().trim());
            descriptionErrorMessage.css('display', isValid ? 'block' : 'none'); //berbalik dengan validateStreamUrl

            if (isValid) {
                return false;
            } else {
                return true;
            }
        }

        $('#title, #streamer_name, #stream_url, #description').on('blur', function() {
            const submitButton = $('#submitButton');

            if (validateNormalInput('title') && validateNormalInput('streamer_name') && validateStreamURL() && validateDescription()) {
                submitButton.prop('disabled', false);
            } else {
                submitButton.prop('disabled', true);
            }
        })
    })
</script>
@endpush