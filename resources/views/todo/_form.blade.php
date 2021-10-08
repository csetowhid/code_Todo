<div class="flex justify-end mt-4">
    <div class="mt-4">
        <x-label for="Task" :value="__('Task')" />
    <x-input id="task" class="block mt-1 w-full" type="text" name="task" value="{{old('task', isset($todo) ? $todo->task : '')}}" required autofocus />
    <p class="text-red-600">{{$errors->first('task')}}</p>
    </div>
    <div class="flex items-center justify-end mt-4">
    <x-button class="ml-4 bg-green-600">
        {{$buttonText}}
    </x-button>
    </div>
</div>