<?php

function user_domain(){
    return config('domain.user');
}

function admin_domain(){
    return config('domain.admin');
}

/**
 * Loads the site logo
 *
 * @param boolean $dark Checks if the dark version of the logo was request
 *
 * @param string $url Custom url to a file to load a custom logo
 */

function logo($dark = false, $url = null){
    if(is_string($url)) return asset($url);
    $logo = $dark ? config('dir.logo_dark') : config('dir.logo');
    return asset($logo);
}

function favicon(){
    return '';
}

function profile_picture()
{
    return '';
}
