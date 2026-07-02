<?php

namespace App\Policies;

use App\Models\FormSubmission;
use App\Models\User;

class FormSubmissionPolicy
{
    public function view(User $user, FormSubmission $submission): bool
    {
        return $user->id === $submission->submitter_id || $user->isAdmin() || $user->canApprove();
    }
}
