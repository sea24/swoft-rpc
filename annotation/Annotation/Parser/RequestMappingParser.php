<?php

namespace Annotation\Parser;

use Core\Route;
use Swoft\Annotation\Exception\AnnotationException;
use Swoft\Http\Server\Annotation\Mapping\RequestMapping;

/**
 * Class RequestMappingParser
 *
 * @since 2.0

 */
class RequestMappingParser
{
    /**
     * @param int            $type
     * @param RequestMapping $annotation
     *
     * @return array
     * @throws AnnotationException
     */
    public function parse($routePrefix,$routePath,$handler,$action): array
    {

        //var_dump($annotation->getMethod());
        // Add route info for controller action
       //RouteRegister::addRoute($this->className, $routeInfo);
        Route::addRoute($routePrefix,$routePath,$handler,$action);
        return [];

    }
}
