@extends('master')

@push('styles')
<style>
    .update-container {
        padding-left: 20px;
        border-left: 2px solid #571a46;
        /* Warna garis ungu kamu */
        margin-left: 10px;
        display: flex;
        flex-direction: column-reverse;
        gap:20px;
    }

    .update-item {
        position: relative;
        padding-left: 20px;
    }

    .dot {
        position: absolute;
        left: -31px;
        /* Sesuaikan agar pas di tengah garis */
        top: 5px;
        width: 20px;
        height: 20px;
        background-color: #571a46;
        border: 4px solid #fff;
        /* Biar ada jarak antara lingkaran dan garis */
        border-radius: 50%;
    }

    .undot {
        position: absolute;
        left: -31px;
        /* Sesuaikan agar pas di tengah garis */
        top: 5px;
        width: 20px;
        height: 20px;
        background-color: white;
        border: 4px solid #fff;
        /* Biar ada jarak antara lingkaran dan garis */
        border-radius: 50%;
    }

    .update-item:last-child {
        margin-bottom: 0;
    }
</style>
@endpush

@section('content')
<div class="update-container">
    <div class="update-item">
        <div class="undot"></div>
        <div class="content">
            <small class="text-muted">14 April 2026</small>
            <h6>Update Alpha Version 0.1.0 First Release</h6>
            <p>Fitur masih sangat basic dan sangat terbatas</p>
        </div>
    </div>

    <div class="update-item">
        <div class="undot"></div>
        <div class="content">
            <small class="text-muted">14 Mei 2026</small>
            <h6>Alpha Version 0.2.0 Adding Feature</h6>
            <p>Memperbaiki desain, dan menambah fitur yang berhubungan dengan profile </p>
        </div>
    </div>

    <div class="update-item">
        <div class="undot"></div>
        <div class="content">
            <small class="text-muted">18 Mei 2026</small>
            <h6>Alpha Version 0.3.0 Adding Feature</h6>
            <p>Menambah fitur lupa password </p>
        </div>
    </div>

    <div class="update-item">
        <div class="undot"></div>
        <div class="content">
            <small class="text-muted">21 Mei 2026</small>
            <h6>Alpha Version 0.4.0 Adding Feature</h6>
            <p>Membuat UI untuk mode mobile </p>
        </div>
    </div>

    <div class="update-item">
        <div class="dot"></div>
        <div class="content">
            <small class="text-muted">4 Juni 2026</small>
            <h6>Alpha Version 0.5.0 Adding Feature</h6>
            <p>Menambah fitur like, dislike, dan comment </p>
        </div>
    </div>

    <div class="update-item">
        <div class="undot"></div>
        <div class="content">
            <small class="text-muted">Next Update</small>
            <h6>Alpha Version 1.0.0 Release</h6>
            <p>Release stable version</p>
        </div>
    </div>
</div>
@endsection