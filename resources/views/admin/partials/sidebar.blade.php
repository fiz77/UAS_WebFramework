<aside class="sidebar">
    <div class="sidebar-logo text-center mb-4">
        <img src="{{ asset('assets/img/logo.png') }}" width="120">
    </div>
    
    <div class="sidebar-user">
        <small>Welcome,</small>
        <strong>{{ session('username') ?? 'Admin' }}</strong>
    </div>

    <ul class="sidebar-menu">
        <li><a href="/admin/dashboard" class="active">Dashboard</a></li>
        <li><a href="/admin/members">Member</a></li>
        <li><a href="/admin/orders">Pemesanan</a></li>
        <li><a href="/admin/menu">Menu</a></li>
        <li><a href="/admin/banner">Banner Promo</a></li>
        <li><a href="/">Go to website</a></li>
    </ul>

</aside>
