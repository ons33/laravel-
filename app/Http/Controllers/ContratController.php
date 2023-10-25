<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contrats;
use App\Models\OffreEmplois;
use App\Models\Condidatures;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;

class ContratController extends Controller
{
  
    
    
    public function showAll()
    {
        $contrats = Contrats::with(['condidatures'])->get();

        return view('contrat.showAll', compact('contrats'));
    }
 

    public function createContrat($id)
    {
        $condidature = Condidatures::findOrFail($id);

        return view('contrat.add_contract_form', ['condidature' => $condidature]);
    }

    public function addContract(Request $request, $condidature_id)
    {
        // Validate the request data
        $request->validate([
            'type' => 'required|string|max:255',
            'duree' => 'required|string|max:255',
            'salaire' => 'required|string|max:255',
            'date_debut' => 'required|date',
            'date_fin' => 'required|date',
            'description' => 'required|string|max:255',
            'etat' => 'required|string|max:255',
        ]);

        // Create a new contrat
        $contrat = new Contrats;
        $contrat->type = $request->type;
        $contrat->duree = $request->duree;
        $contrat->salaire = $request->salaire;
        $contrat->date_debut = $request->date_debut;
        $contrat->date_fin = $request->date_fin;
        $contrat->description = $request->description;
        $contrat->etat = $request->etat;
        $contrat->condidature_id = $condidature_id;
        $contrat->save();

        // Generate the PDF for the contract
        $this->generatePDF($contrat->id);

        // Optionally, redirect or return a response indicating success
        return redirect()->route('contrats.showAll')->with('success', 'Contrat ajouté avec succès.');
    }

    public function generatePDF($contract)
    {
        // Obtenez les données du contrat (vous devrez adapter ceci selon votre structure de données)
        $contractData = Contrats::findOrFail($contract);

        // Créez une instance de Dompdf
        $pdf = new Dompdf();

        // Options pour la configuration de Dompdf (facultatif)
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $pdf->setOptions($options);

        // Contenu du PDF (vous devrez adapter ceci selon votre besoin)
        $html = view('contrat.pdf', compact('contractData'));

        // Chargez le contenu HTML dans Dompdf
        $pdf->loadHtml($html);

        // Rendu du PDF
        $pdf->render();

        // Retournez le PDF en tant que réponse HTTP
        return $pdf->stream('contrat.pdf');
    }
    public function getContractPDF($contractId)
    {
        // Retrieve the contract data
        $contractData = Contrats::findOrFail($contractId);

        // Create a new instance of Dompdf
        $pdf = new Dompdf();

        // Set options for Dompdf (if needed)
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $pdf->setOptions($options);

        // Load the HTML content into Dompdf
        $html = view('contrat.pdf', compact('contractData'));
        $pdf->loadHtml($html);

        // Render the PDF
        $pdf->render();

        // Return the PDF as an HTTP response
        return $pdf->stream('contrat.pdf');
    }
    
        public function destroy($id)
    {
        $contract = Contrats::findOrFail($id);
        if (!  $contract) {
            abort(404); // condidature not found
        }

        $contract->delete();
        return  redirect('/contrats');
    }

}
