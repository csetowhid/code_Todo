<div class="mx-4 mt-4">
    <div class="mt-4">
        <x-label for="Name" :value="__('Name')" />
    <x-input id="task" class="block mt-1 w-full" type="text" name="task" value="{{old('task', isset($todo) ? $todo->task : '')}}" required autofocus />
    <p class="text-red-600">{{$errors->first('task')}}</p>
    </div>

    <div class="mt-2">
        <x-label for="Category" :value="__('Category')" />
    {{-- <x-input id="task" class="block mt-1 w-full" type="text" name="task" value="{{old('task', isset($todo) ? $todo->task : '')}}" required autofocus /> --}}
        <select name="category_id" class="from-control">
            <option value="">{{__("Select Category")}}</option>
            @foreach ($categories as $id => $value)
            <option class="from-control" value="{{$id}}">{{$value}}</option>
            @endforeach
        </select>
    <p class="text-red-600">{{$errors->first('category_id')}}</p>
    </div>

    <div class="mt-2 w-80">
        @isset($task)
            <img src="{{asset('images/todo/'.$task->image)}}" alt="">
        @endisset
        <x-label for="image" :value="__('Upload Image')" />
    <x-input id="image" class="block mt-1 w-full" type="file" name="image" />
    <p class="text-red-600">{{$errors->first('image')}}</p>
    </div>

    <div class="flex items-center justify-end mt-2">
    <x-button class="m-4 bg-green-600">
        {{$buttonText}}
    </x-button>
    </div>
</div>