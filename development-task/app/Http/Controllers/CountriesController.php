<?php

namespace App\Http\Controllers;

use App\Http\Requests\CountryCreateRequest;
use App\Http\Requests\CountryUpdateRequest;
use App\Services\CountryService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CountriesController extends Controller
{
    /**
     * CountriesController constructor.
     */
    public function __construct(CountryService $countryService)
    {
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
        $items = $this->countryService->all($requestData);
        return view('countries.index', compact('items'));
    }

    public function datatableList(Request $request){
        $output = [];
        $allRequest = $request->all();
        $requestData = [];
        $items = $this->countryService->all($requestData);

        $output['draw'] = ($allRequest['draw'] ?? 0) + 1;
        $output['recordsTotal'] = $items->count();
        $output['recordsFiltered'] = $items->count();
        $output['data'] = [];
        foreach ($items as $item){
            $output['data'][] = [
                $item->id,
                $item->name,
                $item->code,
                "<a href='".route('countries.edit', ['country' => $item->id])."'>Edit</a>",
                "<a class='delete' href='".route('countries.destroy', ['country' => $item->id])."'>Delete</a>"
            ];
        }

        return response()->json($output);
    }

    public function create(Request $request){

        return view('countries.new');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CountryCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     */
    public function store(CountryCreateRequest $request)
    {
        try {

            $item = $this->countryService->create($request->all());

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
        $item = $this->countryService->find($id);

        if (request()->wantsJson()) {
            return response()->json([
                'data' => $item,
            ]);
        }

        return view('countries.show', compact('item'));
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
        $item = $this->countryService->find($id);

        return view('countries.edit', compact('item'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  CountryUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(CountryUpdateRequest $request, $id)
    {
        try {
            $item = $this->countryService->update($request->all(), $id);

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
        $deleted = $this->countryService->delete($id);

        if (request()->wantsJson()) {
            return response()->json([
                'message' => 'Item deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'Item deleted.');
    }
}
