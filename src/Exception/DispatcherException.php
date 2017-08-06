<?php

/**
 * This file contain Seeren\Router\Exception\DispatcherException interface
 *     __
 *    / /__ __ __ __ __ __
 *   / // // // // // // /
 *  /_// // // // // // /
 *    /_//_//_//_//_//_/
 *
 * @copyright (c) Cyril Ichti <consultant@seeren.fr>
 * @link https://github.com/seeren/router
 * @version 1.0.1
 */

namespace Seeren\Router\Exception;

use Exception;

/**
 * Class for represent a dispatcher exception
 * 
 * @category Seeren
 * @package Router
 * @subpackage Exception
 */
class DispatcherException extends Exception
{

   /**
    * Construct DispatcherException
    * 
    * @param string $message message
    * @param int $code code
    * @param Exception $previous previous exception
    * @return null
    */
   public function __construct(
       string $message,
       int $code = E_WARNING,
       Exception $previous = null)
   {
       parent::__construct($message, $code, $previous);
   }

}
