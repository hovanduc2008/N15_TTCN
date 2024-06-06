@php
    $menu_list = [
        [
            "title" => "Tác giả",
            "link" => route('authors')
        ],
        [
            "title" => "Sản phẩm",
            "link" => route('search', ['type' => 'sell']),
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