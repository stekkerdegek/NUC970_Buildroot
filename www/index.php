<?php

require_once('lib/limonade.php');

function configure() {
    $env = $_SERVER['HTTP_HOST'] == 'library.dev' ? ENV_DEVELOPMENT : ENV_PRODUCTION;
    $dsn = $env == ENV_PRODUCTION ? 'sqlite:db/dev.db' : 'sqlite:db/dev.db';
    $db = new PDO($dsn);
    $db->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING );
    option('env', $env);
    option('dsn', $dsn);
    option('db_conn', $db);
    option('debug', true);
}

function after($output) {
    $time = number_format( (float)substr(microtime(), 0, 10) - LIM_START_MICROTIME, 6);
    $output .= "<!-- page rendered in $time sec., on " . date(DATE_RFC822)."-->";
    return $output;
}

function not_found($errno, $errstr, $errfile=null, $errline=null)
{
  $html = '<p><img src="'
        //. public_url_for('/img/error-404.jpg')
        . '" alt="Fout 404: '
        . h($errstr)
        . '"></p>';
  set('title', 'FOUT 404');
  return html($html);
}

function server_error($errno, $errstr, $errfile=null, $errline=null)
{
  $html = '<p>'
        . $errno . "<br>"
        . $errstr . "<br>"
        . $errfile . "<br>"
        . $errline . "<br>"
        . '</p>';
  set('title', 'FOUT 500');
  return html($html);
}

layout('layout/default.html.php');

// main controller
dispatch('/', 'main_page');
dispatch('dash', 'dashboard_page');
function dashboard_page() {
    return html('dashboard.html.php');
}
dispatch('doors', 'doors_page');
function doors_page() {
    return html('doors.html.php');
}
dispatch('events', 'events_page');
function events_page() {
    return html('events.html.php');
}
dispatch('groups', 'groups_page');
function groups_page() {
    return html('groups.html.php');
}
dispatch('reports', 'reports_page');
function reports_page() {
    return html('reports.html.php');
}
dispatch('timezones', 'timezones_page');
function timezones_page() {
    return html('timezones.html.php');
}
dispatch('users', 'users_page');
function users_page() {
    return html('users.html.php');
}
//dispatch('info', phpinfo());


// books controller
dispatch_get   ('books',          'books_index');
dispatch_post  ('books',          'books_create');
dispatch_get   ('books/new',      'books_new');
dispatch_get   ('books/:id/edit', 'books_edit');
dispatch_get   ('books/:id',      'books_show');
dispatch_put   ('books/:id',      'books_update');
dispatch_delete('books/:id',      'books_destroy');

// authors controller
dispatch_get   ('authors',          'authors_index');
dispatch_post  ('authors',          'authors_create');
dispatch_get   ('authors/new',      'authors_new');
dispatch_get   ('authors/:id/edit', 'authors_edit');
dispatch_get   ('authors/:id',      'authors_show');
dispatch_put   ('authors/:id',      'authors_update');
dispatch_delete('authors/:id',      'authors_destroy');

run();
