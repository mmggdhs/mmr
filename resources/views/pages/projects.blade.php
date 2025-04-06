<x-layout>
    <x-slot:title>projects</x-slot>
    <!-- File List Section -->

    <section class="py-5 bg-dark">
        <div class="container text-center">
            <h2 class="mb-5 text-light">جميع المشاريع</h2>
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                <!-- Card -->
                @foreach ($projects as $pro )
                        <x-card 
                            title="{{$pro->title}}" 
                            text="{{$pro->content}}" 
                            lang="جافا سكربت" 
                            link="{{url('project',$pro->id)}}" 
                            isAlow={{false}}
                        />  
                @endforeach
            </div>   
        </div>
    </section>
</x-layout>