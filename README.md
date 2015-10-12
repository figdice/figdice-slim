# figdice-slim
*Slim Framework Delegate for FigDice View*

Container (DI) View component for the [Slim Framework 3](http://www.slimframework.com/), that wires FigDice Templating library into Slim.

Read [Slim Views](http://www.slimframework.com/docs/features/templates.html) Documentation for more details.

## Usage

### 1. Register FigDice SlimView component in Slim container
~~~~php
// Create container
$container = new \Slim\Container;

// Register component on container
$container['view'] = function ($c) {
  $view = new \figdice\slim\SlimView('path/to/templates');
  
  // Optionally configure FigDice View settings
  // (cache directory, dictionaries, feed & function factories, etc.)
  $view->getView()->setTempPath('path/to/cache');
  $view->getView()->registerFeedFactory( new MyFeedFactory(...) );
  // ...
  
  return $view;
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
