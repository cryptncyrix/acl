<?php declare(strict_types=1);
namespace cyrixbiz\acl\Exceptions\Acl;

use Exception;
use Illuminate\Support\Facades\Log;

class AclException extends Exception
{
    public function report()
    {
        Log::debug('AclException' );
    }
}