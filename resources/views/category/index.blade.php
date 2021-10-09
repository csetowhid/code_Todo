<x-app-layout>
    <x-slot name="header">
      <div class="flex justify-between">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          {{ __('Category List') }}
      </h2>
      <x-button class="ml-4 bg-green-600">
        <a href="{{route('categories.create')}}">Create Category</a>
    </x-button>
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
                            <th class="px-4 py-3">Name</th>
                            <th class="px-4 py-3">Action</th>
                          </tr>
                        </thead>
                        <tbody class="bg-white">
                          @forelse ($categories as $category)
                          <tr class="text-center text-gray-700">
                            <td class="px-4 py-3 border">{{$category->id}}</td>
                            <td class="px-4 py-3 text-ms font-semibold border">{{$category->name}}</td>
                            
                            <td class="px-4 py-3 text-sm border">
                              <a href="{{route('categories.edit', $category->id)}}" class="px-2 py-1 font-semibold leading-tight text-yellow-700 bg-yellow-100 rounded-sm">Edit</a>

                              <a href="{{route('categories.destroy', $category->id)}}" class="delete-row px-2 py-1 font-semibold leading-tight text-red-700 bg-red-100 rounded-sm" data-confirm="Are You Sure To Delete This?"> Delete </a>
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
                        {{$categories->links()}}
                      </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
