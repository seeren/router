<?php

namespace Seeren\Router\Test;

function filter_input(
    int $type,
    string $variable_name,
    int $filter = FILTER_DEFAULT,
    array $options = null)
{
    if (INPUT_SERVER === $type) {
        if ('REQUEST_SCHEME' === $variable_name) {
            return 'http';
        } elseif ('SERVER_NAME' === $variable_name) {
            return 'host';
        }
        if ('REQUEST_URI' === $variable_name) {
            return '/foo/2';
        }
        if ('REQUEST_METHOD' === $variable_name) {
            return 'GET';
        }
    }
    return \filter_input($type, $variable_name, $filter, $options);
}

namespace Seeren\Router\Matcher;

function filter_input(int $type, string $variable_name, int $filter = FILTER_DEFAULT, array $options = null)
{
    return \Seeren\Router\Test\filter_input($type, $variable_name, $filter, $options);
}

namespace Seeren\Http\Uri;

function filter_input(int $type, string $variable_name, int $filter = FILTER_DEFAULT, array $options = null)
{
    return \Seeren\Router\Test\filter_input($type, $variable_name, $filter, $options);
}
