<?php

namespace Modules\Core\Exceptions;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException as SymfonyHttpException;

/**
 * Class AuthenticationException
 *
 * @author  luffy007  <285276792@qq.com>
 */
class AuthenticationException extends SymfonyHttpException
{
    public $httpStatusCode = Response::HTTP_UNAUTHORIZED;

    public $message = 'Unauthenticated.';

    public function __construct()
    {
        parent::__construct($this->httpStatusCode, $this->message);
    }
}
