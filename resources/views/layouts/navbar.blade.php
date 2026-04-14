<style>
    .top-nav {
        background-color: #B33791;
        padding: 10px 80px;
        display: flex;
        justify-content: space-between;
        align-items: center;
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
        color: #FEC5F6;

        user-select: none;
        -webkit-user-select: none;
        -ms-user-select: none;
    }

    .navbar-link {
        font-size: 16px;
        color: white;
        font-weight: 400;
        cursor: pointer;
    }

    .active-link {
        font-weight: 800;
        font-size: 16px;
        color: white;
        cursor: pointer;
    }

    .navbar-link:hover,
    .active-link:hover {
        font-size: 20px !important;
    }

</style>
<nav class="top-nav">
    <div class="left-nav">
        <h1 class="title-nav">Gudang Clipper</h1>
        <a class="{{Route::is('home') ? 'active-link' : 'navbar-link'  }}" href="{{ route('home') }}">Home</a>
        <a class="{{Route::is('create-note') ? 'active-link' : 'navbar-link'  }}" href="{{ route('createNote') }}">Create Note</a>
        <a class="{{Route::is('about') ? 'active-link' : 'navbar-link'  }}" href="{{ route('about') }}">about</a>
        <a class="{{Route::is('rules') ? 'active-link' : 'navbar-link'  }}" href="{{ route('rules') }}">Rules</a>
    </div>

    <div class="right-nav">
        @guest
        <a class="{{Route::is('register') ? 'active-link' : 'navbar-link'  }}" href="{{ route('register') }}">register</a>
        <a class="{{Route::is('login') ? 'active-link' : 'navbar-link'  }}" href="{{ route('login') }}">login</a>
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