<div class="pd-20 card-box mb-30 pt-20 col-md-4">
    <h4 class="text-center">افزودن دسته جدید</h4>
    <form method="post" action="{{ route('categories.store') }}">
        @csrf
        <div class="form-group">
            <label>نام دسته</label>
            <input class="form-control" name="title" type="text" required  placeholder="نام دسته بندی"/>
        </div>
        <div class="form-group">
            <label>نام انگلیسی</label>
            <input class="form-control" name="slug" type="text" required  placeholder="نام انگلیسی"/>
        </div>
        <div class="form-group">
            <label>دسته والد</label>
            <select class="custom-select form-control" id="parent_id" name="parent_id" style="width: 100%; height: 38px">
                <option value="">بدون والد</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->title }}</option>
                @endforeach

            </select>
        </div>
        <div class="form-group">
            <label>توقیحات</label>
            <textarea class="form-control" name="description" placeholder="توضیحات دسته بندی"></textarea>
        </div>
        <div class="form-group">
            <label>تصویر</label>
            <div class="custom-file">
                <input type="file" class="custom-file-input" name="category_img" />
                <label class="custom-file-label">Choose file</label>
            </div>
        </div>
        <button class="btn btn-primary" type="submit">ذخیره</button>
    </form>

</div>
