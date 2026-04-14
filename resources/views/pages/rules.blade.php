@extends('master')

@push('styles')
<style>
    .rules-container{
        display: flex;
        flex-direction: column;
        align-items: center;
    }
    .rules-title{
        border-radius: 8px;
        background-color: #DB8DD0;
        padding: 20px;
    }
    
    .rules-title h1{
        font-weight: 600;
        color: #571a46;
        font-size: 64px;
    }

    table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0 10px; /* Memberi jarak antar baris */
        background-color: #f9f9f9; /* Background tipis agar kontras */
        padding: 15px;
        border-radius: 8px;
        margin-top: 12px;
    }

    td {
        padding: 10px 15px;
        background-color: white;
        border-left: 4px solid #571a46; /* Garis aksen ungu khas Clipper di kiri */
        border-radius: 4px;
        color: #333;
        font-size: 0.95rem;
        line-height: 1.6;
        box-shadow: 0 2px 4px rgba(0,0,0,0.05); /* Shadow halus */
    }
</style>

@endpush

@section('content')
    <div class="rules-container">
        <div class="rules-title">
            <h1>Rules</h1>
        </div>

        <table border="0">
            <tbody>
                <tr>
                    <td>1. Website ini hanya untuk menampung kumpulan catatan klip/timestamp suatu stream(Saat ini hanya untuk youtube saja)</td>
                </tr>
                <tr>
                    <td>
                        2. Tidak boleh menggunakan kata - kata yang tidak layak seperti rasisme, berbau sara, 18+, dan semacamnya
                    </td>
                </tr>
                <tr>
                    <td>
                        3. Mohon untuk saling menghormati sesama pengguna disini
                    </td>
                </tr>
                <tr>
                    <td>
                        4. Website ini masih dalam tahapan pengembangan dan mohon dimaklumi bilamana terdapat bug ataupun error yang tidak diinginkan
                    </td>
                </tr>
                <tr>
                    <td>
                        5. Siapapun yang mencoba merusak dan melanggar aturan yang ada maka akun akan dihapus dan pengguna tidak akan bisa menggunakan website ini lagi
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
@endsection