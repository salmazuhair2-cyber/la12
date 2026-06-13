<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">
@include('components.head');
{{-- SweetAlert2 --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@stack('scripts')

<body>
    <div class="dashboard">
        <div class="container">
            @include('components.sidebar')

            <!-- ------------End of Side -------------------->
            <!-- ------------Start of Profile-------------------->
            <div class="right profile-item">
                <div class="top">
                    <div class="language">
                        <h3>Language</h3>
                        <span class="material-icons-sharp">language</span>
                    </div>
                    <div class="notification">
                        <i class="fa-solid fa-bell"></i>
                    </div>
                    <button id="menu-btn">
                        <span class="material-icons-sharp"> menu </span>
                    </button>
                    <div class="theme-toggler">
                        <span class="material-icons-sharp active"> light_mode </span>
                        <span class="material-icons-sharp"> dark_mode </span>
                    </div>
                    <div class="profile-menu">
                        <div class="profile" style="gap:1rem;">
                            <div class="info">
                                <p>Hey, <b>{{ auth()->user()->name }}</b></p>
                            </div>
                            <a href="{{ route('admin.profile') }}">
                                <div class="profile-photo">
                                    <img src="{{ asset('images/' . auth()->user()->avatar) }}" alt="Profile Photo" />
                                </div>
                            </a>
                        </div>

                        <div class="menu-items">
                            <a href="{{ route('admin.profile') }}" class="menu-item">Profile</a>
                            <form action="{{ route('admin.logout') }}" method="POST" style="display:inline;">
                                @csrf
                                <button type="submit" class="menu-item logout">Logout</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!----------------End of Top  -------------->
        <div class="spacial-content">
            <h1 style="left: 17%;">{{ $title ?? 'Coupons' }}</h1>
        </div>
        <div class="spacial-content">
            @include('components.dashboard-alert')
            {{ $slot }}
        </div>
        <!-- ------------End of Profile-------------------->
        @include('components.footer')
    </div>
    <script src="{{ asset('assets/js/dashbord.js') }}"></script>
    @stack('scripts')

</body>

</html>