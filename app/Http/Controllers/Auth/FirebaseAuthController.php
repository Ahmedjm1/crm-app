public function login(Request $request)
{
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    // 🔥 Firebase login request
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

    // 🔥 Create or update local user (optional sync)
    $user = User::updateOrCreate(
        ['email' => $request->email],
        [
            'name' => $userInfo['users'][0]['displayName'] ?? 'Firebase User',
            'password' => bcrypt('firebase-user'),
        ]
    );

    // 🔥 CLEAN SESSION (NO Laravel Auth)
    $request->session()->regenerate();

    session([
        'firebase_user' => [
            'email' => $request->email,
            'idToken' => $data['idToken'],
            'uid' => $data['localId'],
        ]
    ]);

    return redirect('/dashboard');
}