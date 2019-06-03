<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use Closure;
use GrahamCampbell\Throttle\Throttle;
use Symfony\Component\HttpKernel\Exception\TooManyRequestsHttpException;

/**
 * Class RequestThrottleMiddleware
 * @package App\Http\Middleware
 */
class RequestThrottleMiddleware
{
    /**
     * @var Throttle
     */
    protected $throttle;

    /**
     * RequestThrottleMiddleware constructor.
     * @param Throttle $throttle
     */
    public function __construct(Throttle $throttle)
    {
        $this->throttle = $throttle;
    }

    /**
     * @param $request
     * @param Closure $next
     * @param int $limit
     * @param int $time
     * @return mixed
     */
    public function handle($request, Closure $next, $limit = 10, $time = 60)
    {
        if (!$this->throttle->attempt($request, (int) $limit, (int) $time)) {
            throw new TooManyRequestsHttpException($time * 60, 'Rate limit exceeded.');
        }

        return $next($request);
    }
}
