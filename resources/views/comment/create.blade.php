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
                    <p class="px-2 mb-4">Commented By {{$comment->User->first_name.' '.$comment->created_at->diffForHumans()}}  </p>
                    {{-- <p class="px-2 mb-4">Commented {{$comment->User->first_name}}  </p> --}}
                    {{-- <p class="px-2 mb-4">Commented {{$comment->created_at->diffForHumans()}}  </p> --}}

                    </div>
                    
                    @endforeach
                        
                    @endisset
                </div>

                {{-- <div class="w-full my-4">
                    <div x-data={show:false} class="rounded-sm">
                        <div class="border border-b-0 bg-gray-100 px-10 py-6" id="headingOne">
                            <button @click="show=!show" class="underline text-blue-500 hover:text-blue-700 focus:outline-none" type="button">
                            Collapsible Group Item #1
                            </button>
                        </div>
                        <div x-show="show" class="border border-b-0 px-10 py-6">
                            Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                        </div>
                    </div>
                    
                    
                </div> --}}


                <form action="{{route('comments.store',$todo->id)}}" method="post">
                    @csrf
                    @include("comment._form", ["buttonText" => __("Comment")])
                </form>

            </div>
        </div>
    </div>
</x-app-layout>

