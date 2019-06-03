<?php

namespace Modules\Core\Exceptions;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException as SymfonyHttpException;

/**
 * Class NotFoundException
 *
 * @author  luffy007  <285276792@qq.com>
 */
class NotFoundException extends SymfonyHttpException
{
    public $httpStatusCode = Response::HTTP_NOT_FOUND;

    public $message = 'The requested Resource was not found.';

    public function __construct()
    {
        parent::__construct($this->httpStatusCode, $this->message);
    }
}
