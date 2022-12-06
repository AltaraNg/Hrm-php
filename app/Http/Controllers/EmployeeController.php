<?php

namespace App\Http\Controllers;

use App\Http\Resources\EmployeeCollection;
use App\Http\Resources\EmployeeResource;
use App\Models\User;
use App\Repositories\Eloquent\Repository\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class EmployeeController extends Controller
{
    public function __construct(private readonly UserRepository $userRepository)
    {
    }

    public function index(): Response
    {
        $employees = $this->userRepository->filter()->orderBy('created_at')->paginate();
        return $this->sendSuccess([ new EmployeeCollection($employees)], 'Employees fetch successfully');
    }

    public function show(User $employee): Response
    {
        return $this->sendSuccess(['employees' => new EmployeeResource($employee->load('branch'))], 'Employees fetch successfully');
    }
}
