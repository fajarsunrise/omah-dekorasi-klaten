<x-guest-layout>

    <div class="login-title">

        <h1>Omah Dekorasi Klaten</h1>

        <p>
            Silakan masuk untuk mengakses halaman admin
        </p>

    </div>

    <form method="POST" action="{{ route('login') }}">

        @csrf

        <!-- Email -->
        <div class="form-group">

            <label for="email" class="form-label">
                Email
            </label>

            <input
                id="email"
                type="email"
                name="email"
                value="{{ old('email') }}"
                class="form-input"
                required
                autofocus
                autocomplete="username"
            >

            @error('email')
                <div class="error-message">
                    {{ $message }}
                </div>
            @enderror

        </div>


        <!-- Password -->
        <div class="form-group">

            <label for="password" class="form-label">
                Password
            </label>

            <input
                id="password"
                type="password"
                name="password"
                class="form-input"
                required
                autocomplete="current-password"
            >

            @error('password')
                <div class="error-message">
                    {{ $message }}
                </div>
            @enderror

        </div>


        <!-- Remember Me -->
        <div class="remember">

            <input
                id="remember_me"
                type="checkbox"
                name="remember"
            >

            <label for="remember_me">
                Ingat saya
            </label>

        </div>


        <!-- Login Button -->
        <button
            type="submit"
            class="login-button"
        >
            MASUK
        </button>

    </form>

</x-guest-layout>
