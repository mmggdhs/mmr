<x-layout>
    <x-slot:title>verify</x-slot:title>
    <div class="container bg-light mt-5 mb-5 rounded p-5">
            <h2 class="text-center text-dark">
                Check Your Email
                <br>
                and <b class="text-danger">verify</b> it,
                <p class="fs-5">you can't upload projects if your not <b class="text-danger">verifed</b>. </p>
                <form action="{{url('/email/verify/resend')}}" method="POST">
                    @csrf
                    <input class="btn btn-primary fs-5" type="submit" value="re send verify message">
                </form>
            </h2>
    </div>
</x-layout>