
<x-layout>
    <x-slot:title>project</x-slot>
<div class="container mt-5 mb-5 ">
    <div class="card shadow-lg bg-light">
        <div class="card-body text-center text-dark">
        
            <div class="container mt-5 mb-5 shadow-sm p-3 h-100 "  >
                <div class="d-flex justify-content-end">
                    <a class="btn btn-success btn-lg" href="{{url('project/download',$name)}}">
                        <i class="bi bi-download"></i> تحميل
                    </a>
                    <button type="button" class="btn btn-danger text-dark btn-lg ms-2" data-bs-toggle="modal" data-bs-target="#reportModal">
                        <i class="bi bi-flag"></i> إبلاغ
                    </button>
                </div>
                <div class="card shadow-lg p-2 "> 
                    <div class="row d-flex justify-content-center">
                        <!--  الفيديو -->
                        @isset($video)
                        <div class="col-6  " style="border-right: 3px solid rgba(0, 0, 0, 0.5);">
                                <h1>فديو الشرح</h1>
                            <div class="ratio ratio-16x9">
                                @if($video)
                                    <div class="video-container">
                                        <video width="100%" controls controlsList="nodownload">
                                            <source src="{{ $video }}" type="video/mp4">
                                            <p>متصفحك لا يدعم عرض الفيديو.</p>
                                        </video>
                                    </div>
                                @endif
                            </div>
                        </div>
                        @endisset
                        <!-- ملفات المشاريع-->
                        <div class="col-6">
                        <div class="container mt-2 text-center">
                            <h5 class="m-4">
                                <i class="bi bi-link mx-2">:</i><a class="" href="{{ $project->link }}" target="_blank">{{ $project->link }}</a>
                            </h5>
                    </div>
                        <div class="rounded-circle d-inline-block mx-auto" id="card" style="width: 50px; height: 50px;" ></div>
                            <h3 class="card-title mt-3">{{$project->title}}</h3>
                            <p class="card-text">{{$project->content}}</p>
                        </div> 
                    </div>
                    <!--  تاق عرض ملفات المشروع  -->
                    <div class="col-12 mt-5">
                    <h1>الملفات</h1>
                                    <div class="accordion" id="accordionPanelsStayOpenExample">
                                        <?php
                                         $path = 0;
                                         ?>

                                        @foreach ($files as $index => $file)
                                            <div class="accordion-item">
                                            <h2 class="accordion-header">
                                                @if ($file->getRelativePath())
                                                    @if ($path == 0)
                                                        <button class="accordion-button collapsed" type="button" id="{{$file->getRelativePath()}}" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapse{{ $file->getRelativePath() }}" aria-expanded="false" aria-controls="panelsStayOpen-collapse{{ $index }}">
                                                            {{$file->getRelativePath()}}
                                                        </button>
                                                        <?php
                                                         $path++; 
                                                         ?>
                                                    @endif
                                                @else
                                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapse{{ $index}}" aria-expanded="false" aria-controls="panelsStayOpen-collapse{{ $index }}">
                                                    {{$file->getFilename()}}
                                                    </button>
                                                @endif
                                            </h2>
                                                    @if ($file->getRelativePath())
                                                    <div id="panelsStayOpen-collapse{{ $file->getRelativePath() }}" class="accordion-collapse collapse">
                                                        <div class="accordion-body">
                                                         <strong>
                                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapse{{ $index }}" aria-expanded="false" aria-controls="panelsStayOpen-collapse{{ $index }}">
                                                                {{$file->getFilename()}}    
                                                            </button>
                                                         </strong>
                                                         <div id="panelsStayOpen-collapse{{$index}}" class="accordion-collapse collapse">
                                                            <div class="accordion-body">
                                                                   <strong>{{File::get($file)}}</strong>
                                                           </div>
                                                       </div>
                                                        </div>
                                                    </div>
                                                    @else
                                                    <div id="panelsStayOpen-collapse{{$index}}" class="accordion-collapse collapse">
                                                         <div class="accordion-body">
                                                                <strong>{{File::get($file)}}</strong>
                                                        </div>
                                                    </div>
                                                    @endif
                                        </div>
                                        @endforeach
                                    </div>
                    </div>
                </div>
            </div>           
        </div>
    </div>    
</div>
<script>
    let arr = [
        {"lang":"javascript","color":"#f0db4f"},
        {"lang":"html","color":"#e34f26"},
        {"lang":"python","color":"#306998"},
        {"lang":"css","color":"#264de4"},
        {"lang":"php","color":"#333"},
        {"lang":"java","color":"#333"},
    ];
    

    arr.forEach((e)=>{
        if("{{$project->lang}}" == e.lang){
            document.getElementById('card').style.backgroundColor = e.color;
        }
    });
</script>
</x-layout>
<div class="modal fade" id="reportModal" tabindex="-1" aria-labelledby="reportModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header ">
                <h5 class="modal-title text-center" id="reportModalLabel">إبلاغ</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            <div class="modal-body">
                <!-- Form to report -->
                <form action="{{url(path: '/reports/add')}}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="project_id" class="form-label">رقم المشروع</label>
                        <input class="form-control" name="project_id" id="project_id" rows="4" value="{{$project->id}}" readonly>
                    </div>
                    <!-- Report description -->
                    <div class="mb-3">
                        <label for="details" class="form-label">تفاصيل البلاغ</label>
                        <textarea class="form-control" name="details" id="details" rows="4" placeholder="أدخل تفاصيل البلاغ" required></textarea>
                    </div>

                    <!-- Submit button -->
                    <div class="d-grid">
                        <button type="submit" class="btn btn-dark text-light">إرسال البلاغ</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
