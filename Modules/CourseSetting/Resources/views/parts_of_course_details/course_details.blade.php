 <form action="{{route('AdminUpdateCourse')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                    <div class="row">
                                        <div class="col-xl-12">
                                            <div class="primary_input mb-25">
                                                <label class="primary_input_label" for="">{{__('courses.Course Title')}} </label>
                                                <input class="primary_input_field" name="title" value="{{@$course->title}}" placeholder="-" type="text">
                                            </div>
                                        </div>
                                        

                                    </div>
                                    <input type="hidden" name="id" class="course_id" value="{{@$course->id}}">
                                        <div class="col-xl-12">
                                            <div class="primary_input mb-35">
                                                <label class="primary_input_label" for="">{{__('courses.Course')}} {{__('courses.Description')}}</label>
                                                <textarea class="lms_summernote" name="about" name="" id="" cols="30" rows="10">{!!@$course->about!!}</textarea>
                                        </div>
                                    <div class="row">

                                        <div class="col-xl-6">
                                              <select class="primary_select edit_category_id" data-course_id="{{@$course->id}}" name="category" id="course">
                                                    <option data-display="Select Course" value="">{{__('common.Select')}} {{__('quiz.Category')}} </option>
                                                    @foreach($categories as $category)
                                                            <option value="{{$category->id}}" @if ($category->id==$course->category_id) selected @endif>{{@$category->name}} </option>
                                                    @endforeach
                                            </select>
                                            </div>
                                            <div class="col-xl-6" id="edit_subCategoryDiv{{@$course->id}}">
                                                 <select class="primary_select " name="sub_category" id="edit_subcategory_id{{@$course->id}}">
                                                    <option data-display="{{__('common.Select')}} Sub Category" value="">{{__('common.Select')}} Sub Category</option>
                                                    <option  value="{{@$course->subcategory_id}}" selected>{{@$course->subCategory->name}}</option>
                                                   
                                            </select>
                                            </div>
                                        </div>
                                    <div class="row mt-20">

                                        <div class="col-xl-4 mt-30">
                                              <select class="primary_select" name="level">
                                                    <option data-display="{{__('common.Select')}} {{__('common.Level')}}" value="">{{__('common.Select')}} {{__('common.Level')}}</option>
                                                    
                                                            <option value="1" @if (@$course->level==1) selected @endif>Beginner</option>
                                                            <option value="2" @if (@$course->level==2) selected @endif>Intermediate</option>
                                                            <option value="3" @if (@$course->level==3) selected @endif>Advance</option>
                                                            <option value="4" @if (@$course->level==4) selected @endif>Pro</option>
                                                   
                                            </select>
                                            </div>
                                            <div class="col-xl-4 mt-30" id="">
                                                 <select class="primary_select" name="language" id="">
                                                    <option data-display="{{__('common.Select')}} {{__('courses.Language')}}" value="">{{__('common.Select')}} {{__('courses.Language')}}</option>
                                                    @foreach ($languages as $language)
                                                        <option value="{{$language->id}}" @if ($language->id==$course->lang_id) selected @endif>{{$language->language_name}}</option>
                                                    @endforeach
                                            </select>
                                            </div>
                                            <div class="col-xl-4">
                                                <div class="primary_input mb-25">
                                                    <label class="primary_input_label" for="">Duration</label>
                                                    <input class="primary_input_field" name="duration" placeholder="-" value="{{@$course->duration}}" type="text">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div  class="col-lg-6">
                                            <div  class="checkbox_wrap d-flex align-items-center">
                                                <label  for="course_1" class="switch_toggle">
                                                    <input  type="checkbox" id="edit_course_1"> 
                                                    <div  class="slider round"></div>
                                                </label>
                                                <label >This course is a top course</label>
                                            </div>
                                            </div>
                                        </div>
                                        <div class="row mt-20">
                                            <div  class="col-lg-6">
                                            <div  class="checkbox_wrap d-flex align-items-center mt-40">
                                                <label  for="edit_course_2{{$course->id}}" class="switch_toggle">
                                                    <input  type="checkbox" class="edit_course_2" id="edit_course_2{{$course->id}}" value="{{@$course->id}}"> 
                                                    <div  class="slider round"></div>
                                                </label>
                                                <label >This course is a free course</label>
                                            </div>
                                            </div>
                                            <div class="col-xl-4" id="edit_price_div{{@$course->id}}">
                                                <div class="primary_input mb-25">
                                                    <label class="primary_input_label" for="">Price</label>
                                                    <input class="primary_input_field" name="price" placeholder="-" value="{{@$course->price}}" type="text">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mt-20">
                                            <div  class="col-lg-6">
                                            <div  class="checkbox_wrap d-flex align-items-center mt-40">
                                                <label  for="edit_course_3{{$course->id}}" class="switch_toggle">
                                                    <input  type="checkbox" class="edit_course_3" id="edit_course_3{{$course->id}}" value="{{@$course->id}}"> 
                                                    <div  class="slider round"></div>
                                                </label>
                                                <label >This course has discounted price</label>
                                            </div>
                                            </div>
                                            <div class="col-xl-4" id="edit_discount_price_div{{@$course->id}}" style="display: none">
                                                <div class="primary_input mb-25">
                                                    <label class="primary_input_label" for="">Discount Price</label>
                                                    <input class="primary_input_field" name="discount_price" value="{{@$course->discount_price}}" placeholder="-" type="text">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row mt-20">

                                            <div class="col-xl-4 mt-25">
                                                 <select class="primary_select" name="host" id="">
                                                    <option data-display="Course overview host" value="">Course overview host</option>
                                                    
                                                           <option value="Youtube" @if ($course->host=='Youtube') selected @endif>Youtube</option>
                                                            <option value="Hulu" @if ($course->host=='Hulu') selected @endif>Hulu</option>
                                                            <option value="Metacafe" @if ($course->host=='Metacafe') selected @endif>Metacafe</option>
                                                            <option value="Veoh" @if ($course->host=='Veoh') selected @endif>Veoh</option>
                                                            <option value="Vimeo" @if ($course->host=='Vimeo') selected @endif>Vimeo</option>
                                                            <option value="Dailmotion" @if ($course->host=='Dailmotion') selected @endif>Dailymotion</option>
                                                   
                                            </select>
                                            </div>
                                            <div class="col-xl-8">
                                           <div class="primary_input mb-25">
                                                    <label class="primary_input_label" for="">Video URL</label>
                                                    <input class="primary_input_field" value="{{@$course->trailer_link}}" name="trailer_link" placeholder="-" type="text">
                                                </div>
                                        </div>
                                        </div>
                                        <div class="row mt-20">

                                          
                                            <div class="col-xl-12">
                                            <div class="primary_input mb-35">
                                                <label class="primary_input_label" for="">Course Thumbnail</label>
                                                <div class="primary_file_uploader">
                                                    <input class="primary-input" type="text" id="placeholderFileOneName" value="{{showPicName(@$course->thumbnail)}}" placeholder="Browse Image file" readonly="">
                                                    <button class="" type="button">
                                                        <label class="primary-btn small fix-gr-bg" for="document_file_1">Browse</label>
                                                        <input type="file" class="d-none" name="image" id="document_file_1">
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        </div>
                                        
                                        <div class="row">

                                            <div class="col-xl-12">
                                                <div class="primary_input mb-25">
                                                    <label class="primary_input_label" for="">Meta keywords</label>
                                                    <input class="primary_input_field" name="meta_keywords" value="{{@$course->meta_keywords}}" placeholder="-" type="text">
                                                </div>
                                            </div>
                                            
                                        </div>
                                       <div class="row">

                                            <div class="col-xl-12">
                                                <div class="primary_input mb-25">
                                                    <label class="primary_input_label" for="">Meta description</label>
                                                     <textarea id="my-textarea" class="primary_input_field" name="meta_description" style="height: 200px" rows="3">{!!@$course->meta_description!!}</textarea>
                                                </div>

                                            </div>
                                            
                                       </div>
                                        
                                        <div class="col-lg-12 text-center pt_15">
                                            <div class="d-flex justify-content-center">
                                                <button class="primary-btn semi_large2  fix-gr-bg" id="save_button_parent"  type="submit"><i class="ti-check"></i> Update Course</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>