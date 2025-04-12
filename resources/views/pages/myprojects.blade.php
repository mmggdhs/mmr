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

                        <p>مطور برامج مفتوحة المصدر، مهتم بتطوير مشاريع Python و JavaScript.</p>
                        <a href="#" class="btn btn-dark text-light">تعديل الملف الشخصي</a>
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
                            <h1 class="modal-title fs-5 text-center" id="exampleModalLabel">إضافة مشروع جديد</h1>
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
                            <h2 class="mb-4 text-center">إضافة مشروع جديد</h2>

                            <div class="mb-3">
                                <label for="title" class="form-label">عنوان المشروع</label>
                                <input type="text" class="form-control" name="title" id="title" placeholder="أدخل عنوان المشروع">
                            </div>

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
                                <label for="formFile" class="form-label">ملف المشروع (ZIP)</label>
                                <input class="form-control" type="file" id="formFile" name="file" accept="application/zip">
                            </div>

                            <div class="mb-3">
    <label class="form-label d-block">فيديو المشروع</label>

    <!-- زر مخصص لاختيار الفيديو -->
    <label for="formvideo" class="btn btn-outline-light w-100">
        📁 اختر فيديو المشروع (الحد 30MB)
    </label>

    <!-- العنصر الفعلي مرفوع ومخفي -->
    <input type="file" class="d-none" id="formvideo" name="video" accept="video/*" onchange="showVideoName(this)">

    <!-- هنا يظهر اسم الملف -->
    <div id="video-name" class="text-info mt-2 fst-italic text-center" style="min-height: 1.5rem;">
       
    </div>
</div>
<script>
    function showVideoName(input) {
        const label = document.getElementById('video-name');
        if (input.files.length > 0) {
            label.innerHTML = `✅ تم اختيار <strong></strong>`;
        } else {
            label.innerHTML = "لم يتم اختيار أي فيديو بعد.";
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
                        lang="جافا سكربت" 
                        link="{{url('project',$pro->id)}}"
                        isAlow={{true}} 
                        del="{{url('project/delete',$pro->id)}}" 
                    />  
                @endforeach
            </div>
        </div>
    </section>
</x-layout>