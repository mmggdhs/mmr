<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
<x-layout>
    <x-slot:title>project</x-slot>
<div class="container mt-5 mb-5 ">
    <div class="card shadow-lg bg-light">
        <div class="card-body text-center text-dark">
            
            <div class="container mt-5 mb-5 shadow-sm p-3 h-100 "  >
                <div class="card shadow-lg p-2 "> 
                  
                    <div class="row">
                        <!--  الفيديو -->
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
                        <!-- ملفات المشاريع-->
                        <div class="col-6">
                        <div class="container mt-2 text-end">
                        <a href="{{ $link }}" target="_blank">{{ $link }}</a>
                                <a class="btn btn-success btn-lg" href="{{url('project/download',$name)}}">
                                    <i class="bi bi-download"></i> تحميل
                                </a>
                                <button type="button" class="btn btn-danger text-dark btn-lg ms-2" data-bs-toggle="modal" data-bs-target="#reportModal">
                            <i class="bi bi-flag"></i> إبلاغ
                        </button>
                        
                    </div>
                        <div class="rounded-circle d-inline-block" style="width: 50px; height: 50px; background-color: #f0db4f;"></div>
                        <h3 class="card-title mt-3">{{$project->title}}</h3>
                        <p class="card-text">{{$project->content}}</p>
                        
                        </div> 
                    </div>
                    <!--  تاق عرض ملفات المشروع  -->
                    <div class="col-12 mt-5">
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
                                                    <strong>{{File::get($file)}}</strong>
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

</x-layout>
<div class="modal fade" id="reportModal" tabindex="-1" aria-labelledby="reportModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="reportModalLabel">إبلاغ</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Form to report -->
                <form method="POST">
                    @csrf
                    <!-- Name field -->
                    <div class="mb-3">
                        <label for="name" class="form-label">الاسم</label>
                        <input type="text" class="form-control" name="name" id="name" placeholder="أدخل أسمك" required>
                    </div>

                    <!-- Email input -->
                    <div class="mb-3">
                        <label for="email" class="form-label">البريد الإلكتروني</label>
                        <input type="email" class="form-control" name="email" id="email" placeholder="أدخل بريدك الإلكتروني" required>
                    </div>

                    <!-- Report description -->
                    <div class="mb-3">
                        <label for="description" class="form-label">تفاصيل البلاغ</label>
                        <textarea class="form-control" name="description" id="description" rows="4" placeholder="أدخل تفاصيل البلاغ" required></textarea>
                    </div>

                    <!-- Submit button -->
                    <div class="d-grid">
                        <button type="submit" class="btn btn-dark text-light">إرسال البلاغ</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
