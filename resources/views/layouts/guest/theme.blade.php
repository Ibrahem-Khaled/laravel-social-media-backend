
@include('layouts.guest.head')
    <body>



        <div id="page-container" class="sidebar-dark side-scroll page-header-fixed page-header-dark main-content-boxed "  >

        @include('layouts.guest.header')




            <!-- Main Container -->
            <main id="main-container">
                @yield('main')

            </main>



@include('layouts.guest.footer')


