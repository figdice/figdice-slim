# figdice-slim
*Slim Framework 3 Delegate for FigDice View*

Container (DI) View component for the [Slim Framework 3](http://www.slimframework.com/), that wires FigDice Templating library into Slim.

Read [Slim Views](http://www.slimframework.com/docs/features/templates.html) Documentation for more details.

## Installation

In composer.json:
~~~~javascript
"require": {
  "figdice/slim-view": "*"
}
~~~~

## Usage

### 1. Register FigDice SlimView component in Slim container
~~~~php
// Create container
$container = new \Slim\Container;

// Register component on container
$container['view'] = function ($c) {
  $slimview = new \figdice\slim\SlimView('path/to/templates');
  
  // Optionally configure FigDice View settings
  // (cache directory, dictionaries, feed & function factories, etc.)
  $slimview->getView()->setTempPath('path/to/cache');
  $slimview->getView()->registerFeedFactory( new MyFeedFactory(...) );
  // ...
  
  return $slimview;
};
~~~~

### 2. Render FigDice templates in Slim routes
~~~~php
// Create app
$app = new \Slim\App($container);

// Render FigDice template in route
$app->get('/hello/{name}', function ($request, $response, $args) {
    return $this->view->render($response, 'profile.html', [
        'name' => $args['name']
    ]);
});

// Run app
$app->run();
~~~~
