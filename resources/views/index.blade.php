<x-layout>
    <x-slot:title>home</x-slot>
  <!-- Hero Section -->
<section class="py-5 text-light" style="background-image: url({{url('pro.png')}}); background-size: cover; background-position: center;">
    <div class="container text-center">
      <h4>إستكشف أكواد ومشاريع مفتوحة</h4>
      <p class="mt-3"> هو المكان الذي يتم فيه بناء وتطوير البرمجيات والتعاون في المشاريع المفتوحة.</p>
    </div>
  </section>
  <!-- Featured Repositories Section -->
  <section class="mb-5">
    <div class="container bg-dark">
      <h2 class="text-2xl font-bold mb-4 text-light text-center">بعض المشاريع</h2>
      <div class="row row-cols-1 row-cols-md-3 g-4">
        {{-- <div class="col">
          <div class="card bg-light">
            <img src="https://images.unsplash.com/photo-1498050108023-c5249f4df085?auto=format&fit=crop&w=800&q=80" class="card-img-top p-4" alt="مشروع 1" />
            <div class="card-body">
              <h3 class="card-title">مشروع تجريبي 1</h3>
              <p class="card-text">وصف مختصر للمشروع التجريبي</p>
              <button class="btn btn-dark text-light">عرض المشروع</button>
            </div>
          </div>
        </div> --}}
        @isset($projects)
          @if($projects->count() > 2)
              @for ($i = 0;$i<3;$i++)
                <x-card 
                  title="{{$projects[$i]->title}}"
                  text="{{$projects[$i]->content}}"
                  lang="{{$projects[$i]->lang}}"
                  link="{{url('project',$projects[$i]->id)}}"
                  isAlow={{false}}
                />
              @endfor
          @endif
        @endisset
  </section>
  <!-- Stats Section -->
  <section class="stats bg-light py-5">
    <div class="container text-center">
      <h1>ابرز الخدمات التي يقدمها الموقع</h1>
      <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4 mt-4 justify-content-center">
        <!-- Card 1 -->
        <div class="col">
          <div class="card p-4 shadow-sm bg-dark text-light service-card" data-bs-toggle="modal" data-bs-target="#modal1">
            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-indigo-600 mb-4">
              <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/>
              <polyline points="17 8 12 3 7 8"/>
              <line x1="12" y1="3" x2="12" y2="15"/>
            </svg>
            <h3 class="card-title">رفع سريع</h3>
            <p class="card-text">رفع ملفاتك ومشاريعك بسرعة وسهولة</p>
          </div>
        </div>

        <!-- Modal 1 -->
        <div class="modal fade" id="modal1" tabindex="-1" aria-labelledby="modal1Label" aria-hidden="true">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="modal1Label">رفع سريع</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <p>هنا يمكنك رفع ملفاتك ومشاريعك بكل سهولة وسرعة. يمكن أن تدعم هذه الخدمة أنواع متعددة من الملفات مثل الصور والفيديوهات والمستندات.</p>
                <p>تفاصيل إضافية: توفر الخدمة دعمًا كبيرًا من حيث السرعة والأمان. يمكنك رفع الملفات بسرعة عبر الإنترنت وتخزينها بسهولة على الخوادم.</p>
                <a href="myprojects">انتقل لرفع المشاريع</a>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إغلاق</button>
              </div>
            </div>
          </div>
        </div>

        <!-- Card 2 -->
        <div class="col">
          <div class="card p-4 shadow-sm bg-dark text-light service-card" data-bs-toggle="modal" data-bs-target="#modal2">
            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-indigo-600 mb-4">
              <path d="m18 16 4-4-4-4"/>
              <path d="m6 8-4 4 4 4"/>
              <path d="m14.5 4-5 16"/>
            </svg>
            <h3 class="card-title">مشاريع متنوعة</h3>
            <p class="card-text">اكتشف مشاريع في مختلف التقنيات</p>
          </div>
        </div>

        <!-- Modal 2 -->
        <div class="modal fade" id="modal2" tabindex="-1" aria-labelledby="modal2Label" aria-hidden="true">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="modal2Label">مشاريع متنوعة</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <p>في هذا القسم، يمكنك استكشاف مشاريع متعددة في مختلف التقنيات مثل JavaScript، Python، وC++. اختر من بين العديد من المشاريع لتطوير مهاراتك.</p>
                <p>تفاصيل إضافية: المشاريع تشمل تطبيقات ويب، أدوات مفتوحة المصدر، وأدوات لتحسين الإنتاجية، وغيرها من التقنيات المتنوعة.</p>
                <a href="projects">انتقل لصفحة عرض المشاريع</a>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إغلاق</button>
              </div>
            </div>
          </div>
        </div>

        <!-- Card 3 -->
        <div class="col">
          <div class="card p-4 shadow-sm bg-dark text-light service-card" data-bs-toggle="modal" data-bs-target="#modal3">
            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-indigo-600 mb-4">
              <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/>
              <circle cx="9" cy="7" r="4"/>
              <path d="M22 21v-2a4 4 0 0 0-3-3.87"/>
              <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
            </svg>
            <h3 class="card-title">مجتمع المطورين</h3>
            <p class="card-text">تواصل مع مطورين من جميع أنحاء العالم</p>
          </div>
        </div>

        <!-- Modal 3 -->
        <div class="modal fade" id="modal3" tabindex="-1" aria-labelledby="modal3Label" aria-hidden="true">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="modal3Label">مجتمع المطورين</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <p>هذا القسم يتيح لك الفرصة للتواصل مع مطورين من جميع أنحاء العالم، سواء عبر المنتديات أو من خلال المشاريع المشتركة. كن جزءًا من مجتمع عالمي يشارك في نفس الأهداف والاهتمامات.</p>
                <p>تفاصيل إضافية: يمكنك الحصول على ملاحظات فورية، والمشاركة في مشاريع مفتوحة المصدر، والتعلم من المطورين الآخرين.</p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إغلاق</button>
              </div>
            </div>
          </div>
        </div>

       
       
      </div>
    </div>
  </section>
  </section>
  <!-- Stats Section -->
  <section class="stats py-5 bg-dark text-light ">
    <div class="container text-center">
      <h2>إحصائيات الموقع</h2>
      <div class="row row-cols-1 row-cols-md-3 g-4 mt-4 justify-content-center">
        <div class="col ">
          <div class="card shadow-sm p-4 bg-light text-dark">
            <h3 class="card-title">المستودعات</h3>
            <p class="card-text">  {{ $projectCount }} </p>
          </div>
        </div>
        <div class="col">
          <div class="card shadow-sm p-4 bg-light text-dark">
            <h3 class="card-title">المتعاونين</h3>
            <p class="card-text">{{ $userCount }}</p>
          </div>
        </div>
        <!-- <div class="col">
          <div class="card shadow-sm p-4 bg-light text-dark">
            <h3 class="card-title">التحديثات الشهرية</h3>
            <p class="card-text">250+</p>
          </div>
        </div> -->
      </div>
    </div>
  </section>
</x-layout>
<style>

.service-card:hover {
    transform: scale(1.05); 
    cursor: pointer; 
    transition: transform 0.3s ease-in-out; 
}

    </style>