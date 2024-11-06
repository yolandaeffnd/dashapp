<x-App-admin>
    <!-- Breadcrumb Start -->
<div class="breadcrumb mb-24">
<ul class="flex-align gap-4">
<li><a href="index.html" class="text-gray-200 fw-normal text-15 hover-text-main-600">Home</a></li>
<li> <span class="text-gray-500 fw-normal d-flex"><i class="ph ph-caret-right"></i></span> </li>
<li><span class="text-main-600 fw-normal text-15">Pricing Plan</span></li>
</ul>
</div>
<!-- Breadcrumb End -->

    <div class="card mt-24">
<div class="card-header border-bottom">
<h4 class="mb-4">{{$title}}</h4>
<p class="text-gray-600 text-15">Lakukan Penarikan Data Secara Berkala</p>
</div>
<div class="card-body">
<div class="row gy-4">
    <div class="col-md-4 col-sm-6">
        <div class="plan-item rounded-16 border border-gray-100 transition-2 position-relative">
            <span class="text-2xl d-flex mb-16 text-main-600"><i class="ph ph-package"></i></span>
            <h3 class="mb-4">Data Mahasiswa</h3>
            {{-- <span class="text-gray-600">Perfect plan for students</span> --}}
            {{-- <h2 class="h1 fw-medium text-main mb-32 mt-16 pb-32 border-bottom border-gray-100 d-flex gap-4">
                $50 <span class="text-md text-gray-600">/year</span>
            </h2> --}}
            <a href="#" class="btn btn-outline-main w-100 rounded-pill py-16 border-main-300 text-17 fw-medium mt-32">Tarik Data</a>
        </div>
    </div>

    <div class="col-md-4 col-sm-6">
        <div class="plan-item rounded-16 border border-gray-100 transition-2 position-relative">
            <span class="text-2xl d-flex mb-16 text-main-600"><i class="ph ph-trophy"></i></span>
            <h3 class="mb-4">Data Aktifitas Mahasiswa</h3>
            {{-- <span class="text-gray-600">Your entire friends in one place</span> --}}
            {{-- <h2 class="h1 fw-medium text-main mb-32 mt-16 pb-32 border-bottom border-gray-100 d-flex gap-4">
                2X <span class="text-md text-gray-600">Setahun</span>
            </h2> --}}


            <a href="#" class="btn btn-outline-main w-100 rounded-pill py-16 border-main-300 text-17 fw-medium mt-32">Tarik Data</a>
        </div>
    </div>

    <div class="col-md-4 col-sm-6">
        <div class="plan-item rounded-16 border border-gray-100 transition-2 position-relative">
            <span class="text-2xl d-flex mb-16 text-main-600"><i class="ph ph-trophy"></i></span>
            <h3 class="mb-4">Data Lulusan</h3>
            {{-- <span class="text-gray-600">Your entire friends in one place</span> --}}
            {{-- <h2 class="h1 fw-medium text-main mb-32 mt-16 pb-32 border-bottom border-gray-100 d-flex gap-4">
                5X<span class="text-md text-gray-600">Setahun</span>
            </h2> --}}


            <a href="#" class="btn btn-outline-main w-100 rounded-pill py-16 border-main-300 text-17 fw-medium mt-32">Tarik Data</a>
        </div>
    </div>

    <div class="col-12">
        <label class="form-label mb-8 h6 mt-32">Terms &amp; Policy</label>
        <ul class="list-inside">
            <li class="text-gray-600 mb-4">1. Set up multiple pricing levels with different features and functionalities to maximize revenue</li>
            <li class="text-gray-600 mb-4">2. Continuously test different price points and discounts to find the sweet spot that resonates with your target audience</li>
            <li class="text-gray-600 mb-4">3. Price your course based on the perceived value it provides to students, considering factors</li>
        </ul>
        {{-- <button type="button" class="btn btn-main text-sm btn-sm px-24 rounded-pill py-12 d-flex align-items-center gap-2 mt-24" data-bs-toggle="modal" data-bs-target="#exampleModal">
            <i class="ph ph-plus me-4"></i>
            Add New Plan
        </button> --}}
    </div>
</div>
</div>
</div>


</x-App-admin>
