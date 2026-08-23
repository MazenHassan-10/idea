@props(['idea'=> new App\Models\Idea()])



<x-model name="{{ $idea->exists ? 'edit-idea' : 'create-idea' }}" title="{{ $idea->exists ? 'Edit Idea' : 'New Idea' }}">
    <form
        x-data=
            "{
                status: @js( old('status' , $idea->status->value) ),
                newLink: '',
                links: @js(old('links' , $idea->links?? [])),
                newStep: '',
                steps: @js(old('steps' , $idea->steps->map->only(['id', 'description' , 'completed']))),
            }"
            action="{{ $idea->exists ? route('idea.update' , $idea) : route('idea.store')}}"
            method="POST"
            enctype="multipart/form-data"
        >
        @csrf

        @if ($idea->exists)
            @method('PATCH')
        @endif

        <div class="space-y-6">
            <x-form.field
                label="Title"
                name="title"
                placeholder="Enter your idea"
                autofocus
                required
                :value="$idea->title"
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
                :value="$idea->description"
            />
            <div class="space-y-2">
                <label for="image" class="label">Featured Image</label>
                
                @if ($idea->image_path)
                    <div class="space-y-2">
                        <img src="{{ asset('storage/' . $idea->image_path) }}" alt=""
                            class="w-full h-48 object-cover rounded-lg">

                        <button class="btn btn-outlined h-10 w-full" form="delete-image-form">Remove Image</button>
                    </div>
                @endif

                <input type="file" name="image" accept="image/">
                
            </div>
            <div>
                <fieldset class="space-y-3">
                    <legend class="label">Steps</legend>

                    <template x-for="(step , index) in steps">

                        <div class="flex gap-x-2 items-center">

                        <input :name="`steps[${index}][description]`" x-model="step.description" class="input" readonly>
                        <input type="hidden" :name="`steps[${index}][completed]`" x-model="step.completed ? '1': '0'" class="input" readonly>

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
                            @click="
                                steps.push({ description: newStep.trim() , completed: false });
                                newStep='';
                            "
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
                <button type="submit" class="btn">{{ $idea->exists ? 'Update' : 'Create' }}</button>
            </div>
        </div>

    </form>
    @if ($idea->image_path)
        <form method="POST" action="{{ route('idea.image.destroy' , $idea) }}" id="delete-image-form">
            @csrf
            @method('DELETE')
        </form>
    @endif
    
</x-model>
