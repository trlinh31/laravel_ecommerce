<nav class="main-nav">
  <div class="main-nav">
    <div class="main-nav-start">
      <div class="search-wrapper">
        <svg xmlns="http://www.w3.org/2000/svg"
          width="24"
          height="24"
          viewBox="0 0 24 24"
          fill="none"
          stroke="currentColor"
          stroke-width="2"
          stroke-linecap="round"
          stroke-linejoin="round"
          class="feather feather-search"
          aria-hidden="true">
          <circle cx="11"
            cy="11"
            r="8"></circle>
          <line x1="21"
            y1="21"
            x2="16.65"
            y2="16.65"></line>
        </svg>
        <input type="text"
          placeholder="Enter keywords ..."
          required="">
      </div>
    </div>
    <div class="main-nav-end">
      <div class="switch-theme">
        <label class="switch">
          <input type="checkbox">
          <span class="slider"></span>
        </label>
      </div>

      <div class="nav-user-wrapper"
        style="margin-left: 20px;">
        @if (Auth::check())
          <a href="{{ route('auth.logout') }}"
            class="text-primary">{{ Auth::user()->name }}</a>
        @endif
      </div>
    </div>
  </div>
</nav>
