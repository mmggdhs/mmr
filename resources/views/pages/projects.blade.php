<x-layout>
    <x-slot:title>projects</x-slot>
    <!-- File List Section -->

    <section class="py-5 bg-dark">
        <div class="container text-center">
            <h2 class="mb-5 text-light">جميع المشاريع</h2>
            <form class="row g-3 mb-5" action="/projects/search" method="get">
                <div class="col-10">
                    <input type="text" name="search" class="form-control"  placeholder="search">
                </div>
                <div class="col-auto">
                    <input type="submit" value="Search" class="btn btn-light">
                </div>
                <div class="col-auto">
                    <select class="form-select" name="lang" aria-label="Default select example">
                        <option selected>Filter by Lang</option>
                        <option value="javascript">javascript</option>
                        <option value="python">python</option>
                        <option value="php">php</option>
                        <option value="java">java</option>
                        <option value="html">html</option>
                        <option value="flutter">flutter</option>
                        <option value="css">css</option>
                    </select>
                </div>
                <div class="col-auto">
                    <a class="btn btn-light" href="/projects">clear</a>
                </div>
            </form>
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                <!-- Card -->
                {{-- <h2 class="text-light">{{$reports}}</h2> --}}
                @foreach ($projects as $project)
                            <x-card 
                                title="{{$project->title}}"
                                text="{{$project->content}}"
                                lang="{{$project->lang}}"
                                id="{{$project->id}}"
                                reportsCount="{{$reports->where('project_id',$project->id)->count()}}"
                                link="{{url('project',$project->id)}}"
                                isAlow={{false}}
                            />
                @endforeach
            </div>   
        </div>
    </section>
</x-layout>