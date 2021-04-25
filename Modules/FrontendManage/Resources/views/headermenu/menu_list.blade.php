<div class="row">
    <div class="col-lg-12 card pt-4 pb-4">
        <div id="accordion">
            <div class="card mt-10">
                <div class="card-header" id="pages">
                    <h5 class="mb-0 collapsed create-title" data-toggle="collapse" data-target="#dynamicPages"
                        aria-expanded="false" aria-controls="dynamicPages">
                        <button class="btn btn-link cust-btn-link add_btn_link">
                            @lang('frontendmanage.Pages')
                        </button>
                    </h5>
                </div>
                <div id="dynamicPages" class="collapse" aria-labelledby="pages" data-parent="#accordion">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="primary_input mb-15">
                                    <label class="primary_input_label" for="pagess">
                                        @lang('frontendmanage.Pages')
                                        <span class="text-danger">*</span></label>
                                    <select name="page[]" id="pagess" class="primary_multiselect mb-15" multiple >
                                        @foreach ($pages as $key => $page)
                                            <option value="{{ $page->id }}">{{ $page->title }}</option>
                                        @endforeach
                                    </select>
                                    <div class="row">
                                        <div class="col-lg-5">
                                            <input type="checkbox" id="pagesCheckbox" class="common-checkbox">
                                            <label for="pagesCheckbox"
                                                   class="mt-3">@lang('frontendmanage.Select All') </label>
                                        </div>
                                        <div class="col-lg-7">
                                            <button id="add_page_btn" type="submit"
                                                    class="primary-btn small fix-gr-bg  mt-3  submit_btn" data-toggle="tooltip"
                                                    title="" data-original-title="">
                                                <span class="ti-check"></span>
                                                @lang('frontendmanage.Add Menu')
                                            </button>
                                        </div>
                                    </div>
                                    <span class="text-danger"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header" id="staticPages">
                    <h5 class="mb-0 collapsed create-title" data-toggle="collapse" data-target="#staticPage"
                        aria-expanded="false" aria-controls="staticPage">
                        <button class="btn btn-link cust-btn-link add_btn_link">
                            @lang('frontendmanage.Static Pages')
                        </button>
                    </h5>
                </div>
                <div id="staticPage" class="collapse" aria-labelledby="staticPages" data-parent="#accordion">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="primary_input mb-15">
                                    <label class="primary_input_label" for="staticPagesInput">@lang('frontendmanage.Pages')
                                        <span class="text-danger">*</span>
                                    </label>
                                    <select name="static_pages[]" id="staticPagesInput" class="primary_multiselect mb-15 e1" multiple >
                                        @foreach ($static_pages as $key => $static_page)
                                            <option value="{{ $static_page->id }}">{{ $static_page->title }}</option>
                                        @endforeach
                                    </select>
                                    <div class="row">
                                        <div class="col-lg-5">
                                            <input type="checkbox" id="staticPagesCheckbox" class="common-checkbox" >
                                            <label for="staticPagesCheckbox"
                                                   class="mt-3">@lang('frontendmanage.Select All')</label>
                                        </div>
                                        <div class="col-lg-7">
                                            <button id="add_static_page_btn" type="submit"
                                                    class="primary-btn small fix-gr-bg  mt-3   submit_btn" data-toggle="tooltip"
                                                    title="" data-original-title="">
                                                <span class="ti-check"></span>
                                                @lang('frontendmanage.Add Menu')
                                            </button>
                                        </div>
                                    </div>
                                    <span class="text-danger"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>



            <div class="card">
                <div class="card-header" id="category">
                    <h5 class="mb-0 collapsed create-title" data-toggle="collapse" data-target="#categoryPage"
                        aria-expanded="false" aria-controls="categoryPage">
                        <button class="btn btn-link cust-btn-link add_btn_link">
                            @lang('frontendmanage.Category')
                        </button>
                    </h5>
                </div>
                <div id="categoryPage" class="collapse" aria-labelledby="category" data-parent="#accordion">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="primary_input mb-15">
                                    <label class="primary_input_label" for="categoryInput">@lang('frontendmanage.Pages')
                                        <span class="text-danger">*</span>
                                    </label>
                                    <select name="category[]" id="categoryInput" class="primary_multiselect mb-15 e1" multiple>
                                        @foreach ($categories as $key => $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                    <div class="row">
                                        <div class="col-lg-5">
                                            <input type="checkbox" id="categoryCheckbox" class="common-checkbox">
                                            <label for="categoryCheckbox"
                                                   class="mt-3">@lang('frontendmanage.Select All')</label>
                                        </div>
                                        <div class="col-lg-7">
                                            <button id="add_category_page_btn" type="submit"
                                                    class="primary-btn small fix-gr-bg  mt-3   submit_btn" data-toggle="tooltip"
                                                    title="" data-original-title="">
                                                <span class="ti-check"></span>
                                                @lang('frontendmanage.Add Menu')
                                            </button>
                                        </div>
                                    </div>
                                    <span class="text-danger"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="card">
                <div class="card-header" id="subcategory">
                    <h5 class="mb-0 collapsed create-title" data-toggle="collapse" data-target="#subcategoryPage"
                        aria-expanded="false" aria-controls="subcategoryPage">
                        <button class="btn btn-link cust-btn-link add_btn_link">
                            @lang('frontendmanage.Sub Category')
                        </button>
                    </h5>
                </div>
                <div id="subcategoryPage" class="collapse" aria-labelledby="subcategory" data-parent="#accordion">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="primary_input mb-15">
                                    <label class="primary_input_label" for="subCategoryInput">@lang('frontendmanage.Pages')
                                        <span class="text-danger">*</span>
                                    </label>
                                    <select name="subCategory[]" id="subCategoryInput" class="primary_multiselect mb-15 e1" multiple >
                                        @foreach ($subCategories as $key => $sub)
                                            <option value="{{ $sub->id }}">{{ $sub->name }}</option>
                                        @endforeach
                                    </select>
                                    <div class="row">
                                        <div class="col-lg-5">
                                            <input type="checkbox" id="subCategoryCheckbox" class="common-checkbox">
                                            <label for="subCategoryCheckbox"
                                                   class="mt-3">@lang('frontendmanage.Select All')</label>
                                        </div>
                                        <div class="col-lg-7">
                                            <button id="add_sub_category_page_btn" type="submit"
                                                    class="primary-btn small fix-gr-bg  mt-3  submit_btn" data-toggle="tooltip"
                                                    title="" data-original-title="">
                                                <span class="ti-check"></span>
                                                @lang('frontendmanage.Add Menu')
                                            </button>
                                        </div>
                                    </div>
                                    <span class="text-danger"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="card">
                <div class="card-header" id="courses">
                    <h5 class="mb-0 collapsed create-title" data-toggle="collapse" data-target="#coursePage"
                        aria-expanded="false" aria-controls="coursePage">
                        <button class="btn btn-link cust-btn-link add_btn_link">
                            @lang('frontendmanage.Courses')
                        </button>
                    </h5>
                </div>
                <div id="coursePage" class="collapse" aria-labelledby="courses" data-parent="#accordion">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="primary_input mb-15">
                                    <label class="primary_input_label" for="courseInput">@lang('frontendmanage.Pages')
                                        <span class="text-danger">*</span>
                                    </label>
                                    <select name="courses[]" id="courseInput" class="primary_multiselect mb-15 e1" multiple >
                                        @foreach ($courses as $key => $course)
                                            <option value="{{ $course->id }}">{{ $course->title }}</option>
                                        @endforeach
                                    </select>
                                    <div class="row">
                                        <div class="col-lg-5">
                                            <input type="checkbox" id="coursesCheckbox" class="common-checkbox">
                                            <label for="coursesCheckbox"
                                                   class="mt-3">@lang('frontendmanage.Select All')</label>
                                        </div>
                                        <div class="col-lg-7">
                                            <button id="add_course_page_btn" type="submit"
                                                    class="primary-btn small fix-gr-bg  mt-3  submit_btn" data-toggle="tooltip"
                                                    title="" data-original-title="">
                                                <span class="ti-check"></span>
                                                @lang('frontendmanage.Add Menu')
                                            </button>
                                        </div>
                                    </div>
                                    <span class="text-danger"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="card">
                <div class="card-header" id="quizzes">
                    <h5 class="mb-0 collapsed create-title" data-toggle="collapse" data-target="#quizPages"
                        aria-expanded="false" aria-controls="quizPages">
                        <button class="btn btn-link cust-btn-link add_btn_link">
                            @lang('frontendmanage.Quizzes')
                        </button>
                    </h5>
                </div>
                <div id="quizPages" class="collapse" aria-labelledby="quizzes" data-parent="#accordion">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="primary_input mb-15">
                                    <label class="primary_input_label" for="quizInput">@lang('frontendmanage.Pages')
                                        <span class="text-danger">*</span>
                                    </label>
                                    <select name="quiz[]" id="quizInput" class=" primary_multiselect mb-15 e1" multiple>
                                        @foreach ($quizzes as $key => $quiz)
                                            <option value="{{ $quiz->id }}">{{ $quiz->title }}</option>
                                        @endforeach
                                    </select>
                                    <div class="row">
                                        <div class="col-lg-5">
                                            <input type="checkbox" id="quizCheckbox" class="common-checkbox">
                                            <label for="quizCheckbox"
                                                   class="mt-3">@lang('frontendmanage.Select All')</label>
                                        </div>
                                        <div class="col-lg-7">
                                            <button id="add_quiz_page_btn" type="submit"
                                                    class="primary-btn small fix-gr-bg  mt-3   submit_btn" data-toggle="tooltip"
                                                    title="" data-original-title="">
                                                <span class="ti-check"></span>
                                                @lang('frontendmanage.Add Menu')
                                            </button>
                                        </div>
                                    </div>
                                    <span class="text-danger"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>



            <div class="card">
                <div class="card-header" id="liveClass">
                    <h5 class="mb-0 collapsed create-title" data-toggle="collapse" data-target="#liveClassPage"
                        aria-expanded="false" aria-controls="liveClassPage">
                        <button class="btn btn-link cust-btn-link add_btn_link">
                            @lang('frontendmanage.Live Class')
                        </button>
                    </h5>
                </div>
                <div id="liveClassPage" class="collapse" aria-labelledby="liveClass" data-parent="#accordion">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="primary_input mb-15">
                                    <label class="primary_input_label" for="classInput">@lang('frontendmanage.Pages')
                                        <span class="text-danger">*</span>
                                    </label>
                                    <select name="class[]" id="classInput" class="primary_multiselect  mb-15 e1"  multiple="multiple">
                                        @foreach ($classes as $key => $class)
                                            <option value="{{ $class->id }}">{{ $class->title }}</option>
                                        @endforeach
                                    </select>
                                    <div class="row">
                                        <div class="col-lg-5">
                                            <input type="checkbox" id="classCheckbox" class="common-checkbox">
                                            <label for="classCheckbox"
                                                   class="mt-3">@lang('frontendmanage.Select All')</label>
                                        </div>
                                        <div class="col-lg-7">
                                            <button id="add_class_page_btn" type="submit"
                                                    class="primary-btn small fix-gr-bg mt-3 submit_btn" data-toggle="tooltip"
                                                    title="" data-original-title="">
                                                <span class="ti-check"></span>
                                                @lang('frontendmanage.Add Menu')
                                            </button>
                                        </div>
                                    </div>
                                    <span class="text-danger"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>



            <div class="card">
                <div class="card-header" id="customLink">
                    <h5 class="mb-0 collapsed create-title" data-toggle="collapse" data-target="#pages5"
                        aria-expanded="false" aria-controls="collapsePages">
                        <button class="btn btn-link cust-btn-link add_btn_link">
                            @lang('frontendmanage.Custom Links')
                        </button>
                    </h5>
                </div>
                <div id="pages5" class="collapse" aria-labelledby="customLink" data-parent="#accordion">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class='input-effect'>
                                    <input class='primary-input form-control' type='text' id="tTitle" name='title'
                                           autocomplete='off'>
                                    <label>@lang('common.Title')<span>*</span></label>
                                    <span class='focus-border'></span>
                                </div>
                                <span class="text-danger" id="titleError"></span>
                            </div>
                            <div class="col-lg-12 mt-40 mb-30">
                                <div class='input-effect'>
                                    <input class='primary-input form-control' type='text' id="tLink" name='link'
                                           autocomplete='off'>
                                    <label>@lang('frontendmanage.Link')</label>
                                    <span class='focus-border'></span>
                                </div>
                                <span class="text-danger" id="linkError"></span>
                            </div>
                            <div class="col-lg-12 text-center mt-10">
                                <button id="add_custom_link_btn" type="submit" class="primary-btn small fix-gr-bg   submit_btn"
                                        data-toggle="tooltip" title="" data-original-title="">
                                    <span class="ti-check"></span>
                                    @lang('frontendmanage.Add Menu')
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
