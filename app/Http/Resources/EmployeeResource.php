<?php

namespace App\Http\Resources;

use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;

class EmployeeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request): array|\JsonSerializable|\Illuminate\Contracts\Support\Arrayable
    {
        /** @var User $employee */
        $employee = $this->resource;
        return [
            'id' => (string)$employee->id,
            'attributes' => [
                'staff_id' => $employee->staff_id,
                'full_name' => $employee->full_name,
                'age' => $employee->age,
                'date_of_birth' => $employee->date_of_birth,
                'date_off_appointment' => $employee->date_of_appointment,
                'date_of_exit' => $employee->date_of_exit,
                'created_at' => $employee->created_at,
            ],
            'relationships' => [
                'branch' => $this->whenLoaded('branch', $employee->branch),
                'role' => $this->whenLoaded('role', $employee->role),
            ]
        ];
    }
}
