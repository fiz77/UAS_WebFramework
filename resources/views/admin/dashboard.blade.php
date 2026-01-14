@extends('layouts.admin')

@section('content')
<div class="dashboard-wrapper">

    {{-- ROW ATAS --}}
    <div class="dashboard-top">

        {{-- TODAY LOGIN --}}
        <div class="card today-login">
            <strong> Today login</strong>
            <small>From: Lauk Ketjeh</small>
            <div class="login-user">
                <img src="{{ asset('admin/img/admin.png') }}" alt="">
            </div>
            <div>
                <strong>Nayla Sahira</strong>
            </div>
            <small>As Admin</small>
        </div>

        {{-- QUICK ACCESS --}}
        <div class="quick-grid">

            <div class="quick-card">
                <img src="{{ asset('admin/img/iconfolder.png') }}">
                <div class="qc-text">
                    <strong>Project</strong>
                    <small>0 Files</small>
                </div>
            </div>

            <div class="quick-card">
                <img src="{{ asset('admin/img/iconfolder.png') }}">
                <div class="qc-text">
                    <strong>Konten</strong>
                    <small>0 Files</small>
                </div>
            </div>

            <div class="quick-card">
                <img src="{{ asset('admin/img/gd.png') }}">
                <div class="qc-text">
                    <strong>Google Drive</strong>
                    <small>83 Gb / 512 Gb</small>
                </div>
            </div>

            <div class="quick-card">
                <img src="{{ asset('admin/img/iconfolder.png') }}">
                <div class="qc-text">
                    <strong>Ads</strong>
                    <small>0 Files</small>
                </div>
            </div>

            <div class="quick-card">
                <img src="{{ asset('admin/img/iconfolder.png') }}">
                <div class="qc-text">
                    <strong>Documents</strong>
                    <small>0 Files</small>
                </div>
            </div>

            <div class="quick-card">
                <img src="{{ asset('admin/img/od.png') }}">
                <div class="qc-text">
                    <strong>One Drive</strong>
                    <small>83 Gb / 512 Gb</small>
                </div>
            </div>

        </div>


    </div>

    {{-- ROW BAWAH --}}
    <div class="dashboard-bottom">

        {{-- CHART --}}
        <div class="card chart-card">
            <canvas id="salesChart" height="310"></canvas>
        </div>

        {{-- KALENDER --}}
        <div class="card calendar-card">
            <h6>Kalender</h6>
            <div class="calendar-grid">
                <span>Mo</span><span>Tu</span><span>We</span><span>Th</span><span>Fr</span><span>Sa</span><span>Su</span>

                @for($i = 1; $i <= 31; $i++)
                    <span class="{{ $i == date('d') ? 'active' : '' }}">{{ $i }}</span>
                @endfor
            </div>
        </div>

    </div>

</div>
@endsection

@push('scripts')
<script>
const ctx = document.getElementById('salesChart');

new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ['Nasi Box', 'Prasmanan', 'Tumpeng', 'Aqiqah'],
        datasets: [{
            data: [12, 19, 9, 15],
            backgroundColor: ['#FFC800', '#f4b400', '#ff9800', '#e53935']
        }]
    },
    options: {
        plugins: { legend: { display: false } },
        scales: { y: { beginAtZero: true } }
    }
});
</script>
@endpush
