<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OffreEmplois;
use App\Models\Condidatures;

use App\Models\Societe;
use Illuminate\Support\Facades\DB;

class OffredemploiController extends Controller
{
  public function index()
  {
      $offres = OffreEmplois::select('*', DB::raw('(SELECT COUNT(*) FROM condidatures WHERE offre_emploi_id = offre_emplois.id) as candidature_count'))->paginate(6);

      return view('offredemploi.offredemploi', ['offres' => $offres]);
  }
    public function create()
{   $societes = Societe::all();
    return view('offredemploi.create',['societes' => $societes]);
}

public function frontoffre()
{
  $offres = OffreEmplois::paginate(10);

        return view('offredemploi.frontofficeoffice', ['offres' => $offres]);
}


public function edit($id)
{
    $OffreEmplois = OffreEmplois::find($id);

    if (!$OffreEmplois) {
        abort(404);
    }

    $societes = Societe::all(); // Retrieve the societes data

    return view('offredemploi.edit', compact('OffreEmplois', 'societes'));
}



public function store(Request $request)
{
  $request->validate([
  'titre' => 'required|string|max:255',
  'emplacement' => 'required|string|max:255',
  'Type' => 'required|string|max:255',
  'apropos' => 'required|string',
  'salaire' => 'required|numeric',
]);

// Create a new offer with the request data
$offerData = $request->only(['titre', 'emplacement', 'Type', 'apropos', 'salaire']);

// Check if societe_id is provided in the request; if not, set a default value
$offerData['societe_id'] = $request->input('societe_id', 1); // Set your desired default value here

// Create the offer
OffreEmplois::create($offerData);

// Redirect to the index page or return a view as needed
return redirect('offre');


}




    public function destroy($id)
    {
        $offre = OffreEmplois::find($id);

        $offre->delete();
        return redirect('offre'); // You can change the redirection URL as needed
    }




    public function update(Request $request, $id)
    {
        $offre = OffreEmplois::find($id);

        if (!$offre) {
            return redirect()->route('offre.index')->with('error', 'Offre not found.');
        }

        $request->validate([
            'titre' => 'required|string|max:255',
            'societe_id' => 'required|exists:societes,id',
            'emplacement' => 'required|string',
            'Type' => 'required|string',
            'apropos' => 'required|string',
            'salaire' => 'required|numeric',
        ]);

        $offre->update($request->all());

        return redirect('offre')->with('success', 'Offre updated successfully');
    }


    public function showCandidatures($id)
    {
        $offre = OffreEmplois::findOrFail($id);

        $candidatures = DB::table('condidatures')
            ->where('offre_emploi_id', $offre->id)
            ->get();

            return view('offredemploi.candidatures', compact('offre', 'candidatures'));

             }




}
