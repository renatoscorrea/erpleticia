<?php

if(version_compare(PHP_VERSION, '7.1.1') == -1)
{
    die('The minimum version required for PHP is 7.1.0');
}

if (!file_exists('app/config/application.ini'))
{
    die('Application configuration file not found');
}