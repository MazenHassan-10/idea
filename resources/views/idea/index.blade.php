<x-layout>
    <div>
        <header class="py-8 md:py-12">
            <h1 class="text-3xl font-bold">Ideas</h1>
            <p class="text-muted-foreground text-sm mt-2">
                Capture your thoughts. Make a plan.
            </p>
        <x-card
            x-data
            @click="$dispatch('open-modal' , 'create-idea')"
            is="button"
            class="mt-10 cursor-pointer h-32 w-full text-left">
            <p>what's Idea?</p>
        </x-card>
        </header>

        <div>
                <a href="/ideas" class="btn {{ request()->has('status') ? 'btn-outlined' : '' }}">All</a>
            @foreach (App\IdeaStatus::cases() as $status)
                <a
                    href="/ideas?status={{ $status->value }}"
                    class="btn {{ request('status') == $status->value ? '': 'btn-outlined' }}"
                >
                {{ $status->label() }} <span class="text-xs pl-3">{{ $statusCounts->get($status->value) }}</span>
                </a>
            @endforeach
        </div>
        <div class="mt-10 text-muted-foreground">
            <div class="grid md:grid-cols-2 gap-6">
                @forelse($ideas as $idea)
                    <x-card href="/ideas/{{ $idea->id }}">
                        <h3 class="text-foreground text-lg">{{ $idea->title }}</h3>

                        <x-idea.status-label status="{{ $idea->status }}">
                            {{ $idea->status->label() }}
                        </x-idea.status-label>

                        <div class="mt-5 line-clamp-3">{{ $idea->description }}</div>
                        <div class="mt-4">{{ $idea->created_at->diffForHumans() }}</div>
                    </x-card>
                @empty
                    <x-card>
                        <p>No ideas at this time.</p>
                    </x-card>

                @endforelse
            </div>
            <!-- modal -->
            <x-model name="create-idea" title="new idea">
                <form
                    x-data=
                        "{
                            status: 'pending' ,
                            newLink: '',
                            links: [],
                            newStep: '',
                            steps: [],
                        }"
                    action="{{route('idea.store')}}" method="POST">
                    @csrf

                    <div class="space-y-6">
                        <x-form.field
                            label="Title"
                            name="title"
                            placeholder="Enter your idea"
                            autofocus
                        />
                        <div class="space-y-2">
                            <label for="status" class="labal">Status</label>

                            <div class="flex gap-x-3">
                                @foreach (App\IdeaStatus::cases() as $status)
                                    <button
                                        type="button"
                                        @click="status=  @js($status->value)"
                                        class="btn flex-1 h-10"
                                        :class="status ==  @js($status->value) ? '' : 'btn-outlined'"


                                        >{{ $status->label() }}
                                    </button>
                                @endforeach
                                <input type="hidden" name="status" id="status" :value="status" class="input">
                            </div>
                        </div>
                        <x-form.field
                            label="Description"
                            name="description"
                            type="textarea"
                            placeholder="Enter your description...."
                        />
                        <div>
                            <fieldset class="space-y-3">
                                <legend class="label">Steps</legend>
                                
                                <template x-for="(step , index) in steps">
                                    
                                    <div class="flex gap-x-2 items-center">

                                    <input name="steps[]" x-model="step" class="input">

                                        <button
                                            class="font-bold text-3xl"
                                            type="button"
                                            @click="steps.splice(index , 1);"
                                            aria-label="Remove step"
                                        >-</button>
                                    </div>
                                </template>
                            
                                <div class="flex gap-x-2 items-center">
                                    <input
                                        x-model="newStep"
                                        id="new-step"
                                        class="input flex-1"
                                        placeholder="what needs to be done?"
                                    >
                                    <button
                                        class="font-bold text-3xl"
                                        type="button"
                                        @click="steps.push(newStep.trim()); newStep=''; "
                                        :disabled = "newStep.trim().length === 0"
                                        aria-label="Add a new step"
                                        >+</button>
                                </div>

                            </fieldset>
                        </div>
                        <div>
                            <fieldset class="space-y-3">
                                <legend class="label">Links</legend>
                                
                                <template x-for="(link , index) in links">
                                    
                                    <div class="flex gap-x-2 items-center">

                                    <input name="links[]" x-model="link" class="input">

                                        <button
                                            class="font-bold text-3xl"
                                            type="button"
                                            @click="links.splice(index , 1);"
                                            aria-label="Remove link"
                                        >-</button>
                                    </div>
                                </template>

                                <div class="flex gap-x-2 items-center">
                                    <input
                                        x-model="newLink"
                                        type="url"
                                        id="new-link"
                                        class="input flex-1"
                                        placeholder="https://example.com"
                                        autocomplete="url"
                                        spellcheck="false"
                                    >
                                    <button
                                        class="font-bold text-3xl"
                                        type="button"
                                        @click="links.push(newLink.trim()); newLink=''; "
                                        :disabled = "newLink.trim().length === 0"
                                        aria-label="Add a new link"
                                        >+</button>
                                </div>

                            </fieldset>
                        </div>
                        <div class="flex justify-end gap-x-5">
                            <button type="button" @click="$dispatch('close-modal')">Cancel</button>
                            <button type="submit" class="btn">Create</button>
                        </div>
                    </div>

                </form>
            </x-model>
        </div>
    </div>
</x-layout>
