<div class="col">
    <div class="card shadow-sm bg-light h-100">
        <div class="card-body text-center text-dark d-flex flex-column">
            <div class="rounded-circle d-inline-block mx-auto" style="width: 50px; height: 50px; background-color: #f0db4f;"></div>
            <h3 class="card-title mt-3">{{$title}}</h3>
            <p class="card-text flex-grow-1">{{$text}}</p>
            <h5 class="card-text">{{$lang}}</h5>

            <a href="{{$link}}" class="btn btn-dark text-light w-100 mt-auto">عرض</a>

            @if($isAlow)
                <form action="{{$del}}" method="post">
                    @csrf
                    @method('DELETE')
                    <input type="submit" class="btn btn-dark text-danger w-100 mt-3" value="حذف" />
                </form>
            @endif
        </div>
    </div>
</div>
