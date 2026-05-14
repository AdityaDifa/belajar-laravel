@extends('master')

@push('styles')
<style>
    .main-section {
        display: flex;
        gap: 8px;
        padding: 20px;
        background-color: white;
        border-radius: 8px;
        border: 1px solid var(--light-gray);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
    }

    .detail-profile {
        display: flex;
        flex-direction: column;
        gap: 20px;
        padding: 8px;
        flex: 1
    }

    .detail-list {
        flex: 2;
        display:flex;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        padding: 4px;
        border-radius: 4px;
        font-size: 16px;
        color: var(--main);
        align-items:center;
        gap:8px;
    }

    .detail-list p{
        margin:0;
        white-space:nowrap;
        width:80px;
        flex-shrink:0;
    }

    .detail-list input,.detail-list textarea{
        flex-grow:1;
    }

    .img-profile {
        font-size: 64px;
        border-radius: 99px;
        display: flex;
        justify-content: center;
        align-items: center;
        background-color: var(--second);
        width: 128px;
        height: 128px;
        color: white;
    }

    #submitEditButton{
        background-color:var(--main);
        padding:4px;
        border-radius:4px;
        color:white;
        margin-top:8px;
        width:64px;
    }

    #submitEditButton:hover{
        background-color:var(--second);
    }
</style>
@endpush

@section('content')
<section class="main-section">
    <div class="img-profile">

    </div>

    <div class="detail-profile">
        <form action="{{ route('profile.submitEdit', str_replace(' ','-',$profile->name)) }}" method="POST">
            @csrf
            @method('PATCH')
            <div class="detail-list">
                    <p>Name : </p>
                    <input style="width: 100%;" type="text" value="{{ $profile->name }}" name="name" required>
            </div>
    
            <div class="detail-list">
                    <p>title : </p>
                    <input style="width: 100%;" type="text" value="{{ $profile->title }}" name="title">
            </div>
    
            <div class="detail-list" style="align-items:start">
                    <p>Bio : </p>
                    <textarea style="width:100%;height:200px" name="bio" id="bio" maxlength="2000">{{ $profile->bio }}</textarea>
            </div>

            <div style="display: flex;justify-content:end">
                <button id="submitEditButton" type="submit">
                    Edit
                </button>
            </div>
        </form>
    </div>


</section>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        //ambil nama lewat link
        var path = window.location.pathname;
        var parts = path.split('/');
        var name = parts[parts.length - 1];

        var initials = name.substring(0, 2).toUpperCase();
        $('.img-profile').text(initials);
    })
</script>
@endpush