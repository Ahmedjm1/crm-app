public function login(Request $request)
{
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    $response = Http::post(
        'https://identitytoolkit.googleapis.com/v1/accounts:signInWithPassword?key=' . env('FIREBASE_API_KEY'),
        [
            'email' => $request->email,
            'password' => $request->password,
            'returnSecureToken' => true,
        ]
    );

    $data = $response->json();

    if (!$response->successful() || isset($data['error'])) {
        return back()->withErrors([
            'email' => $data['error']['message'] ?? 'Invalid login credentials'
        ]);
    }

    // 🔥 CHECK EMAIL VERIFICATION
    $check = Http::post(
        'https://identitytoolkit.googleapis.com/v1/accounts:lookup?key=' . env('FIREBASE_API_KEY'),
        [
            'idToken' => $data['idToken']
        ]
    );

    $userInfo = $check->json();

    if (!($userInfo['users'][0]['emailVerified'] ?? false)) {
        return back()->withErrors([
            'email' => 'Please verify your email before logging in.'
        ]);
    }

    // 🔥 Find or create local user
    $user = User::updateOrCreate(
        ['email' => $request->email],
        [
            'name' => $data['displayName'] ?? 'Firebase User',
            'password' => bcrypt('firebase-user'),
        ]
    );

    // 🔥 Session fix
    $request->session()->regenerate();

    // ✅ ADD THIS LINE HERE (IMPORTANT)
    session(['firebase_id_token' => $data['idToken']]);

    // 🔥 Login
    Auth::login($user, true);

    return redirect('/dashboard');
}