<x-layout>
    <x-slot:title>sign</x-slot>
        <div class="d-flex justify-content-center align-items-center vh-100">
            <!-- Login card -->
            <div class="card shadow-sm p-4 bg-light" dir="rtl" style="max-width: 400px; width: 100%;">
                <h3 class="text-center mb-4 text-dark">تسجيل </h3>
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
                <form action="/signin" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">أسم المستخدم</label>
                        <input type="text" class="form-control" name="name" id="name" placeholder="أدخل  اسم المستخدم" required>
                    </div>
                     <!-- Email input -->
                     <div class="mb-3">
                        <label for="email" class="form-label">البريد الإلكتروني</label>
                        <input type="email" class="form-control" name="email" id="email" placeholder="أدخل بريدك الإلكتروني" required>
                    </div>
                    <!-- Password input -->
                    <div class="mb-3">
                        <label for="password" class="form-label">كلمة المرور</label>
                        <input type="password" class="form-control" name="password" id="password" placeholder="أدخل كلمة المرور" required>
                    </div>
                    <!-- Submit button -->
                    <div class="d-grid">
                        <button type="submit" class="btn btn-dark text-light">تسجيل </button>
                    </div>
                </form>
                <!-- Footer text with registration link -->
                <div class="text-center mt-3" fixed-bootm>
                    <p> لديك حساب؟ <a href="/login"> تسجيل دخول</a></p>
                </div>
            </div>
        </div>
</x-layout>