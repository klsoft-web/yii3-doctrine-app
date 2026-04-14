<?php

namespace App\Messages;

final readonly class App
{
    public const  LOGIN = 'login';
    public const  PASSWORD = 'password';
    public const  REMEMBER_ME = 'Remember me';
    public const EMAIL = 'email';
    public const  SIGN_IN = 'Sign in';
    public const  SIGN_UP = 'Sign up';
    public const  INCORRECT_LOGIN_OR_PASSWORD = 'Incorrect login or password';
    public const  THE_USER_IS_INACTIVE = 'The user is inactive';
    public const  THE_USER_FIELD_NAME_ALREADY_EXISTS = 'The user {field_name} already exists';
    public const  SIGN_IN_FAILED = 'Sign in failed';
    public const  THE_PASSWORD_IS_SHORTER_THAN_THE_MINIMUM_REQUIRED_LENGTH = 'The password is shorter than the minimum required length';

}
