<x-guest-layout>
    <div id="firebase-error" style="color:red;"></div>

    <!-- Name -->
    <div>
        <x-input-label for="name" :value="__('Name')" />
        <x-text-input id="name" name="name" class="block mt-1 w-full" type="text" required autofocus />
    </div>

    <!-- Email -->
    <div class="mt-4">
        <x-input-label for="email" :value="__('Email')" />
        <x-text-input id="email" name="email" class="block mt-1 w-full" type="email" required />
    </div>

    <!-- Password -->
    <div class="mt-4">
        <x-input-label for="password" :value="__('Password')" />
        <x-text-input id="password" name="password" class="block mt-1 w-full" type="password" required />
    </div>

    <!-- Confirm Password -->
    <div class="mt-4">
        <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
        <x-text-input id="password_confirmation" name="password_confirmation" class="block mt-1 w-full" type="password" required />
    </div>

    <div class="flex items-center justify-end mt-4">
        <a class="underline text-sm" href="{{ route('login') }}">
            Already registered?
        </a>

        <x-primary-button class="ms-4" onclick="registerUser(event)">
            Register
        </x-primary-button>
    </div>

    <script>
        const FIREBASE_API_KEY = "{{ env('FIREBASE_API_KEY') }}";

        function registerUser(e) {
            e.preventDefault();

            const name = document.getElementById('name').value;
            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;
            const confirm = document.getElementById('password_confirmation').value;

            document.getElementById('firebase-error').innerText = "";

            if (password !== confirm) {
                document.getElementById('firebase-error').innerText = "Passwords do not match";
                return;
            }

            // 🔥 1. CREATE FIREBASE USER
            fetch(`https://identitytoolkit.googleapis.com/v1/accounts:signUp?key=${FIREBASE_API_KEY}`, {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                },
                body: JSON.stringify({
                    email: email,
                    password: password,
                    returnSecureToken: true
                })
            })
            .then(res => res.json())
            .then(async (data) => {

                if (data.error) {
                    document.getElementById('firebase-error').innerText = data.error.message;
                    return;
                }

                // 🔥 2. SEND EMAIL VERIFICATION (FIXED PART)
                await fetch(`https://identitytoolkit.googleapis.com/v1/accounts:sendOobCode?key=${FIREBASE_API_KEY}`, {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                    },
                    body: JSON.stringify({
                        requestType: "VERIFY_EMAIL",
                        idToken: data.idToken
                    })
                });

                // 🔥 3. SEND TO LARAVEL BACKEND
                await fetch("/firebase-register", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    },
                    body: JSON.stringify({
                        name: name,
                        email: email,
                        firebase_uid: data.localId
                    })
                });

                alert("Check your email for verification link!");
                window.location.href = "/login";
            })
            .catch(err => {
                document.getElementById('firebase-error').innerText = err.message;
            });
        }
    </script>
</x-guest-layout>