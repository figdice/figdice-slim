<?php

namespace figdice\slim;

use figdice\View;
use Psr\Http\Message\ResponseInterface;

class SlimView
{

  /**
   * @var View
   */
  private $view;

  private $templatesDir;

  public function __construct($templatesDir = null)
  {
    $this->view = new View();
    $this->templatesDir = $templatesDir;
  }

  public function getView()
  {
    return $this->view;
  }

  /**
   * Output rendered template
   *
   * @param ResponseInterface $response
   * @param  string $template Template pathname relative to templates directory
   * @param  array $data Associative array of template variables
   * @return ResponseInterface
   */
  public function render(ResponseInterface $response, $template, $data = [])
  {
    $this->view->loadFile(((null !== $this->templatesDir) ? $this->templatesDir.'/' : '') . $template);
    foreach ($data as $key => $value) {
      $this->view->mount($key, $value);
    }

    $response->getBody()->write($this->view->render());
    return $response;
  }
}

