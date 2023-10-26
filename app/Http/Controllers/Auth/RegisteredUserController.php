<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $data): RedirectResponse
    {
        $data->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);
        // event(new Registered($user));
        $data = $data->all(); // Retrieve all input data as an array
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => $data['role'],
        ]);
    
        // Assign the role based on the input field
        $role = Role::firstOrCreate(['name' => $data['role']]);
        $user->assignRole($role);
        Auth::login($user);

        switch ($data['role']) {
            case 'Formateur':
                return redirect(RouteServiceProvider::HOME); // Adjust the route name
                break;
            case 'Recruteur':
                return redirect()->route('OffreEmplois'); // Adjust the route name
                break;
            case 'Candidat':
                return redirect()->route('offre.frontoffre'); // Adjust the route name
                break;
            case 'Participant':
                return redirect(RouteServiceProvider::HOME); // Adjust the route name
                break;
            default:
                return redirect(RouteServiceProvider::HOME);
        }

        
    }
}
