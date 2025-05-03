<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Report;
use Illuminate\Auth\Access\HandlesAuthorization;

class ReportPolicy
{
    use HandlesAuthorization;

    public function view(User $user, Report $report)
    {
        return $user->isAdmin() || $user->isKetua() || $report->reporter_id == $user->id;
    }

    public function update(User $user, Report $report)
    {
        return $user->isAdmin() || $user->isKetua() || $report->reporter_id == $user->id;
    }

    public function delete(User $user, Report $report)
    {
        return $user->isAdmin() || $user->isKetua();
    }
}