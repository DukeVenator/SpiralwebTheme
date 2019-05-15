<?php

return [
    'validation_error' => 'There was an error with one or more fields in the request.',
    'errors' => [
        'return' => 'Return to Previous Page',
        'home' => 'Go Home',
        '403' => [
            'header' => 'Forbidden',
            'desc' => 'A magical field is stopping you as you do not have permission to access this area.',
        ],
        '404' => [
            'header' => 'File Not Found',
            'desc' => 'The Minions are unable to find this file.',
        ],
        'installing' => [
            'header' => 'Server Installing',
            'desc' => 'Excellent Choice the minions are setting the new realm up for you. Please check back in a few minutes, The minions will head out on the email train to inform you as soon as this process is completed.',
        ],
        'suspended' => [
            'header' => 'Server Suspended',
            'desc' => 'This realm has been suspended and cannot be accessed.',
        ],
        'maintenance' => [
            'header' => 'Node Under Maintenance',
            'title' => 'Temporarily Unavailable',
            'desc' => 'This Realm Holder is under maintenance, therefore your Realm can temporarily not be accessed.',
        ],
    ],
    'index' => [
        'header' => 'Your Servers',
        'header_sub' => 'The Realms you have access to.',
        'list' => 'Server List',
    ],
    'api' => [
        'index' => [
            'list' => 'Your Keys',
            'header' => 'Account API',
            'header_sub' => 'Manage access keys that allow you to perform actions against the panel.',
            'create_new' => 'Create New magic API key',
            'keypair_created' => 'A new magical API key has been successfully generated and is listed below.',
        ],
        'new' => [
            'header' => 'New API Key',
            'header_sub' => 'Create a new account access key.',
            'form_title' => 'Details',
            'descriptive_memo' => [
                'title' => 'Description',
                'description' => 'Enter a brief description of this key that will be useful for reference.',
            ],
            'allowed_ips' => [
                'title' => 'Allowed IPs',
                'description' => 'Enter a line delimited list of IPs that are allowed to access the API using this key. CIDR notation is allowed. Leave blank to allow any IP.',
            ],
        ],
    ],
    'account' => [
        'details_updated' => 'The record books have been updated for you.',
        'invalid_password' => 'The magical password you have provided for your account was not valid.',
        'header' => 'Your Account',
        'header_sub' => 'Manage your account details.',
        'update_pass' => 'Update Password',
        'update_email' => 'Update Email Address',
        'current_password' => 'Current Password',
        'new_password' => 'New Password',
        'new_password_again' => 'Repeat New Password',
        'new_email' => 'New Email Address',
        'first_name' => 'First Name',
        'last_name' => 'Last Name',
        'update_identity' => 'Update Identity',
        'username_help' => 'Your username must be unique to your account, and may only contain the following characters: :requirements.',
        'language' => 'Language',
        'themes' => 'Theme Selector',
    ],
    'security' => [
        'session_mgmt_disabled' => 'The Wizards have not enabled the ability to manage mortals sessions via this interface.',
        'header' => 'Account Security',
        'header_sub' => 'Control active sessions and 2-Factor Authentication.',
        'sessions' => 'Active Sessions',
        '2fa_header' => '2-Factor Authentication',
        '2fa_token_help' => 'Enter the 2FA Token generated by your app (Google Authenticator, Authy, etc.).',
        'disable_2fa' => 'Disable 2-Factor Authentication',
        '2fa_enabled' => '2-Factor Authentication is enabled on this account and will be required in order to login to the panel. If you would like to disable 2FA, simply enter a valid token below and submit the form.',
        '2fa_disabled' => '2-Factor Authentication is disabled on your account! You should enable 2FA in order to add an extra level of protection on your account.',
        'enable_2fa' => 'Enable 2-Factor Authentication',
        '2fa_qr' => 'Configure 2FA on Your Device',
        '2fa_checkpoint_help' => 'Use the 2FA application on your magical scroll called a P.H.O.N.E to take a picture of the QR code to the left, or manually enter the code under it. Once you have done so, generate a token and enter it below.',
        '2fa_disable_error' => 'The 2FA token provided was not valid. Protection has not been disabled for this account.',
    ],
];
