<x-guest-layout>
<section class="min-h-screen flex items-center justify-cente dark:bg-gray-900">

    <div class="w-full max-w-md mx-auto">

        <!-- Card -->
        <div class="bg-white dark:bg-gray-800 shadow-lg rounded-xl p-3 sm:p-6">

            <!-- Title -->
            <h2 class="text-2xl font-bold text-center text-gray-900 dark:text-white mb-6">
                Login
            </h2>

            <!-- Session Status -->
            @if (session('status'))
                <div class="mb-4 text-sm text-green-600 text-center">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}" class="space-y-6">
                @csrf

                <!-- Email -->
                <div class="space-y-2">
                    <label for="email" class="text-sm font-medium text-gray-700 dark:text-gray-300">
                        Email
                    </label>
                    <input type="email" name="email" id="email"
                        value="{{ old('email') }}"
                        class="w-full p-3 text-sm border border-gray-300 rounded-lg bg-gray-50 focus:ring-2 focus:ring-blue-500 focus:border-blue-500
                        dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                        placeholder="name@email.com" required autofocus>

                    @error('email')
                        <p class="text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password -->
                <div class="space-y-2">
                    <label for="password" class="text-sm font-medium text-gray-700 dark:text-gray-300">
                        Password
                    </label>
                    <input type="password" name="password" id="password"
                        class="w-full p-3 text-sm border border-gray-300 rounded-lg bg-gray-50 focus:ring-2 focus:ring-blue-500 focus:border-blue-500
                        dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                        placeholder="••••••••" required>

                    @error('password')
                        <p class="text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Remember + Forgot -->
                <div class="flex items-center justify-between text-sm pt-1">
                    <label class="flex items-center gap-2 text-gray-600 dark:text-gray-300">
                        <input type="checkbox" name="remember"
                            class="w-4 h-4 border-gray-300 rounded focus:ring-blue-500">
                        Remember me
                    </label>

                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}"
                            class="text-blue-600 hover:underline dark:text-blue-400">
                            Lupa password?
                        </a>
                    @endif
                </div>

                <!-- Button -->
                <div class="pt-2">
                    <button type="submit"
                        class="w-full py-3 text-sm font-semibold text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 transition">
                        Login
                    </button>
                </div>

                <!-- Register -->
                <p class="text-sm text-center text-gray-500 dark:text-gray-400 pt-2">
                    Don't have an account?
                    <a href="{{ route('register') }}"
                        class="font-medium text-blue-600 hover:underline dark:text-blue-400">
                        Register
                    </a>
                </p>

            </form>
        </div>

    </div>

</section>
</x-guest-layout>