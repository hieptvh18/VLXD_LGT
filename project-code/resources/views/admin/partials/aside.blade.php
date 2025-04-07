<aside class="sidenav-main nav-expanded nav-lock nav-collapsible sidenav-light sidenav-active-square">
    <div class="brand-sidebar">
        <h1 class="logo-wrapper">
            <a class="brand-logo darken-1" href="{{ route('client.home') }}">
                <img class="hide-on-med-and-down" src="{{ getLogo() }}" alt="materialize logo" /><img
                    class="show-on-medium-and-down hide-on-med-and-up" src="" alt="materialize logo" /><span
                    class="logo-text hide-on-med-and-down">LGT</span></a><a class="navbar-toggler" href="#"><i
                    class="material-icons">radio_button_checked</i></a></h1>
    </div>
    <ul class="sidenav sidenav-collapsible leftside-navigation collapsible sidenav-fixed menu-shadow" id="slide-out"
        data-menu="menu-navigation" data-collapsible="menu-accordion">

        <li class="bold">
            <a class="waves-effect waves-cyan " href="{{ route('client.home') }}" target="_blank">
                <i class="material-icons">web</i>
                <span class="menu-title" data-i18n="Chat">Website</span>
            </a>
        </li>

        <li class="bold active">
            <a class="waves-effect waves-cyan {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"
                href="{{ route('admin.dashboard') }}">
                <i class="material-icons">settings_input_svideo</i>
                <span class="menu-title" data-i18n="Chat">Dashboard</span>
            </a>
        </li>

        <li class="navigation-header"><a class="navigation-header-text">Applications</a><i
                class="navigation-header-icon material-icons">more_horiz</i>
        </li>
        @if (isSuperAdmin())
            <li
                class="bold {{ request()->routeIs('admin.user.index') || request()->routeIs('admin.user.edit') || request()->routeIs('admin.user.create') ? 'active' : '' }}">
                <a class="collapsible-header waves-effect waves-cyan " href="JavaScript:void(0)"><i
                        class="material-icons">face</i><span class="menu-title" data-i18n="Tài khoản">Tài
                        khoản</span><span class="badge badge pill purple float-right mr-10">3</span>
                </a>
                <div class="collapsible-body">
                    <ul class="collapsible collapsible-sub" data-collapsible="accordion">
                        <li>
                            <a href="{{ route('admin.user.index') }}"
                                class="{{ request()->routeIs('admin.user.index') ? 'active' : '' }}">
                                <i class="material-icons">radio_button_unchecked</i>
                                <span data-i18n="List">List</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.user.create') }}"
                                class="{{ request()->routeIs('admin.user.create') ? 'active' : '' }}">
                                <i class="material-icons">radio_button_unchecked</i>
                                <span data-i18n="Add">Add</span></a>
                        </li>
                    </ul>
                </div>
            </li>
        @endif
        <li class="bold {{ request()->routeIs('admin.category.index') ? 'active' : '' }}">
            <a class="waves-effect waves-cyan {{ request()->routeIs('admin.category.index') ? 'active' : '' }}" \
                href="{{ route('admin.category.index') }}">
                <i class="material-icons">subtitles</i>
                <span class="menu-title" data-i18n="Chat">Danh mục</span>
            </a>
        </li>

        <li
            class="bold {{ request()->routeIs('admin.news.index') || request()->routeIs('admin.news.edit') || request()->routeIs('admin.news.create') ? 'active' : '' }}">
            <a class="collapsible-header waves-effect waves-cyan " href="JavaScript:void(0)">
                <i class="material-icons">chat_bubble_outline</i>
                <span class="menu-title" data-i18n="Tài khoản">Tin tức</span>
            </a>
            <div class="collapsible-body">
                <ul class="collapsible collapsible-sub" data-collapsible="accordion">
                    <li>
                        <a href="{{ route('admin.news.index') }}"
                            class="{{ request()->routeIs('admin.news.index') ? 'active' : '' }}">
                            <i class="material-icons">radio_button_unchecked</i>
                            <span data-i18n="List">List</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.news.create') }}"
                            class="{{ request()->routeIs('admin.news.create') ? 'active' : '' }}">
                            <i class="material-icons">radio_button_unchecked</i>
                            <span data-i18n="Add">Add</span></a>
                    </li>
                </ul>
            </div>
        </li>
        <li class="bold">
            <a class="waves-effect waves-cyan {{ request()->routeIs('admin.setting.aboutus.index') ? 'active' : '' }}"
                href="{{ route('admin.setting.aboutus.index') }}">
                <i class="material-icons">feedback</i><span class="menu-title" data-i18n="ToDo">Về chúng tôi</span>
            </a>
        </li>
        <li class="bold">
            <a class="waves-effect waves-cyan {{ request()->routeIs('admin.contact.index') || request()->routeIs('admin.contact.edit') || request()->routeIs('admin.contact.create') ? 'active' : '' }}"
                href="{{ route('admin.contact.index') }}">
                <i class="material-icons">feedback</i><span class="menu-title" data-i18n="ToDo">Khách hàng liên
                    hệ</span>
            </a>
        </li>

        <li class="navigation-header"><a class="navigation-header-text">Cài đặt </a><i
                class="navigation-header-icon material-icons">more_horiz</i>
        </li>
        @if (isSuperAdmin())
            <li class="bold">
                <a class="waves-effect waves-cyan {{ request()->routeIs('admin.setting.index') ? 'active' : '' }}"
                    href="{{ route('admin.setting.index') }}">
                    <i class="material-icons">settings</i>
                    <span class="menu-title" data-i18n="Documentation">Cài đặt website</span>
                </a>
            </li>
        @endif

        <li class="bold"><a class="waves-effect waves-cyan " href="https://zalo.me/0989581167" target="_blank"><i
                    class="material-icons">help_outline</i><span class="menu-title" data-i18n="Support">Dev
                    Support</span></a>
        </li>
    </ul>
    <div class="navigation-background"></div>
    <a class="sidenav-trigger btn-sidenav-toggle btn-floating btn-medium waves-effect waves-light hide-on-large-only"
        href="#" data-target="slide-out"><i class="material-icons">menu</i></a>
</aside>
