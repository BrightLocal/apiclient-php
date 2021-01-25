<?php
namespace BrightLocal;

class Methods {
    const POST = 'post';
    const GET = 'get';
    const PUT = 'put';
    const DELETE = 'delete';


    public static array $allowedHttpMethods = [
        self::POST,
        self::GET,
        self::PUT,
        self::DELETE
    ];
}