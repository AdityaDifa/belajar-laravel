@extends('master')

@push('styles')
    <style>
        .main-section{
            display: flex;
            gap: 8px;
            padding: 20px;
            background-color: white;
            border-radius: 8px;
            border:1px solid var(--light-gray);
            box-shadow:0 4px 12px rgba(0, 0, 0, 0.08);
        }

        .detail-profile{
            display:flex;
            flex-direction: column;
            gap:20px;
            padding:8px;
            flex:1
        }

        .detail-list{
            flex:2;
            box-shadow:0 4px 12px rgba(0, 0, 0, 0.08);
            padding:4px;
            border-radius: 4px;
            font-size: 16px;
            color:var(--main);
        }
    </style>
@endpush

@section('content')
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
@endpush