<?php

function phunt_user_contact_method( $method ){

    $method['facebook'] = __('Facebook', 'phunt');
    $method['twitter'] = __('Twitther', 'phunt');
    $method['linkedin'] = __('Linkedin', 'phunt');

    return $method;
}

add_filter( 'user_contactmethods', 'phunt_user_contact_method' );