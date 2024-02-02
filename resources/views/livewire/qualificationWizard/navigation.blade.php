<nav aria-label="Progress">
    <ol role="list" class="divide-y divide-gray-300 rounded-md border border-gray-300 xl:flex xl:divide-y-0">
        @foreach ($steps as $step)
            <li class="relative xl:flex xl:flex-1">
                @if ($step->isPrevious())
                    <button type="button" wire:click="{{ $step->show() }}" class="group flex w-full items-center">
                        <span class="flex items-center pl-2 pr-4 py-2 text-sm font-medium">
                            <span
                                class="flex h-10 w-10 flex-shrink-0 items-center justify-center rounded-full bg-indigo-600 group-hover:bg-indigo-800">
                                <svg class="h-6 w-6 text-white" viewBox="0 0 24 24" fill="currentColor"
                                    aria-hidden="true">
                                    <path fill-rule="evenodd"
                                        d="M19.916 4.626a.75.75 0 01.208 1.04l-9 13.5a.75.75 0 01-1.154.114l-6-6a.75.75 0 011.06-1.06l5.353 5.353 8.493-12.739a.75.75 0 011.04-.208z"
                                        clip-rule="evenodd" />
                                </svg>
                            </span>
                            <span class="ml-2 text-sm font-medium text-gray-900">{!! $step->label !!}</span>
                        </span>
                    </button>
                @elseif($step->isCurrent())
                    <button type="button" class="flex items-center pl-2 pr-4 py-2 text-sm font-medium"
                        aria-current="step">
                        <span
                            class="flex h-10 w-10 flex-shrink-0 items-center justify-center rounded-full border-2 border-indigo-600">
                            <span class="text-indigo-600">{{ $loop->iteration }}</span>
                        </span>
                        <span class="ml-2 text-sm font-medium text-indigo-600">{!! $step->label !!}</span>
                    </button>
                @else
                    <button type="button" class="group flex items-center">
                        <span @class([
                            'flex items-center pl-2 py-2 text-sm font-medium',
                            'pr-2' => $loop->last,
                            'pr-4' => !$loop->last,
                        ])>
                            <span
                                class="flex h-10 w-10 flex-shrink-0 items-center justify-center rounded-full border-2 border-gray-300 group-hover:border-gray-400">
                                <span class="text-gray-500 group-hover:text-gray-900">{{ $loop->iteration }}</span>
                            </span>
                            <span
                                class="ml-2 text-sm font-medium text-gray-500 group-hover:text-gray-900">{!! $step->label !!}</span>
                        </span>
                    </button>
                @endif
                @unless ($loop->last)
                    <div class="absolute right-0 top-0 hidden h-full w-5 xl:block" aria-hidden="true">
                        <svg class="h-full w-full text-gray-300" viewBox="0 0 22 80" fill="none"
                            preserveAspectRatio="none">
                            <path d="M0 -2L20 40L0 82" vectorEffect="non-scaling-stroke" stroke="currentcolor"
                                strokeLinejoin="round" />
                        </svg>
                    </div>
                @endunless
            </li>
        @endforeach
    </ol>
</nav>
