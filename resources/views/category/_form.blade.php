<div class="mx-4 mt-4">
    <div class="mt-4">
        <x-label for="Name" :value="__('Name')" />
    <x-input id="name" class="block mt-1 w-full" type="text" name="name" value="{{old('name', isset($category) ? $category->name : '')}}" required autofocus />
    <p class="text-red-600">{{$errors->first('name')}}</p>
    </div>

    <div class="flex items-center justify-end mt-4">
    <x-button class="m-4 bg-green-600">
        {{$buttonText}}
    </x-button>
    </div>
</div>