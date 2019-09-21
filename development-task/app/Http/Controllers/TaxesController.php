<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaxCreateRequest;
use App\Http\Requests\TaxUpdateRequest;
use App\Services\CountryService;
use App\Services\TaxrateService;
use App\Services\TaxService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class TaxesController extends Controller
{
    /**
     * CountiesController constructor.
     */
    public function __construct(TaxService $taxService, CountryService $countryService, TaxrateService $taxrateService)
    {
        $this->taxService = $taxService;
        $this->countryService = $countryService;
        $this->taxrateService = $taxrateService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $requestData = [
            'paginate' => true,
            'per_page' => 10
        ];
        $items = $this->taxService->all($requestData);
        return view('taxes.index', compact('items'));
    }

    public function datatableList(Request $request){
        $output = [];
        $allRequest = $request->all();
        $requestData = [];
        $items = $this->taxService->all($requestData);

        $output['draw'] = ($allRequest['draw'] ?? 0) + 1;
        $output['recordsTotal'] = $items->count();
        $output['recordsFiltered'] = $items->count();
        $output['data'] = [];
        foreach ($items as $item){
            $output['data'][] = [
                $item->id,
                $item->amount,
                $item->county->name,
                $item->county->state->name,
                $item->county->state->country->name,
                "<a href='".route('taxes.edit', ['tax' => $item->id])."'>Edit</a>",
                "<a class='delete' href='".route('taxes.destroy', ['tax' => $item->id])."'>Delete</a>"
            ];
        }

        return response()->json($output);
    }

    public function create(Request $request)
    {
        $countries = $this->countryService->all(['paginate' => false]);
        $taxrates = $this->taxrateService->namedIDvalues();
        return view('taxes.new', compact('countries', 'taxrates'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  TaxCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     */
    public function store(TaxCreateRequest $request)
    {
        try {

            $item = $this->taxService->create($request->all());

            $response = [
                'message' => 'Item created.',
                'data'    => $item->toArray(),
            ];

            if ($request->wantsJson()) {
                return response()->json($response);
            }

            return redirect()->back()->with('message', $response['message']);
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item = $this->taxService->find($id);

        if (request()->wantsJson()) {
            return response()->json([
                'data' => $item,
            ]);
        }

        return view('taxes.show', compact('item'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = $this->taxService->find($id);
        $countries = $this->countryService->all(['paginate' => false]);
        $taxrates = $this->taxrateService->namedIDvalues();

        return view('taxes.edit', compact('item', 'countries', 'taxrates'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  TaxUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(TaxUpdateRequest $request, $id)
    {
        try {
            $item = $this->taxService->update($request->all(), $id);

            $response = [
                'message' => 'Item updated successfully',
                'data'    => $item->toArray(),
            ];
        } catch (\Exception $e) {
            $response = [
                'message' => "Error while updating item!"
            ];
        }

        Session::flash('message', $response['message']);

        return redirect()->back();
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleted = $this->taxService->delete($id);

        if (request()->wantsJson()) {
            return response()->json([
                'message' => 'Item deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'Item deleted.');
    }
}
