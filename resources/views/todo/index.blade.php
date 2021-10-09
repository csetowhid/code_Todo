<x-app-layout>
    <x-slot name="header">
      <div class="flex justify-between">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          {{ __('Task List') }}
      </h2>
      <div class="flex justify-items-end">
        <x-button class="ml-4 bg-green-600">
          <a href="{{route('todos.create')}}">Create Task</a>
      </x-button>
      <x-button class="ml-4 bg-green-600">
        <a href="{{route('categories.index')}}">Category</a>
    </x-button>
      </div>
      </div>
      
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <table class="w-full">
                        <thead>
                          <tr class="text-md text-center font-semibold tracking-wide text-gray-900 bg-gray-100 uppercase border-b border-gray-600">
                            <th class="px-4 py-3">Id</th>
                            <th class="px-4 py-3">Task</th>
                            <th class="px-4 py-3">Image</th>
                            <th class="px-4 py-3">Status</th>
                            <th class="px-4 py-3">Action</th>
                          </tr>
                        </thead>
                        <tbody class="bg-white">
                          @forelse ($list as $todo)
                          <tr class="text-center text-gray-700">
                            <td class="px-4 py-3 border">{{$todo->id}}</td>
                            <td class="px-4 py-3 text-ms font-semibold border">{{$todo->task}}</td>
                            <td class="px-4 py-3 text-ms font-semibold border">
                              <img class="mx-auto" width="60" src="{{asset($todo->image)}}" alt="">
                            </td>
                            <td class="px-4 py-3 text-xs border">
                              @if($todo->is_complete)
                              <span class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-sm">Completed</span>
                              @else
                              <span class="px-2 py-1 font-semibold leading-tight text-red-700 bg-red-100 rounded-sm"> Incomplete </span>
                              @endif
                            </td>
                            <td class="px-4 py-3 text-sm border">
                              <a href="{{route('todos.edit', $todo->id)}}" class="px-2 py-1 font-semibold leading-tight text-yellow-700 bg-yellow-100 rounded-sm">Edit</a>

                              @if(!$todo->is_complete)
                              <a href="{{route('todos.complete', $todo->id)}}" class="complete-todo px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-sm" data-confirm="Are You Sure To Complete This?">Complete</a>
                              @endif

                              <a href="{{route('todos.destroy', $todo->id)}}" class="delete-row px-2 py-1 font-semibold leading-tight text-red-700 bg-red-100 rounded-sm" data-confirm="Are You Sure To Delete This?"> Delete </a>
                              {{-- <a href="posts/2" > --}}
                            </td>
                          </tr>
                          @empty
                          <tr>
                            <td class="px-4 py-3 text-center" colspan="4">{{__("No Data Found.")}}</td>
                          </tr>
                          @endforelse
                          
                        </tbody>
                      </table>
                      <div class="my-4">
                        {{$list->links()}}
                      </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
