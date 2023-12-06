<header class="header">
    <div class="container">
        @include('partials.user.logo')
        <div class="control">
            <form class="search" action = "{{route('search')}}">
                <input type="text" name = "search" value = "{{request() -> search ?? ''}}" placeholder = "Tìm kiếm...">
                <a href="{{route('search')}}"><i class="fa-solid fa-magnifying-glass"></i></a>
            </form>
            <div class="menu">
                <a href="" class="noti">
                    <p class="icon" data-noti = "99+"><i class="fa-solid fa-bell"></i></p>
                    <p class="text">Thông báo</p>
                </a>
                <a href="{{route('cart')}}" class="cart">
                    <p class="icon"><i class="fa-solid fa-cart-shopping"></i></p>
                    <p class="text">Giỏ hàng</p>
                </a>
                @if(true) 
                    <a href="" class="account-login">
                        <p class="icon"><i class="fa-solid fa-user"></i></p>
                        <p class="text">Hvanduc</p>
                    </a>
                @else 
                    <a href="" class="account">
                        <p class="icon"><i class="fa-solid fa-user"></i></p>
                        <p class="text">Tài khoản</p>
                    </a>                    
                @endif
            </div>
        </div>
    </div>
</header>