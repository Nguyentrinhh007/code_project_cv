<nav class="colorlib-nav" role="navigation">
    <div class="top-menu">
        <div class="container">
            <div class="row">
                <div class="col-xs-2">
                    <div id="colorlib-logo"><a href="/k86/project-3-k86/blog/public/">Fashion</a></div>
                </div>
                <div class="col-xs-10 text-right menu-1">
                    <ul>
                        <li @yield('index')><a href="/k86/project-3-k86/blog/public/">Trang chủ</a></li>
                        <li  class="has-dropdown">
                            <a href="/k86/project-3-k86/blog/public/product">Cửa hàng</a>
                            <ul class="dropdown">
                                <li><a href="/k86/project-3-k86/blog/public/product/cart">Giỏ hàng</a></li>
                                <li><a href="/k86/project-3-k86/blog/public/product/checkout">Thanh toán</a></li>

                            </ul>
                        </li>
                        <li @yield('about')><a href="/k86/project-3-k86/blog/public/about">Giới thiệu</a></li>
                        <li @yield('contact')><a href="/k86/project-3-k86/blog/public/contact">Liên hệ</a></li>
                        <li @yield('cart')><a href="/k86/project-3-k86/blog/public/product/cart"><i class="icon-shopping-cart"></i> Giỏ hàng [{{Cart::Content()->count()}}]</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</nav>
