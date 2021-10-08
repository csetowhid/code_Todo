<div class="mt-4">
    <x-label for="Task" :value="__('Task')" />

<x-input id="task" class="block mt-1 w-full" type="text" name="task" value="{{old('task')}}" required autofocus />
<p class="text-red-600">{{$errors->first('task')}}</p>
</div>