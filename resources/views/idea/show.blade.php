<x-layout>
    <div class="py-8 max-w-4xl mx-auto">

        <div class="flex justify-between items-center">

            <a href="{{ route('idea.index') }}" class="flex items-center gap-x-2 text-sm font-medium btn btn-outlined">
                Back to Ideas
            </a>

            <div class="gap-x-3 flex items-center">
                <button
                    x-data
                    class="btn btn-outlined"
                    @click="$dispatch('open-modal' , 'edit-idea')"
                >
                    Edit Idea
                </button>

                <form method="POST" action="{{ route('idea.destroy', $idea) }}">
                    @csrf
                    @method('DELETE')

                    <button class="btn btn-outlined text-red-500">
                        Delete
                    </button>
                </form>
            </div>

        </div>

        <div class="mt-8 space-y-6">

            @if ($idea->image_path)
                <div class="rounded-lg overflow-hidden">
                    <img src="{{ asset('storage/' . $idea->image_path) }}" alt="" class="w-full h-auto object-cover">
                </div>
            @endif

            <h1 class="font-bold text-4xl">{{ $idea->title }}</h1>

            <div class="mt-2 flex gap-x-3 items-center">
                <x-idea.status-label :status="$idea->status->value">
                    {{ $idea->status->label() }}
                </x-idea.status-label>

                <div class="text-muted-foreground text-sm">
                    {{ $idea->created_at->diffForHumans() }}
                </div>
            </div>

            @if ($idea->description)
                <x-card class="mt-6" is="div">
                    <div class="text-foreground max-w-none cursor-pointer prose prose-invert">
                        {!! $idea->formattedDescription !!}
                    </div>
                </x-card>
            @endif

            @if ($idea->links->count())

                <div class="mt-4">
                    <h3 class="font-bold text-xl mt-6">steps</h3>

                    <div class="mt-4 space-y-2">
                        @foreach ($idea->steps as $step)
                            <x-card>
                                <form method="POST" action="{{ route('step.update', $step) }}">
                                    @csrf
                                    @method('PATCH')
                                    <div class="flex items-center gap-x-3">
                                        <button type="submit" role="checkbox"
                                            class="size-5 flex items-center justify-center rounded-full border border-primary text-primary
                                        {{ $step->completed ? 'bg-primary' : '' }}">&check;</button>
                                        <span class="text-white">{{ $step->description }}</span>
                                    </div>
                                </form>
                            </x-card>
                        @endforeach
                    </div>
                </div>

            @endif
            @if ($idea->links->count())
                <div class="mt-4">
                    <h3 class="font-bold text-xl mt-6">Links</h3>

                    <div class="mt-4 space-y-2">
                        @foreach ($idea->links as $link)
                            <x-card href="{{ $link }}"
                                class="text-primary font-medium flex gap-x-3 items-center">
                                {{ $link }}
                            </x-card>
                        @endforeach
                    </div>
                </div>
            @endif

            <x-idea.modal :idea="$idea"/>
        </div>
    </div>
</x-layout>
