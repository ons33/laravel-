<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Condidatures;
use DB;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use App\Models\OffreEmplois;
use Dompdf\Dompdf;
use Dompdf\Options;

class CondidatureController extends Controller
{
    public function render()
    {
        $condidatures = Condidatures::all();
        return view('Condidature.jobapplicants', ['condidatures' => $condidatures]);
    }
    public function apply()
    {
        $offreEmplois = OffreEmplois::all(); // Fetch all job offers
        return view('Condidature.condidature', ['offreEmplois' => $offreEmplois]);
    }


    public function destroy($id)
    {
        $condidature = Condidatures::find($id);
        if (!$condidature) {
            abort(404); // condidature not found
        }

        $condidature->delete();
        return  redirect('/apply');
    }

    public function downloadCV($id) {
        // Find the specific Condidature by ID
        $condidature = Condidatures::find($id);

        if (!$condidature) {
            // Handle the case where the Condidature with the specified ID doesn't exist
            return abort(404);
        }

        // Get the CV filename from the Condidature
        $filename = $condidature->cv_upload;

        // Construct the full path to the file
        $pathToFile = public_path("images/{$filename}");

        // Log the file path for debugging
        \Log::info("File path: " . $pathToFile);

        // Check if the file exists
        if (!File::exists($pathToFile)) {
            // Handle the case where the file doesn't exist
            \Log::error("File does not exist.");
            return abort(404);
        }

        // Provide the file for download
        return response()->download($pathToFile);
    }

    public function create($id)
    {
        $offre  = OffreEmplois::findOrFail($id);  // Corrected to OffreEmplois
        return view('Condidature.addCondidature',  ['offre' => $offre]);
    }

public function applyJobSaveRecord(Request $request, $offre_emploi_id)
{
    $request->validate([
        'job_title' => 'required|string|max:255',
        'name'      => 'required|string|max:255',
        'phone'     => 'required|string|max:255',
        'email'     => 'required|string|email',
        'message'   => 'required|string|max:255',
        'cv_upload' => 'required',
    ]);

    DB::beginTransaction();
    try {
        /** upload file */
        $cv_uploads = time().'.'.$request->cv_upload->extension();
        $request->cv_upload->move(public_path('/images'), $cv_uploads);

        $apply_job = new Condidatures;
        $apply_job->job_title = $request->job_title;
        $apply_job->name      = $request->name;
        $apply_job->phone     = $request->phone;
        $apply_job->email     = $request->email;
        $apply_job->message   = $request->message;
        $apply_job->cv_upload = $cv_uploads;

        // Associate the application with the job offer
        $apply_job->offre_emploi_id = $offre_emploi_id;

        $apply_job->save();

        DB::commit();

        return redirect()->route('jobapplicants')->with('success', 'Your job application has been added successfully.');
    } catch(\Exception $e) {
        DB::rollback();
        Toastr::error('Apply Job fail :)','Error');
        return redirect()->back();
    }
}


    // public function show($id)
    // {
    //     $condidature = Condidatures::find($id);

    //     return view('Condidature.showcondidature', ['condidature' => $condidature]);
    // }

    // public function update(Request $request, $id)
    // {
    //     $request->validate([
    //         'status' => 'required|string|max:255',
    //     ]);

    //     // Find the specific Condidature by ID
    //     $condidature = Condidatures::findOrFail($id);

    //     // Mettre à jour uniquement le champ 'status'
    //     $condidature->update(['status' => $request->status]);

    //     // Si le statut est "accepté", générer un contrat et un PDF
    //     if ($request->status === 'accepté') {
    //         $contratData = [
    //             'type' => 'Type du contrat',
    //             'duree' => 'Durée du contrat',
    //             'salaire' => 'Salaire du contrat',
    //             'date_debut' => 'Date de début du contrat',
    //             'date_fin' => 'Date de fin du contrat',
    //             'description' => 'Description du contrat',
    //             'etat' => 'État du contrat',

    //         ];

    //         // Génération du contenu du contrat
    //         $contractContent = view('contract_template', $contratData)->render();

    //         // Création d'une instance Dompdf
    //         $options = new Options();
    //         $options->set('isHtml5ParserEnabled', true);
    //         $dompdf = new Dompdf($options);

    //         // Charger le contenu du contrat dans Dompdf
    //         $dompdf->loadHtml($contractContent);

    //         // (Optionnel) Définir la taille du papier et l'orientation
    //         $dompdf->setPaper('A4', 'portrait');

    //         // Rendre le contrat au format PDF
    //         $dompdf->render();

    //         // Retourner une réponse PDF pour le téléchargement
    //         return $dompdf->stream('contrat.pdf');
    //     }

    //     return redirect()->route('jobapplicants')->with('success', 'Status updated successfully.');
    // }


    public function update(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|string|max:255',
        ]);

        try {
            // Find the specific Condidature by ID
            $condidature = Condidatures::findOrFail($id);

            // Update the status
            $condidature->update(['status' => $request->status]);

            // Redirect to the 'jobapplicants' view
            return redirect()->route('jobapplicants')->with('success', 'Status updated successfully');
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to update status'], 500);
        }
    }





// Route pour afficher le contrat PDF dans la pop-up
public function showContractPdf()
{
    // Récupérer le contenu du contrat depuis la session
    $contractContent = Session::get('contractContent');
    Session::forget('contractContent'); // Supprimer le contenu de la session

    // Créer une instance Dompdf
    $options = new Options();
    $options->set('isHtml5ParserEnabled', true);
    $dompdf = new Dompdf($options);

    // Charger le contenu du contrat dans Dompdf
    $dompdf->loadHtml($contractContent);

    // (Optionnel) Définir la taille du papier et l'orientation
    $dompdf->setPaper('A4', 'portrait');

    // Rendre le contrat au format PDF
    $dompdf->render();

    // Afficher le contrat PDF dans la pop-up
    return view('contract_pdf', ['pdfContent' => $dompdf->output()]);
}

    public function edit($id)
    {
        $condidature = Condidatures::find($id);

        if (!$condidature) {
            abort(404); // Or handle the error in an appropriate way
        }

        return view('Condidature.showcondidature', compact('condidature')); // Pass 'condidature' instead of 'Condidatures'
    }


}
