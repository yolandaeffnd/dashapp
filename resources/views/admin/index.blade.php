@extends('components.app-admin')
@section('content')
    <div class="dashboard-body">
        <div class="row gy-4">
            <div class="col-lg-12">
                <!-- Grettings Box Start -->
                <div class="grettings-box position-relative rounded-16 bg-main-600 overflow-hidden gap-16 flex-wrap z-1">
                    <img src="assets/admin/images/bg/grettings-pattern.png" alt=""
                        class="position-absolute inset-block-start-0 inset-inline-start-0 z-n1 w-100 h-100 opacity-6">
                    <div class="row gy-4">
                        <div class="col-sm-7">
                            <div class="grettings-box__content py-xl-4">
                                <h2 class="text-white mb-0">Welcome ! </h2>
                                <p class="text-15 fw-light mt-4 text-white">---------------------------------</p>
                                <p class="text-lg fw-light mt-24 text-white">DATA UNAND is responsible for collecting,
                                    managing, presenting, and analyzing data to support university management.</p>
                            </div>
                        </div>
                        <div class="col-sm-5 d-sm-block d-none">
                            <div class="text-center h-100 d-flex justify-content-center align-items-end ">
                                <img src="assets/home/images/all-img/unand3.png" width="400px" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
