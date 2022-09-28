<?php
/**
 * TokenNotFoundException.
 */

namespace Bmatovu\OAuthNegotiator\Exceptions;

/**
 * Class TokenNotFoundException.
 */
class TokenNotFoundException extends \RuntimeException
{
    /**
     * Constructor.
     *
     * @param string     $message
     * @param int        $code
     * @param \Exception $previous
     */
    public function __construct($message, $code = 0, $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
