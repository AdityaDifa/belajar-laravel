<style>
    .top-nav {
        background-color: var(--main);
        padding: 10px 80px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        position: sticky;
        top: 0;
        z-index: 1020;
    }

    .left-nav {
        display: flex;
        gap: 16px;
        align-items: center;
    }

    .right-nav {
        display: flex;
        gap: 24px;
        align-items: center;
    }

    .title-nav {
        font-size: 32px;
        font-weight: 800;
        color: var(--third);

        user-select: none;
        -webkit-user-select: none;
        -ms-user-select: none;
    }

    .navbar-link {
        font-size: 16px;
        color: white;
        font-weight: 400;
        cursor: pointer;
        transition: transform 0.1s ease-in-out;
    }

    .active-link {
        font-weight: 800;
        font-size: 16px;
        color: white;
        cursor: pointer;
        transition: transform 0.1s ease-in-out;

    }

    .navbar-link:hover,
    .active-link:hover {
        transform: scale(1.2)
    }

    #dropdownMenuProfileButton {
        background-color: var(--second);
        padding: 8px 16px;
        border-radius: 4px;
        color: white;

    }
</style>
<nav class="top-nav">
    <div class="left-nav">
        <h1 class="title-nav">Gudang Clipper</h1>
        <a class="{{Route::is('home') ? 'active-link' : 'navbar-link'  }}" href="{{ route('home') }}">Home</a>
        <a class="{{Route::is('create-note') ? 'active-link' : 'navbar-link'  }}" href="{{ route('createNote') }}">Create Note</a>
        <a class="{{Route::is('about') ? 'active-link' : 'navbar-link'  }}" href="{{ route('about') }}">About</a>
        <a class="{{Route::is('rules') ? 'active-link' : 'navbar-link'  }}" href="{{ route('rules') }}">Rules</a>
        <a class="{{Route::is('logs') ? 'active-link' : 'navbar-link'  }}" href="{{ route('logs') }}">Logs</a>
    </div>

    <div class="right-nav">
        @guest
        <a class="{{Route::is('register') ? 'active-link' : 'navbar-link'  }}" href="{{ route('register') }}">Register</a>
        <a class="{{Route::is('login') ? 'active-link' : 'navbar-link'  }}" href="{{ route('login') }}">Login</a>
        @endguest

        @auth
        <span style="color:white">Halo, {{ Auth::user()->profile->name }}!</span>

        <div class="dropdown">
            <button class="btndropdown-toggle" type="button" id="dropdownMenuProfileButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span>Profile Menu<i class="bi bi-chevron-double-down" style="margin-left: 4px;"></i></span>
            </button>

            <div class="dropdown-menu" aria-labelledby="dropdownMenuProfileButton">
                <a class="dropdown-item" href="{{ url('/profile/'. str_replace(" ","-",Auth::user()->profile->name)) }}">Profile</a>
                <a class="dropdown-item" href="#" id="btnLogout">Logout</a>

                <form id="logoutForm" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
        </div>
        @endauth
    </div>
</nav>

@push('scripts')
<script>
    $('#form-search-profile').on('submit', function(e) {
        e.preventDefault();
        let baseUrl = $(this).data('url');
        let nameSearch = $('#search-profile').val();

        if (nameSearch.trim() !== "") {
            let slug = nameSearch.toLowerCase()
                .trim()
                .replace(/\s+/g, '-');

            window.location.href = baseUrl + "/" + slug;
        }
    })

    //untuk logout
    $(document).ready(function(){
        $('#btnLogout').on('click', function(e){
            e.preventDefault();
            $('#logoutForm').submit();
        })
    })
</script>
@endpush