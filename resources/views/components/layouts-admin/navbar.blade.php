<div class="top-navbar flex-between gap-16">

    <div class="flex-align gap-16">
        <!-- Toggle Button Start -->
         <button type="button" class="toggle-btn d-xl-none d-flex text-26 text-gray-500"><i class="ph ph-list"></i></button>
        <!-- Toggle Button End -->


    </div>
    
    <link href="https://cdn.jsdelivr.net/npm/phosphor-icons@2.0.0/dist/phosphor.css" rel="stylesheet">

    <div class="flex-align gap-16">
        <div class="dropdown">
            <button class="users arrow-down-icon border border-gray-200 rounded-pill p-2 d-inline-block pe-40 position-relative" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                <span class="position-relative">
                    <img src="assets/admin/images/thumbs/user-img.png" alt="Image" class="h-32 w-32 rounded-circle">
                    <span class="activation-badge w-8 h-8 position-absolute inset-block-end-0 inset-inline-end-0"></span>
                </span>
            </button>
            <div class="dropdown-menu dropdown-menu--lg border-0 bg-transparent p-0">
                <div class="card border border-gray-100 rounded-12 box-shadow-custom">
                    <div class="card-body">
                        <div class="flex-align gap-8 mb-6 pb-6 border-bottom border-gray-100">
                            <!-- Mengurangi ukuran gambar dan memperkecil lebar gambar -->
                            <img src="assets/admin/images/thumbs/user-img.png" alt="" class="w-32 h-32 rounded-circle"> <!-- Gambar lebih kecil -->
                            <div class="">
                                <!-- Ukuran teks lebih kecil -->
                                <h4 class="mb-0 text-14">Michel John</h4>
                                <p class="fw-medium text-11 text-gray-200">examplemail@mail.com</p>
                            </div>
                        </div>
                        <ul class="max-h-270 overflow-y-auto scroll-sm pe-4">
                            <li class="mb-3">
                                <a href="setting.html" class="py-8 text-14 px-8 hover-bg-gray-50 text-gray-300 rounded-8 flex-align gap-8 fw-medium">
                                    <span class="text-xl text-primary-600 d-flex"><i class="ph ph-gear"></i></span>
                                    <span class="text">Account Settings</span>
                                </a>
                            </li>
                            <li class="pt-6 border-top border-gray-100">
                                <a href="{{ route('logout') }}" class="py-8 text-14 px-8 hover-bg-danger-50 text-gray-300 hover-text-danger-600 rounded-8 flex-align gap-8 fw-medium">
                                    <span class="text-xl text-danger-600 d-flex"><i class="ph ph-sign-out"></i></span>
                                    <span class="text">Log Out</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</div>
