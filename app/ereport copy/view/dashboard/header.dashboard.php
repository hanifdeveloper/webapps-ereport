<!-- BEGIN: Mobile Menu -->
<div class="mobile-menu md:hidden">
    <div class="mobile-menu-bar">
        <a href="javascript:void(0);" class="flex mr-auto">
            <img alt="Midone Tailwind HTML Admin Template" class="w-6" src="dist/images/logo.svg">
        </a>
    </div>
</div>
<!-- END: Mobile Menu -->
<!-- BEGIN: Top Bar -->
<div class="border-b border-theme-24 -mt-10 md:-mt-5 -mx-3 sm:-mx-8 px-3 sm:px-8 pt-3 md:pt-0 mb-10">
    <div class="top-bar-boxed flex items-center">
        <!-- BEGIN: Logo -->
        <a href="javascript:void(0);" class="-intro-x hidden md:flex">
            <img alt="Midone Tailwind HTML Admin Template" class="w-6" src="dist/images/logo.svg">
            <span class="text-white text-lg ml-3"> E-Complaint On 7 </span>
        </a>
        <!-- END: Logo -->
        <!-- BEGIN: Breadcrumb -->
        <!-- <div class="-intro-x breadcrumb breadcrumb--light mr-auto"> <a href="javascript:void(0);" class="">Application</a> <i data-feather="chevron-right" class="breadcrumb__icon"></i> <a href="javascript:void(0);" class="breadcrumb--active">Dashboard</a> </div> -->
        <div class="-intro-x breadcrumb breadcrumb--light mr-auto"> <a href="javascript:void(0);" class="">POLDA KALBAR</a> <i data-feather="chevron-right" class="breadcrumb__icon"></i> <a href="javascript:void(0);" class="breadcrumb--active">ITWASDA</a> </div>
        <!-- END: Breadcrumb -->
        <!-- BEGIN: Notifications -->
        <div class="intro-x dropdown relative mr-4 sm:mr-6">
            <div class="dropdown-toggle notification notification--light notification--bullet cursor-pointer"> <i data-feather="bell" class="notification__icon"></i> </div>
        </div>
        <!-- END: Notifications -->
        <!-- BEGIN: Account Menu -->
        <div class="intro-x dropdown w-8 h-8 relative">
            <div class="dropdown-toggle w-8 h-8 rounded-full overflow-hidden shadow-lg image-fit zoom-in scale-110">
                <img alt="Midone Tailwind HTML Admin Template" src="dist/images/profile-9.jpg">
            </div>
            <div class="dropdown-box mt-10 absolute w-56 top-0 right-0 z-20">
                <div class="dropdown-box__content box bg-theme-38 text-white">
                    <div class="p-4 border-b border-theme-40">
                        <div class="font-medium">Administrator</div>
                        <div class="text-xs text-theme-41">Admin@eComplaintOn7</div>
                    </div>
                    <div class="p-2 border-t border-theme-40">
                        <a href="<?= $url_path.'/logout'; ?>" class="flex items-center block p-2 transition duration-300 ease-in-out hover:bg-theme-1 rounded-md"> <i data-feather="toggle-right" class="w-4 h-4 mr-2"></i> Logout </a>
                    </div>
                </div>
            </div>
        </div>
        <!-- END: Account Menu -->
    </div>
</div>
<!-- END: Top Bar -->
<!-- BEGIN: Top Menu -->
<nav class="top-nav">
    <ul>
        <li>
            <a href="<?= $this->link('dashboard'); ?>" class="top-menu top-menu--active">
                <div class="top-menu__icon"> <i data-feather="home"></i> </div>
                <div class="top-menu__title"> Dashboard </div>
            </a>
        </li>
    </ul>
</nav>
<!-- END: Top Menu -->