<?php

namespace App\Filters;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;

class UserBuilder extends Builder
{
    public function whereName(string $name = null): static
    {
        if ($name == null) return $this;
        $this->where('full_name', $name);
        return $this;
    }

    public function whereLocation(string $location = null): static
    {
        if ($location == null) return $this;
        $this->where('address', 'like', '%' . $location . '%');
        return $this;
    }

    public function whereEmail(string $email = null): static
    {
        if ($email == null) return $this;
        $this->where('email', $email);
        return $this;
    }
    public function whereRole(int $role = null): static
    {
        if ($role == null) return $this;
        $this->role($role);
        return $this;
    }
}
