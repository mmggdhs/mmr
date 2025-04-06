<x-layout>
    <x-slot:title>project</x-slot>
    <div class="container mt-5 mb-5">
        <div class="card shadow-lg bg-light">
            <div class="card-body text-center text-dark">
                <div class="rounded-circle d-inline-block" style="width: 50px; height: 50px; background-color: #f0db4f;"></div>
                <h3 class="card-title mt-3">{{$project->title}}</h3>
                <p class="card-text">{{$project->content}}</p>
                {{-- <h5 class="card-text">{{$lang}}</h5> --}}
                {{-- <a href="{{Storage::url($project->file)}}" class="card-text text-dark">{{$project->file}} </a> --}}
                <div class="container">
                    @foreach ($files as $file)
                        <h2>{{$file->getFilename()}}</h2>
                        
                    @endforeach
                    {{-- <h2>{{$files}}</h2> --}}
                </div>
            </div>
        </div>
    </div>
</x-layout>