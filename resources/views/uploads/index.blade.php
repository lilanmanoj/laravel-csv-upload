<x-layouts.app :title="__('Uploads')">
    <div class="flex items-center justify-between">
        <h1 class="text-2xl font-semibold">{{ __('Uploads') }}</h1>
        <div>
            <a class="flex rounded-sm border px-4 py-2 hover:bg-neutral-700" href="{{ route('uploads.create') }}" wire:navigate>
                {{ __('New Upload') }}
            </a>
        </div>
    </div>

    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl mt-4">
        <table class="min-w-full divide-y divide-neutral-200 dark:divide-neutral-700">
            <thead class="bg-neutral-50 dark:bg-neutral-700">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-neutral-500 dark:text-neutral-300">
                        {{ __('ID') }}
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-neutral-500 dark:text-neutral-300">
                        {{ __('Status') }}
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-neutral-500 dark:text-neutral-300">
                        {{ __('Uploaded At') }}
                    </th>
                </tr>
            </thead>
            <tbody class="divide-y divide-neutral-200 bg-white dark:divide-neutral-700 dark:bg-neutral-800">
                @if ($uploads->isEmpty())
                    <tr>
                        <td colspan="4" class="px-6 py-4 text-center text-sm text-neutral-500 dark:text-neutral-400">
                            {{ __('No uploads found.') }}
                        </td>
                    </tr>
                @else
                    @foreach ($uploads as $upload)
                        <tr>
                            <td class="whitespace-nowrap px-6 py-4 text-sm font-medium text-neutral-900 dark:text-neutral-100">
                                {{ $upload->id }}
                            </td>
                            <td class="whitespace-nowrap px-6 py-4 text-sm text-neutral-900 dark:text-neutral-100">
                                {{ $upload->status }}
                            </td>
                            <td class="whitespace-nowrap px-6 py-4 text-sm text-neutral-900 dark:text-neutral-100">
                                {{ $upload->created_at->format('Y-m-d H:i') }}
                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>
</x-layouts.app>
