<form method="GET" action="">
    Method:
    <select name="method">
        <option value="GET">GET</option>
        <option value="POST">POST</option>
        <option value="PUT">PUT</option>
        <option value="DELETE">DELETE</option>
        <option value="CLI">CLI</option>
    </select><br />
    URI: <input type="text" name="uri" autocomplete="off"<? if (isset($_GET['uri'])): ?> value="<?= $_GET['uri'] ?>"<? endif; ?> /><br />
    Query: <input type="text" name="query" autocomplete="off"<? if (isset($_GET['query'])): ?> value="<?= $_GET['query'] ?>"<? endif; ?> /><br />
    <input type="submit" />
</form>

<?php

include 'init.php';
    
$router = Michcald\Mvc\Container::get('mvc.router');
echo '<ul>';
foreach ($router->getRoutes() as $route) {
    echo '<li>' . implode(',', $route->getMethods()) . ' - ' . $route->getUri()->getPattern() . '</li>';
}
echo '</ul>';

echo '<hr />';

if (isset($_GET['uri'])) {
    
    echo '<h1>URI: ' . $_GET['uri'] . '</h1>';
    echo '<h2>Query: ' . $_GET['query'] . '</h2>';
    echo '<hr />';

    $request = new Michcald\Mvc\Request();

    parse_str($_GET['query'], $query);
    
    $request->setMethod($_GET['method'])
        ->setUri($_GET['uri'])
        ->setQueryParams($query);

    //$request->setMethod('cli')->setUri('db:schema:install');

    $mvc->run($request);
}
