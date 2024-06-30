<!-- Sidebar -->
            <!--
                Sidebar Mini Mode - Display Helper classes

                Adding 'smini-hide' class to an element will make it invisible (opacity: 0) when the sidebar is in mini mode
                Adding 'smini-show' class to an element will make it visible (opacity: 1) when the sidebar is in mini mode
                    If you would like to disable the transition animation, make sure to also add the 'no-transition' class to your element

                Adding 'smini-hidden' to an element will hide it when the sidebar is in mini mode
                Adding 'smini-visible' to an element will show it (display: inline-block) only when the sidebar is in mini mode
                Adding 'smini-visible-block' to an element will show it (display: block) only when the sidebar is in mini mode
            -->
            <nav id="sidebar" aria-label="Main Navigation">
                <!-- Side Header -->
                <div class="content-header bg-white-5">
                    <!-- Logo -->
                    <a class="font-w600 text-dual" href="">
                        <span class="smini-visible">
                            <i class="fa fa-circle-notch text-primary"></i>
                        </span>
                        <span class="smini-hide font-size-h5 tracking-wider">
                        Enjoy<span class="font-w400">Chat</span>
                        </span>
                    </a>
                    <!-- END Logo -->

                    <!-- Options -->
                    <div>
                        <!-- Color Variations -->
                        <div class="dropdown d-inline-block ml-2">
                            <a class="btn btn-sm btn-dual" id="sidebar-themes-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" href="#">
                                <i class="si si-drop"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right font-size-sm smini-hide border-0" aria-labelledby="sidebar-themes-dropdown">
                                <!-- Color Themes -->
                                <!-- Layout API, functionality initialized in Template._uiHandleTheme() -->
                                <a class="dropdown-item d-flex align-items-center justify-content-between font-w500" data-toggle="theme" data-theme="default" href="#">
                                    <span>Default</span>
                                    <i class="fa fa-circle text-default"></i>
                                </a>
                                <a class="dropdown-item d-flex align-items-center justify-content-between font-w500" data-toggle="theme" data-theme="assets/css/themes/amethyst.min.css" href="#">
                                    <span>Amethyst</span>
                                    <i class="fa fa-circle text-amethyst"></i>
                                </a>
                                <a class="dropdown-item d-flex align-items-center justify-content-between font-w500" data-toggle="theme" data-theme="assets/css/themes/city.min.css" href="#">
                                    <span>City</span>
                                    <i class="fa fa-circle text-city"></i>
                                </a>
                                <a class="dropdown-item d-flex align-items-center justify-content-between font-w500" data-toggle="theme" data-theme="assets/css/themes/flat.min.css" href="#">
                                    <span>Flat</span>
                                    <i class="fa fa-circle text-flat"></i>
                                </a>
                                <a class="dropdown-item d-flex align-items-center justify-content-between font-w500" data-toggle="theme" data-theme="assets/css/themes/modern.min.css" href="#">
                                    <span>Modern</span>
                                    <i class="fa fa-circle text-modern"></i>
                                </a>
                                <a class="dropdown-item d-flex align-items-center justify-content-between font-w500" data-toggle="theme" data-theme="assets/css/themes/smooth.min.css" href="#">
                                    <span>Smooth</span>
                                    <i class="fa fa-circle text-smooth"></i>
                                </a>
                                <!-- END Color Themes -->

                                <div class="dropdown-divider"></div>

                                <!-- Sidebar Styles -->
                                <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                                <a class="dropdown-item font-w500" data-toggle="layout" data-action="sidebar_style_light" href="#">
                                    <span>Sidebar Light</span>
                                </a>
                                <a class="dropdown-item font-w500" data-toggle="layout" data-action="sidebar_style_dark" href="#">
                                    <span>Sidebar Dark</span>
                                </a>
                                <!-- Sidebar Styles -->

                                <div class="dropdown-divider"></div>

                                <!-- Header Styles -->
                                <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                                <a class="dropdown-item font-w500" data-toggle="layout" data-action="header_style_light" href="#">
                                    <span>Header Light</span>
                                </a>
                                <a class="dropdown-item font-w500" data-toggle="layout" data-action="header_style_dark" href="#">
                                    <span>Header Dark</span>
                                </a>
                                <!-- Header Styles -->
                            </div>
                        </div>
                        <!-- END Themes -->

                        <!-- Close Sidebar, Visible only on mobile screens -->
                        <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                        <a class="d-lg-none btn btn-sm btn-dual ml-1" data-toggle="layout" data-action="sidebar_close" href="javascript:void(0)">
                            <i class="fa fa-fw fa-times"></i>
                        </a>
                        <!-- END Close Sidebar -->
                    </div>
                    <!-- END Options -->
                </div>
                <!-- END Side Header -->

                <!-- Sidebar Scrolling -->
                <div class="js-sidebar-scroll">
                    <!-- Side Navigation -->
                    <div class="content-side">
                        <ul class="nav-main">
                            <li class="nav-main-item">
                                <a class="nav-main-link active" href="gs_backend.html">
                                    <i class="nav-main-link-icon si si-speedometer"></i>
                                    <span class="nav-main-link-name">Dashboard</span>
                                </a>
                            </li>
                            <li class="nav-main-heading">Heading</li>

                            <li class="nav-main-item @if (request()->segment(2) == 'users')
                                open
                            @endif ">
                                <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true" aria-expanded="false" href="#">
                                    <i class="nav-main-link-icon fa fa-users"></i>
                                    <span class="nav-main-link-name">Users</span>
                                </a>
                                <ul class="nav-main-submenu">
                                    <li class="nav-main-item">
                                        <a class="nav-main-link @if (request()->segment(2) == 'users' && request()->segment(3) == NULL)
                                                                    active
                                                                @endif"
                                    href="{{route('admin.users.list')}}">
                                            <span class="nav-main-link-name ">List</span>
                                        </a>
                                    </li>
                                    <li class="nav-main-item">
                                        <a class="nav-main-link @if (request()->segment(2) == 'users' && request()->segment(3) == 'add')
                                                                    active
                                                                @endif" href="{{route('admin.users.add')}}">
                                            <span class="nav-main-link-name">Add</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            <li class="nav-main-item @if (request()->segment(2) == 'categories')
                                open
                            @endif ">
                                <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true" aria-expanded="false" href="#">
                                    <i class="nav-main-link-icon fa fa-list"></i>
                                    <span class="nav-main-link-name">Categories</span>
                                </a>
                                <ul class="nav-main-submenu">
                                    <li class="nav-main-item">
                                        <a class="nav-main-link @if (request()->segment(2) == 'categories' && request()->segment(3) == NULL)
                                                                    active
                                                                @endif"
                                    href="{{route('admin.categories.list')}}">
                                            <span class="nav-main-link-name ">List</span>
                                        </a>
                                    </li>
                                    <li class="nav-main-item">
                                        <a class="nav-main-link @if (request()->segment(2) == 'categories' && request()->segment(3) == 'add')
                                                                    active
                                                                @endif" href="{{route('admin.categories.add')}}">
                                            <span class="nav-main-link-name">Add</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>


                            <li class="nav-main-item @if (request()->segment(2) == 'rooms')
                                open
                            @endif ">
                                <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true" aria-expanded="false" href="#">
                                    <i class="nav-main-link-icon fa fa-users"></i>
                                    <span class="nav-main-link-name">Rooms</span>
                                </a>
                                <ul class="nav-main-submenu">
                                    <li class="nav-main-item">
                                        <a class="nav-main-link @if (request()->segment(2) == 'rooms' && request()->segment(3) == NULL)
                                                                    active
                                                                @endif"
                                    href="{{route('admin.rooms.list')}}">
                                            <span class="nav-main-link-name ">List</span>
                                        </a>
                                    </li>
                                    <li class="nav-main-item">
                                        <a class="nav-main-link @if (request()->segment(2) == 'rooms' && request()->segment(3) == 'add')
                                                                    active
                                                                @endif" href="{{route('admin.rooms.add')}}">
                                            <span class="nav-main-link-name">Add</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            <li class="nav-main-item @if (request()->segment(2) == 'posts')
                                open
                            @endif ">
                                <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true" aria-expanded="false" href="#">
                                    <i class="nav-main-link-icon fa fa-comment"></i>
                                    <span class="nav-main-link-name">Posts</span>
                                </a>
                                <ul class="nav-main-submenu">
                                    <li class="nav-main-item">
                                        <a class="nav-main-link @if (request()->segment(2) == 'posts' && request()->segment(3) == NULL)
                                                                    active
                                                                @endif"
                                    href="{{route('admin.posts.list')}}">
                                            <span class="nav-main-link-name ">List</span>
                                        </a>
                                    </li>
                                    <li class="nav-main-item">
                                        <a class="nav-main-link @if (request()->segment(2) == 'posts' && request()->segment(3) == 'add')
                                                                    active
                                                                @endif" href="{{route('admin.posts.add')}}">
                                            <span class="nav-main-link-name">Add</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            <li class="nav-main-item @if (request()->segment(2) == 'comments')
                                open
                            @endif ">
                                <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true" aria-expanded="false" href="#">
                                    <i class="nav-main-link-icon fa fa-comments"></i>
                                    <span class="nav-main-link-name">Comments</span>
                                </a>
                                <ul class="nav-main-submenu">
                                    <li class="nav-main-item">
                                        <a class="nav-main-link @if (request()->segment(2) == 'comments' && request()->segment(3) == NULL)
                                                                    active
                                                                @endif"
                                    href="{{route('admin.comments.list')}}">
                                            <span class="nav-main-link-name ">List</span>
                                        </a>
                                    </li>
                                    <li class="nav-main-item">
                                        <a class="nav-main-link @if (request()->segment(2) == 'comments' && request()->segment(3) == 'add')
                                                                    active
                                                                @endif" href="{{route('admin.comments.add')}}">
                                            <span class="nav-main-link-name">Add</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            <li class="nav-main-item @if (request()->segment(2) == 'likes')
                                open
                            @endif ">
                                <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true" aria-expanded="false" href="#">
                                    <i class="nav-main-link-icon fa fa-thumbs-up "></i>
                                    <span class="nav-main-link-name">Likes</span>
                                </a>
                                <ul class="nav-main-submenu">
                                    <li class="nav-main-item">
                                        <a class="nav-main-link @if (request()->segment(2) == 'likes' && request()->segment(3) == NULL)
                                                                    active
                                                                @endif"
                                    href="{{route('admin.likes.list')}}">
                                            <span class="nav-main-link-name ">List</span>
                                        </a>
                                    </li>
                                    <li class="nav-main-item">
                                        <a class="nav-main-link @if (request()->segment(2) == 'likes' && request()->segment(3) == 'add')
                                                                    active
                                                                @endif" href="{{route('admin.likes.add')}}">
                                            <span class="nav-main-link-name">Add</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            <li class="nav-main-item @if (request()->segment(2) == 'countries')
                                open
                            @endif ">
                                <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true" aria-expanded="false" href="#">
                                    <i class="nav-main-link-icon fa fa-globe "></i>
                                    <span class="nav-main-link-name">Countries</span>
                                </a>
                                <ul class="nav-main-submenu">
                                    <li class="nav-main-item">
                                        <a class="nav-main-link @if (request()->segment(2) == 'countries' && request()->segment(3) == NULL)
                                                                    active
                                                                @endif"
                                    href="{{route('admin.countries.list')}}">
                                            <span class="nav-main-link-name ">List</span>
                                        </a>
                                    </li>
                                    <li class="nav-main-item">
                                        <a class="nav-main-link @if (request()->segment(2) == 'countries' && request()->segment(3) == 'add')
                                                                    active
                                                                @endif" href="{{route('admin.countries.add')}}">
                                            <span class="nav-main-link-name">Add</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>


                            <li class="nav-main-item @if (request()->segment(2) == 'gifts')
                                open
                            @endif ">
                                <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true" aria-expanded="false" href="#">
                                    <i class="nav-main-link-icon fa fa-gift "></i>
                                    <span class="nav-main-link-name">Gifts</span>
                                </a>
                                <ul class="nav-main-submenu">
                                    <li class="nav-main-item">
                                        <a class="nav-main-link @if (request()->segment(2) == 'gifts' && request()->segment(3) == NULL)
                                                                    active
                                                                @endif"
                                    href="{{route('admin.gifts.list')}}">
                                            <span class="nav-main-link-name ">List</span>
                                        </a>
                                    </li>
                                    <li class="nav-main-item">
                                        <a class="nav-main-link @if (request()->segment(2) == 'gifts' && request()->segment(3) == 'add')
                                                                    active
                                                                @endif" href="{{route('admin.gifts.add')}}">
                                            <span class="nav-main-link-name">Add</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>


                            <li class="nav-main-item @if (request()->segment(2) == 'frames')
                                open
                            @endif ">
                                <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true" aria-expanded="false" href="#">
                                    <i class="nav-main-link-icon fa fa-gift "></i>
                                    <span class="nav-main-link-name">Frames</span>
                                </a>
                                <ul class="nav-main-submenu">
                                    <li class="nav-main-item">
                                        <a class="nav-main-link @if (request()->segment(2) == 'frames' && request()->segment(3) == NULL)
                                                                    active
                                                                @endif"
                                    href="{{route('admin.frames.list')}}">
                                            <span class="nav-main-link-name ">List</span>
                                        </a>
                                    </li>
                                    <li class="nav-main-item">
                                        <a class="nav-main-link @if (request()->segment(2) == 'frames' && request()->segment(3) == 'add')
                                                                    active
                                                                @endif" href="{{route('admin.frames.add')}}">
                                            <span class="nav-main-link-name">Add</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            <li class="nav-main-item @if (request()->segment(2) == 'entries')
                                open
                            @endif ">
                                <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true" aria-expanded="false" href="#">
                                    <i class="nav-main-link-icon fa fa-gift "></i>
                                    <span class="nav-main-link-name">entries</span>
                                </a>
                                <ul class="nav-main-submenu">
                                    <li class="nav-main-item">
                                        <a class="nav-main-link @if (request()->segment(2) == 'entries' && request()->segment(3) == NULL)
                                                                    active
                                                                @endif"
                                    href="{{route('admin.entries.list')}}">
                                            <span class="nav-main-link-name ">List</span>
                                        </a>
                                    </li>
                                    <li class="nav-main-item">
                                        <a class="nav-main-link @if (request()->segment(2) == 'entries' && request()->segment(3) == 'add')
                                                                    active
                                                                @endif" href="{{route('admin.entries.add')}}">
                                            <span class="nav-main-link-name">Add</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>

                        </ul>
                    </div>
                    <!-- END Side Navigation -->
                </div>
                <!-- END Sidebar Scrolling -->
            </nav>
            <!-- END Sidebar -->
