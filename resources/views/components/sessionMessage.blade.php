@if (session('success'))
<div class="alert alert-success mt-2 mb-2">
    {{ session('success') }}
</div>
@endif

@if ($errors->any())
<div class="alert alert-danger mt-2 mb-2">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif