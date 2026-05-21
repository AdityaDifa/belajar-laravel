<style>
    .sidebar-link{
        padding: 16px;
    }

    .sidebar-link a{
        width: 100%;
        display: block;
    }

    .sidebar-link-active{
        background-color: var(--second);
    }
</style>

<div class="sidebar-link {{Route::is('home') ? 'sidebar-link-active' : ''}}">
    <a class="{{Route::is('home') ? 'active-link' : 'navbar-link'  }}" href="{{ route('home') }}">Home</a>
</div>
<div class="sidebar-link {{Route::is('createNote') ? 'sidebar-link-active' : ''}}">
    <a class="{{Route::is('createNote') ? 'active-link' : 'navbar-link'  }}" href="{{ route('createNote') }}">Create Note</a>
</div>
<div class="sidebar-link {{Route::is('about') ? 'sidebar-link-active' : ''}}">
    <a class="{{Route::is('about') ? 'active-link' : 'navbar-link'  }}" href="{{ route('about') }}">About</a>
</div>
<div class="sidebar-link {{Route::is('rules') ? 'sidebar-link-active' : ''}}">
    <a class="{{Route::is('rules') ? 'active-link' : 'navbar-link'  }}" href="{{ route('rules') }}">Rules</a>
</div class="sidebar-link">
<div class="sidebar-link {{Route::is('logs') ? 'sidebar-link-active' : ''}}">
    <a class="{{Route::is('logs') ? 'active-link' : 'navbar-link'  }}" href="{{ route('logs') }}">Logs</a>
</div>