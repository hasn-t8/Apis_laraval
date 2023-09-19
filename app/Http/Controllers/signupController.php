<?php

namespace App\Http\Controllers;
// use Illuminate\Support\Facades\Auth;

use App\Models\Signup;
use Illuminate\Http\Request;
use Validator;
use Auth;
use Illuminate\Support\Facades\DB;


class signupController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function signup(Request $request)
    {
    //         //    Retrieve data from the request and store it in variables
    // $fullName = $request->input('fullName');
    // $email = $request->input('email');
    // $username = $request->input('username');
    // $password = $request->input('password');

    // // You can create an associative array with the data
    // $userData = [
    //     'Full Name' => $fullName,
    //     'Email' => $email,
    //     'Username' => $username,
    //     'Password' => $password,
    // ];

    // Add any additional logic here, such as database storage

    // Return the user data as a JSON response
   // return response()->json(['user' => $userData]);
//}
 
$validator = Validator::make($request->all(), [
    'fullName' => 'required|string|max:255',
    'email' => 'required|email',
    'username' => 'required|string|max:255',
    'password' => 'required|string',
]);

            // If validation fails, return an error response
            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 400);
            }
            
                    //Create a new Item model and save it to the database
                    $Signup = new Signup();
                    $Signup->name = $request->input('fullName');
                    $Signup->email = $request->input('email');
                    $Signup->username = $request->input('username');
                    $Signup->password = bcrypt($request->input('password')); // Hash the password
                    $Signup->save(); 
            
        
        return response()->json(['message' => 'Signup successful'], 201);
        }

        public function login(Request $request)
        {
            // Validate the request data
            $request->validate([
                'username' => 'required',
                'password' => 'required',
            ]);
        
            // Retrieve the username and password from the request
            $username = $request->input('username');
            $password = $request->input('password');
        
            // Query the database to find a user with the given username
            $user = DB::table('signups')
                ->where('username', $username)
                ->first();
        
            if (!$user) {
                return response()->json(['message' => 'User not found'], 404);
            }
        
            // Check if the provided password matches the hashed password in the database
            if (password_verify($password, $user->password)) {
                // Authentication succeeded, return only necessary user data
                $userData = [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'username' => $user->username,
                    'status'=>$user->status,
                ];
        
                return response()->json(['user' => $userData]);
            }
        
            // Authentication failed
            return response()->json(['message' => 'Authentication failed'], 401);
        }
        
        
        
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    public function getItems()
    {
        $users = Signup::all();
        return response()->json($users);
    }

}
