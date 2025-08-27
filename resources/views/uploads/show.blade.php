<x-layouts.app :title="__('Upload Details')">
    <div class="flex items-center justify-between">
        <h1 class="text-2xl font-semibold">{{ __('Upload Details') }}</h1>
        <div>
            <a class="flex rounded-sm border px-4 py-2 hover:bg-neutral-700" href="{{ route('uploads') }}" wire:navigate>
                {{ __('Back to List') }}
            </a>
        </div>
    </div>

    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl mt-4">
        <table class="min-w-full divide-y divide-neutral-200 dark:divide-neutral-700">
            <thead class="bg-neutral-50 dark:bg-neutral-700">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-neutral-500 dark:text-neutral-300">
                        {{ __('Name') }}
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-neutral-500 dark:text-neutral-300">
                        {{ __('Email') }}
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-neutral-500 dark:text-neutral-300">
                        {{ __('Phone') }}
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-neutral-500 dark:text-neutral-300">
                        {{ __('Address') }}
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-neutral-500 dark:text-neutral-300">
                        {{ __('Birthday') }}
                    </th>
                </tr>
            </thead>
            <tbody class="divide-y divide-neutral-200 bg-white dark:divide-neutral-700 dark:bg-neutral-800">
                @if ($details->isEmpty())
                    <tr>
                        <td colspan="4" class="px-6 py-4 text-center text-sm text-neutral-500 dark:text-neutral-400">
                            {{ __('No details found.') }}
                        </td>
                    </tr>
                @else
                    @foreach ($details as $row)
                        <tr>
                            <td class="whitespace-nowrap px-6 py-4 text-sm font-medium text-neutral-900 dark:text-neutral-100">
                                {{ $row->name }}
                            </td>
                            <td class="whitespace-nowrap px-6 py-4 text-sm text-neutral-900 dark:text-neutral-100">
                                {{ $row->email }}
                            </td>
                            <td class="whitespace-nowrap px-6 py-4 text-sm text-neutral-900 dark:text-neutral-100">
                                {{ $row->phone }}
                            </td>
                            <td class="whitespace-nowrap px-6 py-4 text-sm text-neutral-900 dark:text-neutral-100">
                                {{ $row->address }}
                            </td>
                            <td class="whitespace-nowrap px-6 py-4 text-sm text-neutral-900 dark:text-neutral-100">
                                {{ $row->birthday }}
                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
        <div class="mt-4">
            {{ $details->links() }}
        </div>
    </div>
</x-layouts.app>
