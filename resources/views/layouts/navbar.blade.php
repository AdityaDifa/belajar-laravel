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
        transform :scale(1.2)
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
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button class="btn btn-danger" type="submit">Logout</button>
        </form>
        @endauth
    </div>
</nav>