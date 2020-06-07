<?php

namespace Marshmallow\HelperFunctions;

use Illuminate\Foundation\Auth\User as Authenticatable;

class UserHelper
{
    public function isMarshmallow(Authenticatable $user)
    {
        return in_array($user->email, [
            'stef@marshmallow.dev',
        ]);
    }
}
