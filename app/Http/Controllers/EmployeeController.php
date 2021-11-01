<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;
use App\Repositories\EmployeeRepository;
use App\Repositories\CompanyRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class EmployeeController extends AppBaseController
{
    /** @var  EmployeeRepository */
    private $employeeRepository;

    public function __construct(EmployeeRepository $employeeRepo, CompanyRepository $companyRepo)
    {
        $this->companyRepository = $companyRepo;
        $this->employeeRepository = $employeeRepo;
    }

    /**
     * Display a listing of the Employee.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $employees = $this->employeeRepository->all();

        return view('employees.index')
            ->with('employees', $employees);
    }

    /**
     * Show the form for creating a new Employee.
     *
     * @return Response
     */
    public function create(Request $request)
    {
        $company = $this->companyRepository->find($request->input('company_id'));
        return view('employees.create')->with(compact('company'));
    }

    /**
     * Store a newly created Employee in storage.
     *
     * @param CreateEmployeeRequest $request
     *
     * @return Response
     */
    public function store(CreateEmployeeRequest $request)
    {
        $input = $request->all();

        $this->employeeRepository->create($input);
        $company = $this->companyRepository->find($input['company_id']);
        $employees = $company->employees()->get();
        Flash::success('Employee saved successfully.');

        return view('companies.show')->with(compact('company','employees'));
    }

    /**
     * Display the specified Employee.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $employee = $this->employeeRepository->find($id);
        if (empty($employee)) {
            Flash::error('Employee not found');

            return redirect(route('employees.index'));
        }

        $company = $this->companyRepository->find($employee->company_id);

        return view('employees.show')->with(compact('employee','company'));
    }

    /**
     * Show the form for editing the specified Employee.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $employee = $this->employeeRepository->find($id);

        if (empty($employee)) {
            Flash::error('Employee not found');

            return redirect(route('employees.index'));
        }
        $employee->wage = (float)str_replace('.',',',$employee->wage);
        $company = $this->companyRepository->find($employee->company_id);

        return view('employees.edit')->with(compact('employee','company'));
    }

    /**
     * Update the specified Employee in storage.
     *
     * @param int $id
     * @param UpdateEmployeeRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateEmployeeRequest $request)
    {
        $employee = $this->employeeRepository->find($id);

        if (empty($employee)) {
            Flash::error('Employee not found');

            return redirect(route('employees.index'));
        }

        $company = $this->companyRepository->find($employee->company_id);
        $employee = $this->employeeRepository->update($request->all(), $id);
        $employees = $this->employeeRepository->all(['company_id' => $employee->company_id]);

        Flash::success('Employee updated successfully.');

        return view('companies.show')->with(compact('company','employees'));
    }

    /**
     * Remove the specified Employee from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $employee = $this->employeeRepository->find($id);

        if (empty($employee)) {
            Flash::error('Employee not found');

            return redirect(route('employees.index'));
        }

        $company = $this->companyRepository->find($employee->company_id);
        $this->employeeRepository->delete($id);
        $employees = $this->employeeRepository->all(['company_id' => $employee->company_id]);

        Flash::success('Employee deleted successfully.');

        return view('companies.show')->with(compact('company','employees'));
    }
}
