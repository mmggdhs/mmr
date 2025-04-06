<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
<x-layout>
    <x-slot:title>project</x-slot>
    <div class="container mt-5 mb-5 ">
        
        <div class="card shadow-lg bg-light">
       



            <div class="card-body text-center text-dark">
                <div class="rounded-circle d-inline-block" style="width: 50px; height: 50px; background-color: #f0db4f;"></div>
                <h3 class="card-title mt-3">{{$project->title}}</h3>
                <p class="card-text">{{$project->content}}</p>
                    <div class="container mt-5 mb-5 shadow-sm p-2">
           
         
            <div class="card shadow-lg p-2 ">
            
            <div class="container mt-2 text-end">
  <button class="btn btn-success btn-lg" type="button">
    <i class="bi bi-download"></i> تحميل
  </button>
</div>


            <div class="row">
  <!--  الفيديو -->
  <div class="col-6" style="border-right: 3px solid rgba(0, 0, 0, 0.5);">
    <h1>فديو الشرح</h1>
    <iframe width="560" height="315" 
      src="https://www.youtube.com/embed/dSS-o7vclxg" 
      title="YouTube video player" 
      frameborder="0" 
      allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" 
      allowfullscreen>
    </iframe>
  </div>

  <!-- ملفات المشاريع-->
  <div class="col-6">
    <h1>الملفات</h1>
    <div class="accordion" id="accordionPanelsStayOpenExample">
  @foreach ($files as $index => $file)
    <div class="accordion-item">
      <h2 class="accordion-header">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapse{{ $index }}" aria-expanded="false" aria-controls="panelsStayOpen-collapse{{ $index }}">
          {{$file->getFilename()}}
        </button>
      </h2>
      <div id="panelsStayOpen-collapse{{ $index }}" class="accordion-collapse collapse">
        <div class="accordion-body">
          <strong>This is the body of {{ $file->getFilename() }}.</strong> You can modify this section based on the content you want to display for each file.
        </div>
      </div>
    </div>
  @endforeach
</div>


  </div>
</div>

            
           </div>
        </div>


               
            </div>
        </div>
    </div>
</x-layout>
