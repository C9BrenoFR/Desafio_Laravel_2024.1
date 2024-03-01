<?php

namespace App\Policies;

use App\Models\Surgery;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class SurgeryPolicy
{
    public function view(User $user, Surgery $surgery): bool
    {
        return $user->id === $surgery->patient_id;
    }

    public function delete(User $user, Surgery $surgery): bool
    {
        return $user->id === $surgery->patient_id;
    }

    
}
