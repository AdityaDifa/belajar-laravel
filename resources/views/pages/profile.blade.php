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
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        padding: 4px;
        border-radius: 4px;
        font-size: 16px;
        color: var(--main);
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
</style>
@endpush

@section('content')
<div style="display: flex;justify-content:end;align-items:center;gap:16px">
    @if($countNotes > 0)
    <a href="{{ url('/profile/notes/'. str_replace(" ","-",$profile->name)) }}">Notes<i class="bi bi-card-list" style="margin-left:4px"></i></a>
    @endif
    @auth
    <a href="{{ url('/profile/edit/'. str_replace(" ","-",Auth::user()->profile->name)) }}">Edit <i class="bi bi-pencil"></i></a>
    @endauth
</div>
<section class="main-section">
    <div class="img-profile">

    </div>

    <div class="detail-profile">
        <div class="detail-list">
            <p>Name : {{ $profile->name }}</p>
        </div>

        <div class="detail-list">
            <p>title : {{ $profile->title }}</p>
        </div>

        <div class="detail-list" style="display: flex;gap:4px;align-items:start">
            <p>Bio : </p>
            <p style="white-space: pre-line;">{{ $profile->bio }}</p>
        </div>
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