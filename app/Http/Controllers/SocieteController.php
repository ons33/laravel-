<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Societe;
class SocieteController extends Controller
{
    /**
     * Display a listing of the resource.
     *

     */
    public function index()
    {
         $societes = Societe::paginate(6);

        return view('societes.societe', ['societes' => $societes]);
    }

    /**
     * Show the form for creating a new resource.
     *
     *
     */
    public function create()
{
    return view('societes.create');
}

    /**
     * Store a newly created resource in storage.
     *
     *
     */
    public function store(Request $request)
{
    // Validate the form data
    $request->validate([
        'name' => 'required|string|max:255',
        'address' => 'required|string',
        'phone_number' => 'required|string',
        'email' => 'required|email',
    ]);

    // Create a new societe with the validated data
    Societe::create([
        'name' => $request->input('name'),
        'address' => $request->input('address'),
        'phone_number' => $request->input('phone_number'),
        'email' => $request->input('email'),
    ]);

    // Redirect to a success page or the index page
    return redirect('societe'); // You can adjust the redirect URL as needed
}
    /**
     * Remove the specified resource from storage.
     *

     */
    public function destroyy($id)
    {
        $societe = Societe::find($id);

        if (!$societe) {
            return redirect('societe')->with('error', 'Societe not found.');
        }

        $societe->delete();

        return redirect('societe')->with('success', 'Societe deleted successfully');
    }
    public function edit($id)
    {
        $societe = Societe::find($id);

        if (!$societe) {
            return redirect()->route('societes.societe')->with('error', 'Societe not found.');
        }

        return view('societes.edit', compact('societe'));
    }

    public function update(Request $request, $id)
    {
        $societe = Societe::find($id);

        if (!$societe) {
            return redirect()->route('societes.societe')->with('error', 'Societe not found.');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string',
            'phone_number' => 'required|string',
            'email' => 'required|email',
        ]);

        $societe->update([
            'name' => $request->input('name'),
            'address' => $request->input('address'),
            'phone_number' => $request->input('phone_number'),
            'email' => $request->input('email'),
        ]);

        return redirect('societe')->with('success', 'Societe updated successfully');
    }

}
