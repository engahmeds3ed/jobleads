<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaxrateCreateRequest;
use App\Http\Requests\TaxrateUpdateRequest;
use App\Services\TaxrateService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class TaxratesController extends Controller
{
    /**
     * TaxratesController constructor.
     */
    public function __construct(TaxrateService $taxrateService)
    {
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
        $items = $this->taxrateService->all($requestData);
        return view('taxrates.index', compact('items'));
    }

    public function datatableList(Request $request){
        $output = [];
        $allRequest = $request->all();
        $requestData = [];
        $items = $this->taxrateService->all($requestData);

        $output['draw'] = ($allRequest['draw'] ?? 0) + 1;
        $output['recordsTotal'] = $items->count();
        $output['recordsFiltered'] = $items->count();
        $output['data'] = [];
        foreach ($items as $item){
            $output['data'][] = [
                $item->id,
                $item->name,
                $item->code,
                $item->amount,
                "<a href='".route('taxrates.edit', ['taxrate' => $item->id])."'>Edit</a>",
                "<a class='delete' href='".route('taxrates.destroy', ['taxrate' => $item->id])."'>Delete</a>"
            ];
        }

        return response()->json($output);
    }

    public function create(Request $request){

        return view('taxrates.new');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  TaxrateCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     */
    public function store(TaxrateCreateRequest $request)
    {
        try {

            $item = $this->taxrateService->create($request->all());

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
        $item = $this->taxrateService->find($id);

        if (request()->wantsJson()) {
            return response()->json([
                'data' => $item,
            ]);
        }

        return view('taxrates.show', compact('item'));
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
        $item = $this->taxrateService->find($id);

        return view('taxrates.edit', compact('item'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  TaxrateUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(TaxrateUpdateRequest $request, $id)
    {
        try {
            $item = $this->taxrateService->update($request->all(), $id);

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
        $deleted = $this->taxrateService->delete($id);

        if (request()->wantsJson()) {
            return response()->json([
                'message' => 'Item deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'Item deleted.');
    }
}
