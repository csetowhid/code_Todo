<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Todo') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <form action="{{route('todos.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @include("todo._form", ["buttonText" => __("Create")])
                </form>
            </div>
        </div>
    </div>
</x-app-layout>