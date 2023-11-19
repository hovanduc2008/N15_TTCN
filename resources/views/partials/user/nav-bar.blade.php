@php
    $menu_list = [
        [
            "title" => "Tác giả",
            "link" => ""
        ],
        [
            "title" => "Mượn sách",
            "link" => "Mua sách"
        ],
        [
            "title" => "Mua sách",
            "link" => "Mua sách"
        ],
        [
            "title" => "Danh mục",
            "link" => "Mua sách"
        ]
    ];
@endphp

<div class="nav">
    <div class="container">
        @foreach($menu_list as $item)
            <a href="{{$item['link']}}">{{$item['title']}}</a>
        @endforeach
    </div>
</div>