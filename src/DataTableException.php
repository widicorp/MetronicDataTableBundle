<?php
namespace Widicorp\MetronicDataTableBundle;

use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

/**
 * Exception in last DataTable request handling.
 * Contains HTTP status code and can be used in HTTP Response object.
 */
class DataTableException extends BadRequestHttpException
{
    /**
     * {@inheritdoc}
     */
    public function __construct($message, $code = 0, \Exception $previous = null)
    {
        parent::__construct($message, $previous, $code);
    }
}
