@extends('components.app-admin')
@section('content')
<div class="card text-center">
    <div class="card-header">
        <ul class="nav nav-tabs card-header-tabs">
            @foreach($dataChart as $dc)
            <li class="nav-item">
                <a class="nav-link {{ $loop->first ? 'active' : '' }}"
                   href="javascript:void(0);"
                   id="chartBtn{{ $dc->id }}"
                   data-src="{{ $dc->urlChart }}"
                   onclick="changeIframeSource(this)">
                   {{ $dc->namaChart }}
                </a>
            </li>
            @endforeach
        </ul>
    </div>
    <div class="card-body">
        <h5 class="card-title">Chart Mahasiswa</h5>
        <div class="iframe-container">
            <!-- Set the initial iframe src to the URL of the first chart -->
            <iframe
            id="chartIframe"
            src="{{ $dataChart->first()->urlChart }}&navContentPaneEnabled=false"
            width="100%"
            height="700px"
            style="border: none; overflow: hidden;"
            seamless="seamless"
            frameborder="0">
        </iframe>


        </div>
    </div>
</div>
@endsection

<script>
    function changeIframeSource(tab) {
        // Get the URL stored in the data-src attribute
        var iframeUrl = tab.getAttribute('data-src');

        // Get the iframe element and change the src
        document.getElementById('chartIframe').src = iframeUrl;

        // Remove 'active' class from all tabs
        var tabs = document.querySelectorAll('.nav-link');
        tabs.forEach(function(link) {
            link.classList.remove('active');
        });

        // Add 'active' class to the clicked tab
        tab.classList.add('active');
    }
</script>

<!-- CSS to style the active navbar -->
<style>
    .nav-link.active {
        background-color: #007bff; /* Blue color for active tab */
        color: #fff; /* White text for active tab */
        border-color: #007bff; /* Match border with background color */
    }
</style>
