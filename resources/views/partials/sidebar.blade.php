<ul class="metismenu" id="menu">
    <li><a href="/" class="" aria-expanded="false">
            <i class="fa fa-tachometer-alt"></i>
            <span class="nav-text">Dashboard</span>
        </a>
    </li>

    <li><a href="{{ route('user.rates') }}" aria-expanded="false">
            <i class="fa fa-chart-line"></i>
            <span class="nav-text">Rates</span>
        </a>
    </li>

    {{-- <li class="menu-label d-none d-lg-block"><a href="javascript:void(0);">
            <h4>Personal Menu</h4>
        </a></li> --}}


    <li><a href="{{ route('user.trades.index') }}" aria-expanded="false">
            <i class="fa fa-credit-card"></i>
            <span class="nav-text">Sell Giftcard</span>
        </a>
    </li>

    {{-- <li><a href="" aria-expanded="false">
        <i class="flaticon-381-user-1"></i>
        <span class="nav-text">Trade history</span>
    </a>
</li> --}}

    <li><a href="{{ route('user.trades.history') }}" aria-expanded="false">
            <i class="fa fa-chart-bar"></i>
            <span class="nav-text">Trade history</span>
        </a>
    </li>

    <li><a href="{{ route('user.settings.profile') }}" aria-expanded="false">
            <i class="fa fa-user"></i>
            <span class="nav-text">Profile</span>
        </a>
    </li>


    <li><a href="{{ route('user.settings.bank.details') }}" aria-expanded="false">
            <i class="fa fa-university"></i>
            <span class="nav-text">Bank Details</span>
        </a>
    </li>

    <li><a href="{{ route('user.settings.password') }}" aria-expanded="false">
            <i class="fa fa-key"></i>
            <span class="nav-text">Change Password</span>
        </a>
    </li>
    {{-- <li><a href="javascript:void(0);">
            <h4>Settings</h4>
        </a></li>

    <li><a href="{{ route('admin.email.index') }}" aria-expanded="false">
            <i class="flaticon-381-settings-1"></i>
            <span class="nav-text">Preferences</span>
        </a>
    </li> --}}

    {{-- <li><a class="has-arrow " href="javascript:void()" aria-expanded="false">
            <i class="flaticon-381-settings-1"></i>
            <span class="nav-text">Settings</span>
        </a>
        <ul aria-expanded="false">
            <li><a href="{{ route('admin.settings.security.index') }}">Security</a></li>
            <li><a href="{{ route('admin.settings.contact.index') }}">Contact Details</a></li>
        </ul>
    </li> --}}
</ul>
