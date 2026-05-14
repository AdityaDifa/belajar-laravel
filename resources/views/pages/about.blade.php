@extends('master')

@push('styles')
<style>
    .about-title{
        font-size:64px;
        font-weight: 600;
        color:white;
    }
    .about-section{
        display: flex;
        flex-direction: column;
        gap: 20px;
        background-color: var(--second);
        padding: 20px;
        border-radius: 20px;
    }
    .about-section p{
        font-size:16px;
        color:white;
        text-align: justify;
    }

    .myself-section{
        display: flex;
        flex-direction: column;
        gap:20px;
        margin-top: 40px;
    }

    .myself-section h1, .support-section h1{
        font-size: 64px;
        color:var(--main);
        text-align: center;
    }
    #youtube-icon{
        width: 150px;
        transition: width 0.5s ease-in-out;
    }

    #youtube-icon:hover{
        width:180px;
        cursor: pointer;
    }

    .support-section{
        display: flex;
        flex-direction: column;
        gap:20px;
        margin-top: 80px;
    }

</style>
@endpush

@section('content')
    <div class="about-section">
        <h1 class="about-title">About this Website</h1>
        <p>Hallo perkenalkan nama aku Gose Clip, aku dulunya seorang clipper tetapi setelah lulus kuliah kini menjadi programmer.
            Jujur sangat disayangkan kalau channel yang sudah dibangun selama 2 tahun dibiarkan begitu saja karena sudah tidak ada waktu
            untuk membuat clip seperti dulu. Oleh sebab itu, website ini dibuat supaya para clipper dapat langsung membuat clip
            tanpa mencari tahu momen atau menonton full satu stream yang panjang. Disini kalian juga dapat berbagi catatan antar clipper 
            ataupun menaruh timestamp streamer favorit kalian disini supaya dapat digunakan untuk mediashare ataupun untuk di edit jadi clip oleh para clipper.
        </p>
        <p>
            Website ini dibuat juga sebagai portofolio saya supaya sebagai bukti bahwa saya memiliki kompetensi sebagai programmer :v (pls hire me)
        </p>
        <p style="margin-top: 12px;">
            Semoga dari website yang saya bangun ini dapat bermanfaat bagi semua pihak dan silahkan hubungi saya jika terdapat masalah pada website ini
        </p>
    </div>

    <div class="myself-section">
        <h1>About the Creator</h1>
        <div style="display: flex;gap:60px;justify-content:center">
            <img src="{{ asset('images/icons/youtube-icon.svg') }}" alt="youtube-icon" id="youtube-icon">
        </div>
    </div>

    <div class="support-section">
        <h1>Support Me</h1>
        <div style="display: flex; gap: 12px;justify-content:center">
            <p style=" color:#571a46;font-size:16px">Kalian bisa support saya melalui </p>
            <a style=" color:#571a46;font-size:16px;" href="https://saweria.co/goseclips" target="_blank">Click Me</a>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    $('#youtube-icon').on('click', function(){
        window.open('https://www.youtube.com/@GoseClips', '_blank');
    })
</script>
@endpush