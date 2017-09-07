@extends('customer_side_main')
 @section('title', 'Flowers')
 @section('css')
    <link href="_CSS/flower.css" rel="stylesheet">
@endsection
 @section('content')
        <!-- START OF GALLERY -->

        <div class = "container-fluid" style="margin-top: 80px">
            <div class="col-md-2">
                <div class=" panel panel-default">
                    <div class="panel-heading librePanelHeading">
                        <div class="panel-title">
                            <b class="pull-right libreMenuIcon"></b>
                            <a data-toggle="collapse" href="#menuPanelListGroup">
                                <span>CATEGORIES</span>
                            </a>
                        </div>
                    </div>
                    <ul class="list-group collapse in" id="menuPanelListGroup">
                        <li class="list-group-item colorx librePanelListGroupItem">
                            <a data-toggle="collapse" href="#menuPanelSubListGroup">
                            <span>Roses</span>
                            </a>
                            <ul id="menuPanelSubListGroup" class="collapse librePanelSubListGroupItem">
                                 <li class="list-group-item colorx librePanelListGroupItem">
                                    <span><a href="#">Ecuadorian red Roses</a></span>
                                </li>
                                <li class="list-group-item colorx librePanelListGroupItem">
                                    <span><a href="#">Ecuadorian Lavander Roses</a></span>
                                </li>
                                <li class="list-group-item colorx librePanelListGroupItem">
                                    <span><a href="#">Bangkok Roses</a></span>
                                </li>
                            </ul>
                        </li>
                        <li class="list-group-item colorx librePanelListGroupItem">
                            <span> <a href="#">Calalily</a></span>
                        </li>
                        <li class="list-group-item colorx librePanelListGroupItem">
                            <span><a href="#">Carnation</a></span>
                        </li>
                        <li class="list-group-item colorx librePanelListGroupItem">
                            <span><a href="#"> Gerberas</a></span>
                        </li>
                        <li class="list-group-item  colorx librePanelListGroupItem">
                            <span><a href="#">Lilies</a></span>
                        </li>
                        <li class="list-group-item colorx librePanelListGroupItem">
                            <span><a href="#">Orchids</a></span>
                        </li>
                        <li class="list-group-item colorx librePanelListGroupItem">
                            <span><a href="#">Stargazers</a></span>
                        </li>
                        <li class="list-group-item colorx librePanelListGroupItem">
                            <span><a href="#">Sunflowers</a></span>
                        </li>
                        <li class="list-group-item colorx librePanelListGroupItem">
                            <span><a href="#">Tulips</a></span>
                        </li>
                    </ul>

                <div class="panel-heading librePanelHeading">
                    <div class="panel-title">
                        <b class="pull-right libreMenuIcon"></b>
                        <a data-toggle="collapse" href="#menu2PanelListGroup">
                            <span>OTHERS</span>
                        </a>
                    </div>
                </div>
                <ul class="list-group collapse out" id="menu2PanelListGroup">
                    <li class="list-group-item colorx librePanelListGroupItem">
                        <a data-toggle="collapse" href="#menu2PanelSubListGroup">
                            <span>Item 1</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="col-xs-10">
            <div class="well wellcolor well-sm">
                <strong>Wonderbloom Flowershop</strong>
            </div>
            @foreach($flowerlist as $flowerlist)
            <div class="item  col-sm-3 ">
                    <div class="thumbnail">
                        <img class="group list-group-image" src="{{ asset('flowerimage/'. $flowerlist -> IMG)}}" alt="" />
                        <br>
                        <div class="caption">
                            <h4 class="group inner list-group-item-heading captionx">
                                {{ $flowerlist -> flower_name }}</h4>
                                <hr class="colorgraph">
                            <div class="row">
                                <div class="col-sm-4">
                                    <span class="label label-danger"> Php. {{ $flowerlist -> Final_SellingPrice }}</span>
                                </div>
                                <div class="col-sm-4">
                                    <a class="btn btn-sm btn-success" href="{{ route('product.show', ['id' => $flowerlist -> flower_ID ])}}">  <span class="glyphicon glyphicon-shopping-cart"></span> View</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
              @endforeach

            </div>
          </div>
    </div>

        <!-- end of flower gallery -->

@endsection
