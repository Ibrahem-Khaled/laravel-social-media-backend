<!-- Side Overlay-->
<aside id="side-overlay" class="font-size-sm">
    <!-- Side Header -->
    <div class="content-header border-bottom">
        <!-- User Avatar -->
        <a class="img-link mr-1" href="javascript:void(0)">
            <img class="img-avatar img-avatar32" src="assets/media/avatars/avatar10.jpg" alt="">
        </a>
        <!-- END User Avatar -->

        <!-- User Info -->
        <div class="ml-2">
            <a class="text-dark font-w600 font-size-sm" href="javascript:void(0)">Administrator</a>
        </div>
        <!-- END User Info -->

        <!-- Close Side Overlay -->
        <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
        <a class="ml-auto btn btn-sm btn-alt-danger" href="javascript:void(0)" data-toggle="layout" data-action="side_overlay_close">
            <i class="fa fa-fw fa-times text-danger"></i>
        </a>
        <!-- END Close Side Overlay -->
    </div>
    <!-- END Side Header -->

    <!-- Side Content -->
    <div class="content-side">
        <!-- Side Overlay Tabs -->
        <div class="block block-transparent pull-x pull-t">
            <ul class="nav nav-tabs nav-tabs-alt nav-justified" data-toggle="tabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" href="#so-section1">
                        <i class="fa fa-fw fa-link text-gray mr-1"></i> Section 1
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#so-section2">
                        <i class="fa fa-fw fa-link text-gray mr-1"></i> Section 2
                    </a>
                </li>
            </ul>
            <div class="block-content tab-content overflow-hidden">
                <!-- Section 1 -->
                <div class="tab-pane pull-x fade fade-left show active" id="so-section1" role="tabpanel">
                    <div class="block">
                        <div class="block-header block-header-default">
                            <h3 class="block-title">Section 1</h3>
                            <div class="block-options">
                                <button type="button" class="btn-block-option" data-toggle="block-option" data-action="state_toggle" data-action-mode="demo">
                                    <i class="si si-refresh"></i>
                                </button>
                                <button type="button" class="btn-block-option" data-toggle="block-option" data-action="content_toggle"></button>
                            </div>
                        </div>
                        <div class="block-content">
                            <p>
                                ...
                            </p>
                        </div>
                    </div>
                </div>
                <!-- END Section 1 -->

                <!-- Section 2 -->
                <div class="tab-pane pull-x fade fade-right" id="so-section2" role="tabpanel">
                    <div class="block">
                        <div class="block-header block-header-default">
                            <h3 class="block-title">Section 2</h3>
                            <div class="block-options">
                                <button type="button" class="btn-block-option" data-toggle="block-option" data-action="state_toggle" data-action-mode="demo">
                                    <i class="si si-refresh"></i>
                                </button>
                                <button type="button" class="btn-block-option" data-toggle="block-option" data-action="content_toggle"></button>
                            </div>
                        </div>
                        <div class="block-content">
                            <p>
                                ...
                            </p>
                        </div>
                    </div>
                </div>
                <!-- END Section 2 -->
            </div>
        </div>
        <!-- END Side Overlay Tabs -->
    </div>
    <!-- END Side Content -->
</aside>
<!-- END Side Overlay -->
