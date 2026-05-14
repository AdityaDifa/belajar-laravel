<style>
    #successNotification,
    #errorNotification {
        display: flex;
        justify-content: space-between;
        align-items: start
    }
</style>

@if (session('success'))
<div id="successNotification" class="alert alert-success mt-2 mb-2">
    <div>
        {{ session('success') }}
    </div>
    <button id="closeSuccessNotification" class="btn btn-success">x</button>
</div>
@endif

@if ($errors->any())
<div id="errorNotification" class="alert alert-danger mt-2 mb-2">
    <div>
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    <button id="closeFailedNotification" class="btn btn-danger">x</button>
</div>
@endif

@push('scripts')
<script>
    $(document).ready(function() {
        $('#closeSuccessNotification').on('click', function(e) {
            e.preventDefault();
            $('#successNotification').fadeOut(300);
        });

        $('#closeFailedNotification').on('click', function(e) {
            e.preventDefault();
            $('#errorNotification').fadeOut(300);
        })
    })
</script>
@endpush