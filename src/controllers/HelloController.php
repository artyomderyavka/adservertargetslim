<?php
/**
 * Created by PhpStorm.
 * Date: 27.07.2017
 * Time: 14:56
 */

namespace Services\Target\Controller;


use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use \AdServer\Controller as Controller;


class HelloController extends Controller
{
    /**
     * @param Request $request
     * @param Response $response
     * @return Response
     */
    public function hello(Request $request, Response $response, $arguments) {
        $name = $request->getAttribute('name');
        $response->getBody()->write("Hello from TARGET, $name");

        return $response;
    }

    public function goodbye(Request $request, Response $response, $arguments) {
        $name = $request->getAttribute('name');

        $contentServiceClient = $this->getContainer()->get("contentServiceClient");
        $serviceResponseJson = $contentServiceClient->callService('GET', '/content/goodbye/' . $name,  '', [], [], "");
        $serviceResponse = json_decode($serviceResponseJson->getBody());

        $data = new \StdClass();
        $data->message = "Goodbye from TARGET, $name. " . $serviceResponse->message;

        return $response->withJson($data);
   }
}