<ul class="metismenu" id="menu">
    <li><a href="/" class="" aria-expanded="false">
            <i class="flaticon-025-dashboard"></i>
            <span class="nav-text">Dashboard</span>
        </a>
    </li>
    @can('super-admin')
        <li><a href="{{ route('admin.user.index') }}" aria-expanded="false">
                <i class="flaticon-381-user-1"></i>
                <span class="nav-text">Users</span>
            </a>
        </li>
    @endcan

    <li><a href="{{ route('admin.trade.index') }}" aria-expanded="false">
            <i class="flaticon-041-graph"></i>
            <span class="nav-text">Trades</span>
        </a>
    </li>

    <li><a href="{{ route('admin.trade.index') }}" aria-expanded="false">
            <i class="flaticon-041-graph"></i>
            <span class="nav-text">Trades</span>
        </a>
    </li>

    @can('super-admin')
        <li><a href="{{ route('admin.giftcards.index') }}" aria-expanded="false">
                <i class="flaticon-041-graph"></i>
                <span class="nav-text">Giftcards</span>
            </a>
        </li>
    @endcan

    {{-- <li><a href="" aria-expanded="false">
            <i class="flaticon-038-gauge"></i>
            <span class="nav-text">Transactions</span>
        </a>
    </li> --}}

    <li><a class="has-arrow " href="javascript:void()" aria-expanded="false">
            <i class="flaticon-381-settings-1"></i>
            <span class="nav-text">Settings</span>
        </a>
        <ul aria-expanded="false">
            @can('super-admin')
                <li><a href="{{ route('admin.settings.admin.index') }}">Admins</a></li>
            @endcan
            <li><a href="{{ route('admin.settings.password') }}">Change password</a></li>
            {{-- <li><a href="">Contact Details</a></li> --}}
        </ul>
    </li>
</ul>
