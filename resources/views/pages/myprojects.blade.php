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
                        <h2>{{Auth::user()->name}}  أهلاً بك </h2>
                        <p>@ {{Auth::user()->name}} </p>
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
                            <form action="/project/add" method="post" accept="application/json" enctype="multipart/form-data">
                                @csrf
                            <div class="mb-3">
                                <input type="text" class="form-control" name="title" id="title" placeholder="Title">
                            </div>
                            <div class="mb-3">
                                <textarea class="form-control" id="Content-text" name="content" placeholder="Content"></textarea>
                            </div>
                            <div class="mb-3">
                                <select class="form-select" name="lang" aria-label="Default select example">
                                    <option selected>Select project tech</option>
                                    <option value="javascript">javascript</option>
                                    <option value="python">python</option>
                                    <option value="php">php</option>
                                    <option value="java">java</option>
                                    <option value="html">html</option>
                                    <option value="flutter">flutter</option>
                                    <option value="css">css</option>
                                  </select>
                            </div>
                            <div class="mb-3">
                                <label class="label-control text-light" for="formFile">Project File</label>
                                <input class="form-control" type="file" id="formFile" name="file">
                            </div>
                                <input type="submit" class="btn btn-light w-100"  value="إضافة"/>
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