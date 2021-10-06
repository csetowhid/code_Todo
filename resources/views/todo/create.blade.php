<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Todo') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{route('todos.store')}}" method="POST">
                    @csrf
                    <div class="mt-4">
                        <x-label for="Task" :value="__('Task')" />
        
                        <x-input id="task" class="block mt-1 w-full" type="text" name="task" :value="old('task')" required autofocus />
                    </div>
                    <div class="flex items-center justify-end mt-4">
        
                        <x-button class="ml-4">
                            {{ __('Create') }}
                        </x-button>


                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
