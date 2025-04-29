<x-layout>
    <x-slot:title>resert password</x-slot>
        <div class="d-flex justify-content-center align-items-center vh-100">
            <!-- Login card -->
            <div class="card shadow-sm p-4 bg-light" dir="rtl" style="max-width: 400px; width: 100%;">
                <h3 class="text-center mb-4 text-dark">إستعادة كلمة المرور </h3>
                @if($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <!-- Form to login -->
                <form action="{{url('/reset-password')}}" method="POST">
                    @csrf
                    <!-- Email input -->
                    <div class="mb-3">
                        <label for="email" class="form-label">البريد الإلكتروني</label>
                        <input type="email" class="form-control" name="email" id="email" placeholder="أدخل بريدك الإلكتروني" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">كلمة المرور </label>
                        <input type="password" class="form-control" name="password" id="password" placeholder=" كلمة المرور " required>
                    </div>
                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label"> تأكيد كلمة المرور </label>
                        <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" placeholder="تأكيد كلمة المرور " required>
                    </div>
                    <div class="mb-3">
                        <input type="hidden" class="form-control" name="token" id="token" value="{{$token}}">
                    </div>
                    <!-- Submit button -->
                    <div class="d-grid">
                        <button type="submit" class="btn btn-dark text-light"> إرسال</button>
                    </div>
                </form>
            </div>
        </div>
</x-layout>