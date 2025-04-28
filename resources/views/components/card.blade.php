<div class="col">
 
    <div class="card  bg-light h-100" >
        <button type="button" class="btn btn-danger text-dark w-25 m-1" data-bs-toggle="modal" data-bs-target="#reportModal-{{$id}}">
            إبلاغ
            <i class="bi bi-flag">{{$reportsCount}}</i> 
        </button>
        <div class="card-body text-center text-dark d-flex flex-column" >
            <div class="rounded-circle d-inline-block mx-auto" id="card" style="width: 50px; height: 50px; "></div>
            <h3 class="card-title mt-3">{{$title}}</h3>
            <p class="card-text flex-grow-1">{{$text}}</p>
            <h5 class="card-text ">lang : {{$lang}}</h5>
            {{-- <h5 class="card-text ">{{$isAlow ? null :'dev :'.$dev}}</h5> --}}
                    <a href="{{$link}}" class="btn btn-dark text-light w-100 mt-auto">عرض</a>
                <div class="row mt-3">
                    @if($isAlow)
                      <form class="col " action="{{$del}}" method="post">
                          @csrf
                          @method('DELETE')
                          <input type="submit" class="btn btn-dark text-danger w-100 " value="حذف" />
                      </form>
                      <div class="col">
                                <a 
                                class="btn btn-dark text-success w-100"
                                data-bs-toggle="modal" data-bs-target="#updateModal-{{$id}}"
                                href=""
                                >تعديل</a>
                      </div>
                      <div class="modal fade" id="updateModal-{{$id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-3" id="exampleModalLabel">تعديل المشروع </h1>
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
                               <form action="{{url('project/update',$id)}}" method="post" accept="application/json" enctype="multipart/form-data" class="bg-dark p-4 rounded shadow-lg text-light">
                                @csrf
                                <div class="mb-3">
                                    <label for="Content-text" class="form-label">وصف المشروع</label>
                                    <textarea class="form-control" id="Content-text"  name="content" rows="4" placeholder="اكتب وصفًا مختصرًا عن المشروع">{{$text}}</textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="lang" class="form-label">التقنية المستخدمة</label>
                                    <select class="form-select" name="lang" id="lang">
                                        <option selected value="{{$lang}}" disabled>اختر تقنية المشروع</option>
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
                                    <input class="form-control" type="file"   id="formFile" name="file" accept="application/zip">
                                </div>
                                    <div class="mb-3" >
                                        <label class="form-label d-block">فيديو المشروع</label>
                                        <label for="formvideo" class="btn bg-light w-100" id="lable_video">📁 اختر فيديو المشروع (الحد 30MB)</label>
                                        <input type="file" class="d-none" id="formvideo"  name="video" accept="video/*" >
                                    </div>
                                <div class="mb-3" >
                                    <label for="project_link" class="form-label">رابط المشروع أو الموقع</label>
                                    <input type="url" class="form-control"  id="link" name="link" placeholder="أدخل الرابط هنا" />
                                </div>
                                         <button type="submit" class="btn btn-primary w-100">تعديل </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                  @endif
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
    

    arr.map((e)=>{
        if("{{$lang}}" == e.lang){
            document.getElementById('card').style.backgroundColor = e.color;
        }
    });
</script>
<div class="modal fade" id="reportModal-{{$id}}" tabindex="-1" aria-labelledby="reportModalLabel-{{$id}}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="reportModalLabel-{{$id}}">إبلاغ</h5>
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
                <form action="{{url('/reports/add')}}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="project_id" class="form-label">رقم المشروع</label>
                        <input class="form-control" name="project_id" id="project_id" rows="4" value="{{$id}}" readonly>
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
</div>