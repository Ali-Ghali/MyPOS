<?php

namespace App\Http\Controllers\Client;

use App\Models\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ClientRequest;

class ClientController extends Controller
{
    public function index(Request $request)
    {
        $clients = Client::when($request->search, function ($q) use ($request) {
            $search = $request->input('search');
            return $q->where('name', 'LIKE', "%{$search}%")
                ->orWhere('phone', 'LIKE', "%{$search}%")
                ->orWhere('address', 'LIKE', "%{$search}%");
        })->latest()->paginate(5);

        return view('dashboard.clients.index', compact('clients'));
    } //end of index


    public function create()
    {
        return view('dashboard.clients.create');
    } //end of create


    public function store(ClientRequest $request)
    {
        try {
            $validated = $request->validated();

            $request_data = $request->all();
            $request_data['phone'] = array_filter($request->phone);

            Client::create($request_data);

            toastr()->success('تم اضافة الزبون بنجاح');
            return redirect()->route('clients.index');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    } //end of store

    public function show($id)
    {
        //
    }

    public function edit(Client $client)
    {
        return view('dashboard.clients.edit', compact('client'));
    } //end of edit

    public function update(ClientRequest $request, Client $client)
    {
        try {
            $validated = $request->validated();

            $request_data = $request->all();
            $request_data['phone'] = array_filter($request->phone);

            $client->update($request_data);
            toastr()->success('تم التعديل بنجاح');
            return redirect()->route('clients.index');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    } //end of update

    public function destroy(Client $client)
    {
        $client->delete();
        toastr()->error(trans('تم الحذف بنجاح'));
        return redirect()->route('clients.index');
    } //end of destroy
}