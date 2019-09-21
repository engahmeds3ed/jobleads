<?php

namespace App\Http\Controllers;

use App\Http\Requests\CountyCreateRequest;
use App\Http\Requests\CountyUpdateRequest;
use App\Services\CountryService;
use App\Services\CountyService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CountiesController extends Controller
{
    /**
     * CountiesController constructor.
     */
    public function __construct(CountyService $countyService, CountryService $countryService)
    {
        $this->countyService = $countyService;
        $this->countryService = $countryService;
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
        $items = $this->countyService->all($requestData);
        return view('counties.index', compact('items'));
    }

    public function datatableList(Request $request){
        $output = [];
        $allRequest = $request->all();
        $requestData = [];
        $items = $this->countyService->all($requestData);

        $output['draw'] = ($allRequest['draw'] ?? 0) + 1;
        $output['recordsTotal'] = $items->count();
        $output['recordsFiltered'] = $items->count();
        $output['data'] = [];
        foreach ($items as $item){
            $output['data'][] = [
                $item->id,
                $item->name,
                $item->code,
                $item->taxrates_avg,
                $item->state->name,
                $item->state->country->name,
                "<a href='".route('counties.edit', ['county' => $item->id])."'>Edit</a>",
                "<a class='delete' href='".route('counties.destroy', ['county' => $item->id])."'>Delete</a>"
            ];
        }

        return response()->json($output);
    }

    public function create(Request $request)
    {
        $countries = $this->countryService->all(['paginate' => false]);
        return view('counties.new', compact('countries'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CountyCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     */
    public function store(CountyCreateRequest $request)
    {
        try {

            $item = $this->countyService->create($request->all());

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
        $item = $this->countyService->find($id);

        if (request()->wantsJson()) {
            return response()->json([
                'data' => $item,
            ]);
        }

        return view('counties.show', compact('item'));
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
        $item = $this->countyService->find($id);
        $countries = $this->countryService->all(['paginate' => false]);

        return view('counties.edit', compact('item', 'countries'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  CountyUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(CountyUpdateRequest $request, $id)
    {
        try {
            $item = $this->countyService->update($request->all(), $id);

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
        $deleted = $this->countyService->delete($id);

        if (request()->wantsJson()) {
            return response()->json([
                'message' => 'Item deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'Item deleted.');
    }
}
