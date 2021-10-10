<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="mt-4 mx-4">
                <x-label class="text-lg" for="Name" :value="__('Name')" />
                <h4 class="block mt-1 w-full">{{$todo->task}}</h4>
                </div>
            
                <div class="mt-4 mx-4">
                    <x-label for="Description" :value="__('Description')" />
                    <p class="mt-1 block w-full" name="description">{{$todo->description}}</p>
                </label>
                </div>

                <div class="mt-2 mx-4">
                    @isset($todo)
                    <img width="80" src="{{asset($todo->image)}}" alt="">
                    @endisset
                </div>
                <div class="mt-2 mx-4">
                    @isset($comments)
                    @foreach ($comments as $comment)

                    <div class="my-2 bg-gray-200">
                        <h2 class="px-2 w-100 text-2xl">{{$comment->comment}}</h2>
                    {{-- <p class="px-2 mb-4">Commented By {{$comment->User->first_name.' '.$comment->created_at->diffForHumans()}}  </p> --}}
                    {{-- <p class="px-2 mb-4">Commented {{$comment->User->first_name}}  </p> --}}
                    <p class="px-2 mb-4">Commented {{$comment->created_at->diffForHumans()}}  </p>

                    </div>
                    
                    @endforeach
                        
                    @endisset
                </div>


                <form action="{{route('comments.store',$todo->id)}}" method="post">
                    @csrf
                    @include("comment._form", ["buttonText" => __("Comment")])
                </form>

            </div>
        </div>
    </div>
</x-app-layout>

