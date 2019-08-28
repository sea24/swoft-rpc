<?php declare(strict_types=1);

namespace App\Http\Controller;


use Swoft\Bean\Annotation\Mapping\Inject;
use Swoft\Context\Context;
use Swoft\Http\Message\ContentType;
use Swoft\Http\Message\Request;
use Swoft\Http\Message\Response;
use Swoft\Http\Server\Annotation\Mapping\Controller;
use Swoft\Http\Server\Annotation\Mapping\RequestMapping;
use Swoft\View\Annotation\Mapping\View;
use Swoft\View\Renderer;

/**
 * Class HomeController
 * @Controller("/home")
 *
 */
class HomeController
{

    /**
     *
     * @Inject("view")
     * @var \view
     */
    private $view;

    /**
     * @RequestMapping("test")
     * @View("home/index")
     * @throws \Throwable
     */
    public function index()
    {
        var_dump($this->view);
        /** @var Renderer $renderer */
        //$renderer = \Swoft::getBean('view');
        //$content  = $renderer->render('home/index');
       /* return Context::mustGet()
            ->getResponse()
            ->withContentType(ContentType::HTML)
            ->withContent($content);
       */
    }

    /**
     * @RequestMapping("/hello[/{name}]")
     * @param string $name
     * @return Response
     * @throws \ReflectionException
     * @throws \Swoft\Bean\Exception\ContainerException
     */
    public function hello(string $name): Response
    {
        return Context::mustGet()
            ->getResponse()
            ->withContent('Hello' . ($name === '' ? '' : ", {$name}"));
    }

    /**
     * @RequestMapping("/ex")
     * @throws \Throwable
     */
    public function ex(): void
    {
        throw new \RuntimeException('exception throw on ' . __METHOD__);
    }

    /**
     * @RequestMapping("/er")
     * @throws \Throwable
     */
    public function er(): void
    {
        \trigger_error('user error', \E_USER_ERROR);
    }
}
