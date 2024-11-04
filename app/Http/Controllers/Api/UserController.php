<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // Méthode pour lister des utilisateurs
    public function index()
    {
        $res = ['message' => '', 'data' => null, 'status' => false];
        $users = User::all();
        if ($users) {
            $res = [
                'message' => 'Getting all users successful!',
                'data' => $users,
                'status' => true,
            ];
            return response()->json($res);
        }
        $res = [
            'message' => 'Getting all users errors.',
            'data' => null,
            'status' => false,
        ];
        return response()->json($res);
    }

    // Méthode pour insérer un nouvel utilisateur
    public function storeUser(UserRequest $request)
    {
        $res = ['message' => '', 'data' => null, 'status' => false];
        $credentiale = $request->validate();

        // Vérifie si la requette http respecte les règles de validation
        if ($credentiale) {

            // Vérification du mot de passe
            if ($credentiale['password'] === $credentiale['password']) {
                $password = Hash::make($credentiale['password']);
                $user = User::create([
                    'firstname' => $credentiale['firstname'],
                    'lastname' => $credentiale['lastname'],
                    'email' => $credentiale['email'],
                    'password' => $credentiale['password'],
                ]);

                $res = [
                    'message' => 'Creating user successfful.',
                    'data' => $user,
                    'status' => true,
                ];
            }
            $res = [
                'message' => 'Password not matching!',
                'data' => null,
                'status' => false,
            ];
            return response()->json($res);
        }
        $res = [
            'message' => 'rules not respect',
            'data' => null,
            'status' => false,
        ];
        return response()->json($res);
    }

    // Méthode pour voir juste un utilisateur
    public function show(User $user)
    {
        $res = ['message' => '', 'data' => null, 'status' => false];
        // Cherche utilisateur avec critère envoié
        $user = User::findOrFail($user);
        if ($user) {
            $res = [
                'message' => 'Getting user '. $user->id . ' successful.',
                'data' => $user,
                'status' => true,
            ];
            return response()->json($res);
        }
        $res = [
            'message' => 'Error for getting user ' . $user->id,
            'data' => null,
            'status' => false,
        ];
        return response()->json($res);
    }

    // Méthode pour la modificaiton d'un utilisateur
    public function update(User $user, UserRequest $request)
    {
        $res = ['message' => '', 'data' => null, 'status' => false];
        $user = User::findOrFail($user);
        $credentiale = $request->validate();

        // Vérifie s' il y a un utilisateur séléctionné
        if ($user) {

            // Vérifie si la requette http respecte les règles de validation
            if ($credentiale) {

                // Vérification du mot de passe
                if ($credentiale['password'] === $credentiale['password']) {
                    $password = Hash::make($credentiale['password']);
                    $confirmPassword = Hash::make($credentiale['confirmPassword']);
                    $user->firstname = $credentiale['firstname'];
                    $user->lastname = $credentiale['lastname'];
                    $user->email = $credentiale['email'];
                    $user->password = $password;
                    $user->confirmPassword = $confirmPassword;

                    $user->save();

                    $res = [
                        'message' => 'Updating user successfful.',
                        'data' => $user,
                        'status' => true,
                    ];
                }
                $res = [
                    'message' => 'Password not matching!',
                    'data' => null,
                    'status' => false,
                ];
                return response()->json($res);
            }
            $res = [
                'message' => 'rules not respect',
                'data' => null,
                'status' => false,
            ];
            return response()->json($res);
        }
        $res = [
            'message' => 'undefind user',
            'data' => null,
            'status' => false,
        ];
        return response()->json($res);
    }

    // Methode pour la suppression d'un utilisateur
    public function delete(User $user)
    {
        $res = ['message' => '', 'status' => false];
        $user = User::findOrFail($user);
        if ($user) {
            // Action pour effacer l'utilisateur dans la base de données
            $user->delete();
            // Action pour enregistrer la modification
            $user->save();

            $res = [
                'message' => 'User deleted with success.',
                'status' => true,
            ];
            return response()->json($res);
        }
        $res = [
            'message' => 'No user matching.',
            'status' => false,
        ];
    }
}
