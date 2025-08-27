<x-layouts.app :title="__('Dashboard')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <div class="flex items-center justify-between">
            <h1 class="text-2xl font-semibold">{{ __('New Upload') }}</h1>
            <div>
                <a class="flex rounded-sm border px-4 py-2 hover:bg-neutral-700" href="{{ route('uploads') }}" wire:navigate>
                    {{ __('Back to List') }}
                </a>
            </div>
        </div>

        <div class="overflow-hidden rounded-lg border border-neutral-200 bg-white shadow-sm dark:border-neutral-700 dark:bg-neutral-800 p-6">
            <form method="POST" action="{{ route('uploads.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="mb-4">
                    <label for="file" class="block text-sm font-medium text-neutral-700 dark:text-neutral-300">{{ __('File') }}</label>
                    <input type="file" name="file" id="file" class="mt-1 p-2 block w-full rounded-md border-neutral-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm dark:bg-neutral-700 dark:border-neutral-600 dark:text-white" required>
                </div>

                <div class="flex justify-end">
                    <button type="submit" class="flex rounded-sm border px-4 py-2 hover:bg-neutral-700">
                        {{ __('Upload') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-layouts.app>
