<?php

namespace App\Http\Controllers;

use App\Http\Requests\StateCreateRequest;
use App\Http\Requests\StateUpdateRequest;
use App\Services\CountryService;
use App\Services\StateService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class StatesController extends Controller
{
    /**
     * StatesController constructor.
     */
    public function __construct(StateService $stateService, CountryService $countryService)
    {
        $this->stateService = $stateService;
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
        $items = $this->stateService->all($requestData);
        return view('states.index', compact('items'));
    }

    public function datatableList(Request $request){
        $output = [];
        $allRequest = $request->all();
        $requestData = [];
        $items = $this->stateService->all($requestData);

        $output['draw'] = ($allRequest['draw'] ?? 0) + 1;
        $output['recordsTotal'] = $items->count();
        $output['recordsFiltered'] = $items->count();
        $output['data'] = [];
        foreach ($items as $item){
            $output['data'][] = [
                $item->id,
                $item->name,
                $item->code,
                $item->country->name,
                "<a href='".route('states.edit', ['state' => $item->id])."'>Edit</a>",
                "<a class='delete' href='".route('states.destroy', ['country' => $item->id])."'>Delete</a>"
            ];
        }

        return response()->json($output);
    }

    public function create(Request $request)
    {
        $countries = $this->countryService->namedIDvalues();
        return view('states.new', compact('countries'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StateCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     */
    public function store(StateCreateRequest $request)
    {
        try {

            $item = $this->stateService->create($request->all());

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
        $item = $this->stateService->find($id);

        if (request()->wantsJson()) {
            return response()->json([
                'data' => $item,
            ]);
        }

        return view('states.show', compact('item'));
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
        $item = $this->stateService->find($id);
        $countries = $this->countryService->namedIDvalues();

        return view('states.edit', compact('item', 'countries'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  StateUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(StateUpdateRequest $request, $id)
    {
        try {
            $item = $this->stateService->update($request->all(), $id);

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
        $deleted = $this->stateService->delete($id);

        if (request()->wantsJson()) {
            return response()->json([
                'message' => 'Item deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'Item deleted.');
    }
}
