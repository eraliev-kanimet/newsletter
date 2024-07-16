<?php

function api_login_error(): array
{
    return [
        'errors' => [
            'email' => [__('auth.error_messages.1')],
            'password' => [__('auth.error_messages.1')],
        ]
    ];
}
