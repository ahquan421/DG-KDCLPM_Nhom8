<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('My Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">

            {{-- ======= Thông tin cá nhân ======= --}}
            <div class="p-6 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <header>
                    <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                        Thông tin cá nhân
                    </h3>
                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                        Cập nhật tên, email và địa chỉ của bạn.
                    </p>
                </header>

                @if (session('status') === 'profile-updated')
                    <p class="mt-3 text-green-600 dark:text-green-400">✅ Cập nhật thành công!</p>
                @endif

                <form method="POST" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
                    @csrf
                    @method('PATCH')

                    <!-- Họ tên -->
                    <div>
                        <x-input-label for="name" :value="__('Họ và tên')" />
                        <x-text-input id="name" name="name" type="text" class="mt-1 block w-full"
                            value="{{ old('name', $user->name) }}" required autofocus autocomplete="name" />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <!-- Email -->
                    <div>
                        <x-input-label for="email" :value="__('Email')" />
                        <x-text-input id="email" name="email" type="email" class="mt-1 block w-full"
                            value="{{ old('email', $user->email) }}" required autocomplete="username" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <!-- Địa chỉ -->
                    <div>
                        <x-input-label for="address" :value="__('Địa chỉ')" />
                        <x-text-input id="address" name="address" type="text" class="mt-1 block w-full"
                            value="{{ old('address', $user->address) }}" autocomplete="address" />
                        <x-input-error :messages="$errors->get('address')" class="mt-2" />
                    </div>

                    <div class="flex items-center gap-4">
                        <x-primary-button>{{ __('Lưu thay đổi') }}</x-primary-button>
                        @if (session('status') === 'profile-updated')
                            <p class="text-sm text-gray-600 dark:text-gray-400">Đã lưu lúc {{ now()->format('H:i') }}</p>
                        @endif
                    </div>
                </form>
            </div>

            {{-- ======= Đổi mật khẩu ======= --}}
            <div class="p-6 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <header>
                    <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                        Đổi mật khẩu
                    </h3>
                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                        Đảm bảo bạn sử dụng mật khẩu mạnh để bảo vệ tài khoản.
                    </p>
                </header>

                @if (session('status') === 'password-updated')
                    <p class="mt-3 text-green-600 dark:text-green-400">🔒 Mật khẩu đã được thay đổi!</p>
                @endif

                <form method="POST" action="{{ route('profile.password') }}" class="mt-6 space-y-6">
                    @csrf

                    <div>
                        <x-input-label for="current_password" :value="__('Mật khẩu hiện tại')" />
                        <x-text-input id="current_password" name="current_password" type="password" class="mt-1 block w-full"
                            autocomplete="current-password" />
                        <x-input-error :messages="$errors->get('current_password')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="password" :value="__('Mật khẩu mới')" />
                        <x-text-input id="password" name="password" type="password" class="mt-1 block w-full"
                            autocomplete="new-password" />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="password_confirmation" :value="__('Xác nhận mật khẩu mới')" />
                        <x-text-input id="password_confirmation" name="password_confirmation" type="password"
                            class="mt-1 block w-full" autocomplete="new-password" />
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                    </div>

                    <div class="flex items-center gap-4">
                        <x-primary-button>{{ __('Cập nhật mật khẩu') }}</x-primary-button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</x-app-layout>
