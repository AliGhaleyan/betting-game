<?php


namespace App\Exceptions;


class ListEmptyException extends \Exception
{
    protected $message = "List of items is empty";
}