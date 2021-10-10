<div class="mx-4 mt-4">
    <div class="mt-4">
        <x-label for="Name" :value="__('Comment')" />
    {{-- <x-input id="name" class="block mt-1 w-half" type="text" name="comment" value="{{old('comment', isset($comments) ? $comments->comment : '')}}" required autofocus /> --}}
    <x-input id="name" class="block mt-1 w-half" type="text" name="comment" value="{{old('comment')}}" required autofocus />
    <p class="text-red-600">{{$errors->first('comment')}}</p>
    </div>

    <div class="flex items-center justify-end mt-4">
    <x-button class="m-4 bg-green-600">
        {{$buttonText}}
    </x-button>
    </div>
</div>