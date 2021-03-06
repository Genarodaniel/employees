<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCompanyRequest;
use App\Http\Requests\UpdateCompanyRequest;
use App\Repositories\CompanyRepository;
use App\Repositories\EmployeeRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Flash;
use Response;

class CompanyController extends AppBaseController
{
    /** @var  CompanyRepository */
    private $companyRepository;

    public function __construct(CompanyRepository $companyRepo, EmployeeRepository $employeesRepo)
    {
        $this->companyRepository = $companyRepo;
        $this->employeesRepository = $employeesRepo;
    }

    /**
     * Display a listing of the Company.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        if(!empty($request->input('name'))){
            $companies = $this->companyRepository->all(['user_id' => Auth::user()->id])->where('name', 'LIKE', $request->input('name'));
        }else{
            $companies = $this->companyRepository->all(['user_id' => Auth::user()->id]);
        }

        return view('companies.index')
            ->with('companies', $companies);
    }

    /**
     * Show the form for creating a new Company.
     *
     * @return Response
     */
    public function create()
    {
        return view('companies.create');
    }

    /**
     * Store a newly created Company in storage.
     *
     * @param CreateCompanyRequest $request
     *
     * @return Response
     */
    public function store(CreateCompanyRequest $request)
    {
        $input = $request->all();

        $input['phone'] = (int) preg_replace('/[^\d]*/','',$input['phone']);
        $input['zipCode'] = (int) preg_replace('/[^\d]*/','',$input['zipCode']);

        $company = $this->companyRepository->create($input);

        Flash::success('Company saved successfully.');

        return redirect(route('companies.index'));
    }

    /**
     * Display the specified Company.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id, Request $request)
    {
        $company = $this->companyRepository->find($id);

        if(!empty($request->input('name'))){
            $employees = $this->employeesRepository->all(['company_id' => $id, 'name' => $request->input('name')]);
        }else{
            $employees = $company->employees()->get();
        }

        if (empty($company) || !empty($company->user_id) && $company->user_id != Auth::user()->id) {
            Flash::error('Company not found');

            return redirect(route('companies.index'));
        }

        return view('companies.show')->with(compact('company','employees'));
    }

    /**
     * Show the form for editing the specified Company.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $company = $this->companyRepository->find($id);

        if (empty($company) || !empty($company->user_id) && $company->user_id != Auth::user()->id) {
            Flash::error('Company not found');

            return redirect(route('companies.index'));
        }

        return view('companies.edit')->with('company', $company);
    }

    /**
     * Update the specified Company in storage.
     *
     * @param int $id
     * @param UpdateCompanyRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateCompanyRequest $request)
    {
        $company = $this->companyRepository->find($id);

        if (empty($company) || !empty($company->user_id) && $company->user_id != Auth::user()->id) {
            Flash::error('Company not found');

            return redirect(route('companies.index'));
        }
        $input = $request->all();

        $input['phone'] = (int) preg_replace('/[^\d]*/','',$input['phone']);
        $input['zipCode'] = (int) preg_replace('/[^\d]*/','',$input['zipCode']);

        $company = $this->companyRepository->update($input, $id);

        Flash::success('Company updated successfully.');

        return redirect(route('companies.index'));
    }

    /**
     * Remove the specified Company from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $company = $this->companyRepository->find($id);

        if (empty($company) || !empty($company->user_id) && $company->user_id != Auth::user()->id) {
            Flash::error('Company not found');

            return redirect(route('companies.index'));
        }

        $this->companyRepository->delete($id);

        Flash::success('Company deleted successfully.');

        return redirect(route('companies.index'));
    }
}
