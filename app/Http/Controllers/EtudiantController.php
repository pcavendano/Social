<?php

namespace App\Http\Controllers;

use App\Models\Etudiant;
use App\Models\User;
use App\Models\Ville;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class EtudiantController extends Controller
{
    const MAX_IMAGE_ID = 16796;
    const MIN_IMAGE_ID = 1;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $etudiants = Etudiant::all(); //récupérer tous les etudiants de la DB
        return view('etudiants.index', ['etudiants' => DB::table('etudiants')->paginate(10)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //afficher le formulaire pour ajouter un étudiant
        $villes = Ville::all(); //récupérer toutes les villes de la DB
        return view('etudiants.create', [
            'villes' => $villes,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // ajouter un nouveau étudiant
        $email = $request->old('email');
        $phone = $request->old('phone');
        $phone = $request->old('date_de_naissance');
        $nom = $request->old('nom');
        $adresse = $request->old('adresse');
        $villeId = $request->old('villeId');
        $validated = $request->validate([
            'email' => 'required|unique:etudiants|max:255'
        ]);


        // Création d'une image de profil de manière aléatoire avec la librairie faker
        // https://dev.to/codeanddeploy/tutorial-for-laravel-8-image-upload-example-5ehk
        $imageId = null;
        if (null === $imageId) {
            $imageId = random_int(self::MIN_IMAGE_ID, self::MAX_IMAGE_ID);
        }
        $imageId = sprintf('https://faces-img.xcdn.link/image-lorem-face-%d.jpg', $imageId);
        $filename = time() . '.' . $request->image->extension();
        $request->image->move(public_path('images'), $filename);
        // Fin de la création de l'image de profil avec faker


        // save uploaded user information to our database
        // Création de l'étudiant
//        $etudiant = new Etudiant;
//        $etudiant->nom = $request->nom;
//        $etudiant->adresse = $request->adresse;
//        $etudiant->phone = $request->phone;
        $image = null;
        if ($filename != null) {
            $image = $filename;
        } else {
            $image = $imageId;
        }
//        $etudiant->email = $request->email;
//        $etudiant->date_de_naissance = $request->date_de_naissance;
//        $etudiant->villeId = $request->villeId;
//        $etudiant->save();

        $etudiant = Etudiant::create([
            'nom' => $request->nom,
            'adresse' => $request->adresse,
            'phone' => $request->phone,
            'image' => $image,
            'email' => $request->eamil,
            'date_de_naissance' => $request->date_de_naissance,
            'villeId' => $request->villeId
        ]);
        ddr($etudiant);
        // Création de l'usager avec la catégorie étudiant
        $user = new User;

        $user = User::create([
            'email' => $etudiant->email,
            'categorys_id' => $request->categorys_id
        ]);

        $user->name = $request->nom;
        $user->email = $request->email;
        $user->fill($request->all());
        $user->password = Hash::make($request->password);
        $user->save();
        return back()->with('success', 'L\'usager ' . $etudiant->email . ' a été ajouté.')
            ->with('image', $filename);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Etudiant $etudiant
     * @return \Illuminate\Http\Response
     */
    public function show(Etudiant $etudiant)
    {
        //afficher un étudiant
        $ville = Ville::find($etudiant->villeId);
        return view('etudiants.show', [
            'etudiant' => $etudiant,
            'ville' => $ville]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Etudiant $etudiant
     * @return \Illuminate\Http\Response
     */
    public function edit(Etudiant $etudiant)
    {
        //afficher le formulaire pour modifier le profil d'un étudiant
        $ville = Ville::find($etudiant->villeId);
        $villes = Ville::all(); //récupérer toutes les villes de la DB
        return view('etudiants.modifier', [
            'etudiant' => $etudiant,
            'villec' => $ville,
            'villes' => $villes]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Etudiant $etudiant
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Etudiant $etudiant)
    {
        //enregistrer l'étudiant modifié

        $etudiant->update([
            'nom' => $request->nom,
            'body' => $request->adresse,
            'phone' => $request->phone,
            'email' => $request->email,
            'date_de_naissance' => $request->date_de_naissance,
            'villeId' => $request->villeId
        ]);
        $etudiant->save();
        return redirect('etudiant/' . $etudiant->id)->with('success', 'Vos données ont été mises à jour.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Etudiant $etudiant
     * @return \Illuminate\Http\Response
     */
    public function destroy(Etudiant $etudiant)
    {
        //supprimer un étudiant
        $etudiant->delete();
        return redirect('/');
    }
}
