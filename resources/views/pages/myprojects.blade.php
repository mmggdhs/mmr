@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show text-center" role="alert" style="position: fixed; top: 20px; left: 50%; transform: translateX(-50%); z-index: 9999;">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>

    <script>
       
        setTimeout(function() {
            var alert = document.querySelector('.alert');
            if (alert) {
                var bsAlert = new bootstrap.Alert(alert);
                bsAlert.close();
            }
        }, 3000);
    </script>
@endif
<x-layout>
    <x-slot:title>my projects</x-slot>
    <section class="py-5 bg-dark">
        <div class="container">
            <div class="bg-light p-4 rounded-3 shadow mb-5 ">
                <div class="d-flex align-items-center">
                    <div class="user-avatar">
                        <img src="images/user.jpeg" alt="شعار المستخدم" class="img-fluid rounded-circle border border-primary" style="width: 150px; height: 150px;">
                    </div>
                    <div class="user-info ms-4">
                        <h2>{{Auth::user()->name}} أهلاً بك</h2>

                        <p>{{ Auth::user()->about }}</p>
                        <button class="btn btn-dark text-light" data-bs-toggle="modal" data-bs-target="#editModal">تعديل الملف الشخصي</button>
                    </div>
                </div>
            </div>

<!--dd-->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editmodelLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content bg-dark text-light rounded shadow-lg">

      <div class="modal-header">
        <h5 class="modal-title" id="editmodelLabel">تعديل الملف الشخصي</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="إغلاق"></button>
      </div>

      <div class="modal-body">
        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="name" class="form-label">الاسم الكامل</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ Auth::user()->name }}" required>
            </div>

            
            <div class="mb-3">
                <label for="about" class="form-label">معلومات عنك</label>
                <textarea class="form-control" id="about" name="about" rows="4" placeholder="اكتب نبذة قصيرة عنك...">{{ Auth::user()->about }}</textarea>
            </div>

            <div class="text-center">
                <button type="submit" class="btn btn-light px-5">حفظ التعديلات</button>
            </div>

        </form>
      </div>

    </div>
  </div>
</div>
        <div class="container text-center">
            <h2 class="mb-3 text-light"> المشاريع الخاص بك</h2>
                <!-- modal -->
                <button type="button" class="btn btn-light w-100 mb-3" data-bs-toggle="modal" data-bs-target="#exampleModal" >إضافة مشروع</button>

                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-3" id="exampleModalLabel">إضافة مشروع جديد</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body bg-dark">
                            @if($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            @endif
                           <form action="/project/add" method="post" accept="application/json" enctype="multipart/form-data" class="bg-dark p-4 rounded shadow-lg text-light">
                            @csrf
                            {{-- <h2 class="mb-4 text-center">إضافة مشروع جديد</h2> --}}
                            <!-- <div class="mb-3">
                                <label for="title" class="form-label">عنوان المشروع</label>
                                <input type="text" class="form-control" name="title" id="title" placeholder="أدخل عنوان المشروع">
                            </div> -->
                            <div class="mb-3">
                                <label for="Content-text" class="form-label">وصف المشروع</label>
                                <textarea class="form-control" id="Content-text" name="content" rows="4" placeholder="اكتب وصفًا مختصرًا عن المشروع"></textarea>
                            </div>

                            <div class="mb-3">
                                <label for="lang" class="form-label">التقنية المستخدمة</label>
                                <select class="form-select" name="lang" id="lang">
                                    <option selected disabled>اختر تقنية المشروع</option>
                                    <option value="javascript">JavaScript</option>
                                    <option value="python">Python</option>
                                    <option value="php">PHP</option>
                                    <option value="java">Java</option>
                                    <option value="html">HTML</option>
                                    <option value="flutter">Flutter</option>
                                    <option value="css">CSS</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="formFile" class="form-label" >ملف المشروع (ZIP)</label>
                                <input class="form-control" type="file" id="formFile" name="file" accept="application/zip">
                            </div>

                            <div class="mb-3" id="video_div">
                                <label class="form-label">هل تريد رفع فيديو لمشروعك أو موقعك؟</label>
                                <br>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="has_link" id="video_yes" value="yes" onchange="toggleVidioInput()">
                                    <label class="form-check-label" for="video_yes">نعم</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="has_link" id="video_no" value="no" onchange="toggleVidioInput()" checked>
                                    <label class="form-check-label" for="has_video_no">لا</label>
                                </div>
                                <div class="" id="video_field" style="display: none;">
                                    <label class="form-label d-block">فيديو المشروع</label>
                                    <label for="formvideo" class="btn bg-light w-100" id="lable_video">📁 اختر فيديو المشروع (الحد 30MB)</label>
                                    <input type="file" class="d-none" id="formvideo" name="video" accept="video/*" onchange="showVideoName(this)">
                                    <div id="video-name" class="text-info mt-2 fst-italic text-center" style="min-height: 1.5rem;"> 
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">هل لديك رابط لمشروعك أو موقعك؟</label>
                                <br>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="has_link" id="link_yes" value="yes" onchange="toggleLinkInput()">
                                    <label class="form-check-label" for="link_yes">نعم</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="has_link" id="link_no" value="no" onchange="toggleLinkInput()" checked>
                                    <label class="form-check-label" for="has_link_no">لا</label>
                                </div>
                            </div>
                            <div class="mb-3" id="link_field" style="display: none;">
                                <label for="project_link" class="form-label">رابط المشروع أو الموقع</label>
                                <input type="url" class="form-control" id="link" name="link" placeholder="أدخل الرابط هنا" />
                            </div>
                                    <script>
                                        function showVideoName(input) {
                                            const label = document.getElementById('video-name');
                                            if (input.files.length > 0) {
                            
                                                document.getElementById('lable_video').innerText=`${input.files[0].name}`;
                                                label.innerHTML = `✅ تم اختيار <strong></strong>`;
                                            

                                            } else {
                                                label.innerHTML = "لم يتم اختيار أي فيديو بعد.";
                                            }
                                            }
                                            // عرض تاق كتابة الرابط
                                            function toggleLinkInput() {
                                                var yesRadio = document.getElementById('link_yes');
                                                var linkField = document.getElementById('link_field');
                                                
                                            
                                                if (yesRadio.checked) {
                                                    linkField.style.display = 'block';
                                                } else {
                                                    linkField.style.display = 'none';
                                                }
                                            }
                                            function toggleVidioInput() {
                                                var yesRadio = document.getElementById('video_yes');
                                                var linkField = document.getElementById('video_field');
                                                
                                                if (yesRadio.checked) {
                                                    linkField.style.display = 'block';
                                                } else {
                                                    linkField.style.display = 'none';
                                                }
                                            }
                                    </script>
                                     <button type="submit" class="btn btn-primary w-100">إضافة المشروع</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

               
                <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                <!-- File Card 1 -->
                @foreach ($projects as $pro )
                    <x-card 
                        title="{{$pro->title}}" 
                        text="{{$pro->content}}" 
                        lang="{{$pro->lang}}" 
                        reportsCount="{{$reports->where('project_id',$pro->id)->count()}}"
                        link="{{url('project',$pro->id)}}"
                        id="{{$pro->id}}"
                        isAlow={{true}} 
                        del="{{url('project/delete',$pro->id)}}" 
                        
                    />  
                @endforeach
            </div>
        </div>
       
    </section>
</x-layout>