l@php
    use Illuminate\Support\Str;
    $menus = [
        [
            "title" => "Dashboard",
            "route" => route('admin.dashboard'),
        ],
        [
            "title" => "Tác giả",
            "subroute" => [
                [
                    "title" => "Danh sách tác giả",
                    "route" => route('admin.authors')
                ],
                [
                    "title" => "Thêm tác giả",
                    "route" => route('admin.author.create'),
                ],
                
            ]
        ],
        [
            "title" => "Danh mục",
            "subroute" => [
                [
                    "title" => "Danh sách danh mục",
                    "route" => route('admin.categories')
                ],
                [
                    "title" => "Thêm danh mục",
                    "route" => route('admin.category.create'),
                ],
                
            ]
        ],
        [
            "title" => "Sản phẩm",
            "subroute" => [
                [
                    "title" => "Danh sách sản phẩm",
                    "route" => route('admin.products'),
                ],
                [
                    "title" => "Thêm sản phẩm",
                    "route" => route('admin.product.create'),
                ]
            ]
        ],
        [
            "title" => "Đơn hàng",
            "route" => route('admin.orders'),
        ],
    ];

    function renderMenu($menus) {
        foreach($menus as $menu){
            if(isset($menu['subroute'])){
                echo "<li  class='has_sub'>
                    <a href='javascript:void(0);' class='waves-effect'><i class='mdi mdi-email-outline'></i><span> ".$menu['title']." <span class='pull-right'><i class='mdi mdi-chevron-right'></i></span> </span></a>";
                echo "<ul class='list-unstyled'>";
                   
                    renderMenu($menu['subroute']);
                echo "</ul> </li>";
            }    
            else{
                echo "<li><a href='" .$menu["route"]. "' class='waves-effect'><i class='mdi mdi-cube-outline'></i><span>". $menu['title']." </span></a></li>";
            }     
        }
    }
@endphp

    <div id="sidebar-menu">
        <ul>
            {{renderMenu($menus)}}
        </ul>
    </div>

