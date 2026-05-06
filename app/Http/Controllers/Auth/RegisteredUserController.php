public function store(Request $request)
{
    $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'email'],
        'password' => ['required', 'min:6'],
    ]);

    // 🔥 Create Firebase account
    $response = Http::post(
        'https://identitytoolkit.googleapis.com/v1/accounts:signUp?key=' . env('FIREBASE_API_KEY'),
        [
            'email' => $request->email,
            'password' => $request->password,
            'returnSecureToken' => true,
        ]
    );

    $data = $response->json();

    if (!$response->successful() || isset($data['error'])) {
        return back()->withErrors([
            'email' => $data['error']['message'] ?? 'Registration failed'
        ]);
    }

    // 🔥 Send verification email (Firebase)
    Http::post(
        'https://identitytoolkit.googleapis.com/v1/accounts:sendOobCode?key=' . env('FIREBASE_API_KEY'),
        [
            'requestType' => 'VERIFY_EMAIL',
            'idToken' => $data['idToken'],
        ]
    );

    // 🔥 Optional: store user locally (NO AUTH)
    User::updateOrCreate(
        ['email' => $request->email],
        [
            'name' => $request->name,
            'password' => bcrypt('firebase-user'),
        ]
    );

    return redirect('/login')->with('status', 'Check your email to verify your account.');
}