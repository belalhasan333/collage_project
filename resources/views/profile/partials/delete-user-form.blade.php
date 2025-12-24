<section class="space-y-6">
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Delete Account') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}
        </p>
    </header>

    <button
        type="button"
        class="btn btn-danger"
        x-data
        @click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
    >{{ __('Delete Account') }}</button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="POST" action="{{ route('profile.destroy') }}" class="p-6">
            @csrf
            @method('DELETE')

            <h2 class="text-lg font-medium text-gray-900">
                {{ __('Are you sure you want to delete your account?') }}
            </h2>

            <p class="mt-1 text-sm text-gray-600">
                {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}
            </p>

            <div class="mt-6">
                <label for="password" class="form-label sr-only">{{ __('Password') }}</label>
                <input
                    id="password"
                    name="password"
                    type="password"
                    class="form-control mt-1 block w-3/4"
                    placeholder="{{ __('Password') }}"
                    required
                    autocomplete="current-password"
                />
                @error('password', 'userDeletion')
                    <div class="text-danger mt-2">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mt-6 flex justify-end">
                <button type="button" class="btn btn-secondary" @click="$dispatch('close')">
                    {{ __('Cancel') }}
                </button>
                <button type="submit" class="btn btn-danger ms-3">
                    {{ __('Delete Account') }}
                </button>
            </div>
        </form>
    </x-modal>
</section>
