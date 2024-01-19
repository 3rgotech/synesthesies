<x-app-layout>
    <div class="relative container mx-auto min-h-screen px-2 py-16 flex flex-col justify-center items-stretch">
        <ul role="list" class="grid grid-cols-1 gap-6 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 px-4">
            <li class="col-span-1 flex flex-col divide-y divide-gray-200 rounded-lg bg-white text-center shadow">
                <div class="flex flex-1 flex-col p-4">
                    <div
                        class="mx-auto h-32 w-32 flex-shrink-0 rounded-full bg-slate-300 text-gray-700 flex items-center justify-center">
                        <x-far-calendar-days class="size-16" />
                    </div>
                    <h3 class="mt-6 text-sm font-medium text-gray-900">Intitulé</h3>
                    <p class="text-sm text-gray-500">Description</p>
                    <div class="mt-3 text-xs">
                        Durée estimée :
                        <span
                            class="inline-flex items-center rounded-full bg-slate-50 px-2 py-1 text-xs font-medium text-slate-700 ring-1 ring-inset ring-slate-600/20">
                            15 minutes
                        </span>
                    </div>
                    </dl>
                </div>
                <div>
                    <div class="-mt-px flex divide-x divide-gray-200">
                        <div class="flex w-0 flex-1">
                            <a href="mailto:janecooper@example.com"
                                class="relative -mr-px inline-flex w-0 flex-1 items-center justify-center gap-x-3 rounded-bl-lg border border-transparent py-4 text-sm font-semibold text-gray-900">
                                <x-fas-arrow-right class="h-5 w-5 text-gray-400" />
                                Faire le test
                            </a>
                        </div>
                    </div>
                </div>
            </li>
            <li class="col-span-1 flex flex-col divide-y divide-gray-200 rounded-lg bg-white text-center shadow">
                <div class="flex flex-1 flex-col p-4">
                    <div
                        class="mx-auto h-32 w-32 flex-shrink-0 rounded-full bg-slate-300 text-gray-700 flex items-center justify-center">
                        <x-fas-font class="size-16" />
                    </div>
                    <h3 class="mt-6 text-sm font-medium text-gray-900">Intitulé</h3>
                    <p class="text-sm text-gray-500">Description</p>
                    <div class="mt-3 text-xs">
                        Durée estimée :
                        <span
                            class="inline-flex items-center rounded-full bg-slate-50 px-2 py-1 text-xs font-medium text-slate-700 ring-1 ring-inset ring-slate-600/20">
                            15 minutes
                        </span>
                    </div>
                    </dl>
                </div>
                <div>
                    <div class="-mt-px flex divide-x divide-gray-200">
                        <div class="flex w-0 flex-1">
                            <a href="mailto:janecooper@example.com"
                                class="relative -mr-px inline-flex w-0 flex-1 items-center justify-center gap-x-3 rounded-bl-lg border border-transparent py-4 text-sm font-semibold text-gray-900">
                                <x-fas-check class="h-5 w-5 text-green-400" />
                                Consulter mon résultat
                            </a>
                        </div>
                    </div>
                </div>
            </li>
        </ul>
    </div>
</x-app-layout>
