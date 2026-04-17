<x-guest-layout>
<section class="min-h-screen flex items-center justify-center dark:bg-gray-900">

    <div class="w-full max-w-md mx-auto">

        <!-- Card -->
        <div class="bg-white dark:bg-gray-800 shadow-lg rounded-xl p-3 sm:p-6">

            <!-- Title -->
            <h2 class="text-2xl font-bold text-center text-gray-900 dark:text-white mb-2">
                Create Account
            </h2>

            <form method="POST" action="{{ route('register') }}" class="space-y-2">
                @csrf

                <!-- Name -->
                <div class="space-y-2">
                    <label for="name" class="text-sm font-medium text-gray-700 dark:text-gray-300">
                        Nama
                    </label>
                    <input type="text" name="name" id="name"
                        value="{{ old('name') }}"
                        class="w-full p-3 text-sm border border-gray-300 rounded-lg bg-gray-50 focus:ring-2 focus:ring-blue-500 focus:border-blue-500
                        dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                        placeholder="Nama lengkap" required autofocus>

                    @error('name')
                        <p class="text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Email -->
                <div class="space-y-2">
                    <label for="email" class="text-sm font-medium text-gray-700 dark:text-gray-300">
                        Email
                    </label>
                    <input type="email" name="email" id="email"
                        value="{{ old('email') }}"
                        class="w-full p-3 text-sm border border-gray-300 rounded-lg bg-gray-50 focus:ring-2 focus:ring-blue-500 focus:border-blue-500
                        dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                        placeholder="name@email.com" required>

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

                <!-- Confirm Password -->
                <div class="space-y-2">
                    <label for="password_confirmation" class="text-sm font-medium text-gray-700 dark:text-gray-300">
                        Konfirmasi Password
                    </label>
                    <input type="password" name="password_confirmation" id="password_confirmation"
                        class="w-full p-3 text-sm border border-gray-300 rounded-lg bg-gray-50 focus:ring-2 focus:ring-blue-500 focus:border-blue-500
                        dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                        placeholder="••••••••" required>
                </div>

                <!-- Button -->
                <div class="pt-2">
                    <button type="submit"
                        class="w-full py-3 text-sm font-semibold text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 transition">
                        Regsiter
                    </button>
                </div>

                <!-- Login -->
                <p class="text-sm text-center text-gray-500 dark:text-gray-400 pt-2">
                    I have an account?
                    <a href="{{ route('login') }}"
                        class="font-medium text-blue-600 hover:underline dark:text-blue-400">
                        Login
                    </a>
                </p>

            </form>
        </div>

    </div>

</section>
</x-guest-layout>