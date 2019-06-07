<?php
/**
 * Created by IntelliJ IDEA.
 * Date: 6/06/2019
 * Time: 21:17
 */

return array(
    'clientId'                => '',    // The client ID assigned to you by the provider
    'clientSecret'            => '',   // The client password assigned to you by the provider
    'redirectUri'             => '',
    // Optional
    'urlAuthorize'              => 'https://login.microsoftonline.com/b6e080ea-adb9-4c79-9303-6dcf826fb854/oauth2/v2.0/authorize',
    'urlAccessToken'            => 'https://login.microsoftonline.com/b6e080ea-adb9-4c79-9303-6dcf826fb854/oauth2/v2.0/token',
    'urlResourceOwnerDetails'   => 'https://graph.microsoft.com/v1.0/me',
    'scope' => 'offline_access%20https://graph.microsoft.com/user.read%20openid', // array or string
    'homeurl' => ''

);