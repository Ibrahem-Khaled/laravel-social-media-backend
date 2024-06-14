
@include('layouts.backend.head')
    <body>



        <div id="page-container" class="sidebar-o sidebar-dark enable-page-overlay side-scroll page-header-fixed "  >

        @include('layouts.backend.overlay-sidebar')

        @include('layouts.backend.sidebar')

        @include('layouts.backend.header')




            <!-- Main Container -->
            <main id="main-container">
                @yield('main')

            </main>



@include('layouts.backend.footer')


