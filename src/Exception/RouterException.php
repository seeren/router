<?php

/**
 * This file contain Seeren\Router\Exception\RouterException interface
 *     __
 *    / /__ __ __ __ __ __
 *   / // // // // // // /
 *  /_// // // // // // /
 *    /_//_//_//_//_//_/
 *
 * @copyright (c) Cyril Ichti <consultant@seeren.fr>
 * @link http://www.seeren.fr/ Seeren
 * @version 1.0.1
 */

namespace Seeren\Router\Exception;

use Exception;

/**
 * Class for represent a router exception
 * 
 * @category Seeren
 * @package Router
 * @subpackage Exception
 */
class RouterException extends Exception
{

   /**
    * Construct RouterException
    * 
    * @param string $message message
    * @param int $code code
    * @param Exception $previous previous exception
    * @return null
    */
   public function __construct(
       string $message,
       int $code = E_NOTICE,
       Exception $previous = null)
   {
       parent::__construct($message, $code, $previous);
   }

}
