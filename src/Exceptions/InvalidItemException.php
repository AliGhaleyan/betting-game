<?php


namespace App\Exceptions;


class InvalidItemException extends \Exception
{
    protected $message = "Invalid push item";
}