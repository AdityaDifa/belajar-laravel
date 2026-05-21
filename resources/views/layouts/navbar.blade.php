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
        justify-content: end;
    }

    @media(max-width: 768px) {
        .top-nav {
            padding: 4px 12px;
            top: -1px;
        }

        .left-nav a,
        .left-nav .title-nav {
            display: none;
        }

        .right-nav {
            gap: 12px;
            flex: 1
        }

        #dropdownMenuProfileButton p {
            display: none
        }

        #sidebarButton {
            display: block !important;
            background-color: var(--main);
            color: white;
            font-size: 24px;
            transition: transform 0.3s ease;
        }

        .rotate-90 {
            transform: rotate(90deg);
        }
    }

    .title-nav {
        font-size: 32px;
        font-weight: 800;
        color: var(--third);

        user-select: none;
        -webkit-user-select: none;
        -ms-user-select: none;
    }

    #sidebarButton {
        display: none;
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
        <button id="sidebarButton"><i class="bi bi-list"></i></button>

        <h1 class="title-nav">Gudang Clipper</h1>
        <a class="{{Route::is('home') ? 'active-link' : 'navbar-link'  }}" href="{{ route('home') }}">Home</a>
        <a class="{{Route::is('createNote') ? 'active-link' : 'navbar-link'  }}" href="{{ route('createNote') }}">Create Note</a>
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
                <span style="display:flex;gap:4px">
                    <p>Profile Menu</p><i class="bi bi-chevron-double-down" style="margin-left: 4px;"></i>
                </span>
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
    $(document).ready(function() {
        $('#btnLogout').on('click', function(e) {
            e.preventDefault();
            $('#logoutForm').submit();
        })
        
        //untuk sidebar
        $('#sidebarButton').on('click', function(e) {
            e.preventDefault();
            $('aside').toggle('slide', {
                direction: 'left'
            }, 400);
            $(this).toggleClass('rotate-90')
        })
    })


    //Fungsi untuk menutup sidebar saat klik di luar aside
    $(document).on('click', function(e) {
        var $aside = $('aside');
        var $button = $('#sidebarButton');

        // Cek apakah aside sedang terbuka/terlihat
        if ($aside.is(':visible')) {
            // Cek apakah yang diklik BUKAN aside (dan elemen di dalamnya) AND BUKAN tombol pemicu
            if (!$aside.is(e.target) && $aside.has(e.target).length === 0 && !$button.is(e.target) && $button.has(e.target).length === 0) {

                $aside.hide('slide', {
                    direction: 'left'
                }, 400);

                // Kembalikan rotasi tombol ke semula
                $button.removeClass('rotate-90');
            }
        }
    });
</script>
@endpush