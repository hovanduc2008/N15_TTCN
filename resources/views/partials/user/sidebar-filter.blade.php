<div class="sidebar-filter">
    <form>
        <h1>LỌC THEO</h1>
        <div class="btn-control">
            <a href="">Bỏ lọc</a>
            <button href="">Lọc</button>
        </div>
        <div class="sort-by">
            <h4>Sắp xếp theo</h4>
            <select name="sort" id="">
                <option value="1">tăng dần</option>
            </select>
        </div>
        <div class="price">
            <h4>Giá</h4>
            <div class="price-input">
                Từ: <input type="number" min = "0" max = "10000000">
                Đến: <input type="number" min = "0" max = "10000000">
            </div>
        </div>
        <div class="categories">
            <h4>Danh mục</h4>
            <div class="cate-list list">
                <p>Truyện tranh</p>
                <p>Truyện ngắn</p>
                <p>Truyện kinh dị</p>
                <p>Truyện tranh</p>
                <p>Truyện ngắn</p>
                <p>Truyện kinh dị</p>
            </div>
            
        </div>
        <div class="authors">
            <h4>Tác giả</h4>
            <div class="author-list list">
                <p>Truyện tranh</p>
                <p>Truyện ngắn</p>
                <p>Truyện kinh dị</p>
            </div>
        </div>
        @method('GET')
        
    </form>
</div>