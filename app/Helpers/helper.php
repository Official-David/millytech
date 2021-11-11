<?php

function user_domain()
{
    return config('domain.user');
}

function admin_domain()
{
    return config('domain.admin');
}

function front_domain()
{
    return config('doamin.front');
}

/**
 * Loads the site logo
 *
 * @param boolean $dark Checks if the dark version of the logo was request
 *
 * @param string $url Custom url to a file to load a custom logo
 */

function logo($dark = false, $url = null)
{
    if (is_string($url)) return asset($url);
    $logo = $dark ? config('dir.logo_dark') : config('dir.logo');
    return asset($logo);
}

function favicon()
{
    return logo();
}

function profile_picture()
{
    $avatar = auth('user')->user()->avatar ?? 'default.png';
    return asset(config('dir.profile').$avatar);
}

function trade_status($status)
{
    switch ($status) {
        case 'paid':
            $status = 'success';
            break;
        case 'processing':
            $status = 'warning';
            break;
        case 'rejected':
            $status = 'danger';
            break;
        default:
            $status = 'info';
    }
    return $status;
}
