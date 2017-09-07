<!-- Navbar -->
        <div class="navbar navbar-fixed-top">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                         <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="/home">Wonderbloom</a>
                </div>

                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav">
                         <li class="active"><a href="/home">Home</a></li>
                         <li><a href="/flowers">Flowers</a></li>
                         <li><a href="/bouquets">Bouquets</a></li>
                         
                    </ul>


                    <ul class="nav navbar-nav navbar-right" style="padding-left: 20px;">
                      @if(Auth::check())
                        <li><a href="{{ route('customer_side.pages.logout') }}">Logout</a></li>
                        <li><a href="{{ route('addtocart.index')}}"><img src = "images/shopping-cart.png" style="width: 23px; height: 23px"></a></li>
                      @else
                        <li><a href="{{ route('customer_side.pages.signin')}}">Sign In</a></li>
                        <li><a href="{{ route('addtocart.index')}}"><img src = "images/shopping-cart.png" style="width: 23px; height: 23px"></a></li>
                      @endif

                    </ul>

                    <div class="search">
                        <div class="nav navbar-nav navbar-right">
                            <form action="" class="search-form">
                                <div class="form-group has-feedback">
                                    <label for="search" class="sr-only">Search</label>
                                    <input type="text" class="form-control" name="search" id="search" placeholder="search">
                                    <span class="glyphicon glyphicon-search form-control-feedback"></span>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <!-- End Of NavBar-->
