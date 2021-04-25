<?php

namespace Modules\Certificate\Http\Controllers;

use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Intervention\Image\Facades\Image;
use Modules\Certificate\Entities\Certificate;
use Modules\Setting\Model\DateFormat;


class CertificateController extends Controller
{
    public function index()
    {
        $certificates = Certificate::latest()->get();
        return view('certificate::certificate.index', compact('certificates'));
    }

    public function fonts()
    {
        $font_list = [
            'nunito' => 'Nunito',
            'vazir' => 'Vazir',
        ];

        return $font_list;
    }

    public function create()
    {
        $font_list = $this->fonts();
        $formats = DateFormat::all();
        return view('certificate::certificate.index', compact('font_list', 'formats'));
    }

    public function store(Request $request)
    {
        if (demoCheck()) {
            return redirect()->back();
        }
        $request->validate([
            'image' => 'required'

        ]);
        try {
            $certificate = Certificate::create($request->except(['image', 'signature', '_token', 'certificate_id', 'makeURL', 'uploadURL', 'bgImageInput', 'sigImageInput']));


            if ($request->file('signature') != "") {
                $name = md5($request->title . time()) . '.' . 'png';
                $img = Image::make($request->signature);
                $upload_path = 'public/uploads/certificate/';
                $img->save($upload_path . $name);
                $certificate->signature = 'public/uploads/certificate/' . $name;
            }
            if ($request->file('image') != "") {
                $name = md5($request->title . rand(0, 1000)) . '.' . 'png';
                $img = Image::make($request->image);
                $upload_path = 'public/uploads/certificate/';
                $img->save($upload_path . $name);
                $certificate->image = 'public/uploads/certificate/' . $name;
            }

            $certificate->save();
            Toastr::success(trans('certificate.Certificate Saved Successfully'), trans('common.Success'));
            return redirect()->route('certificate.index');
        } catch (\Exception $e) {
            Toastr::error(trans('common.Something Went Wrong'), 'Error');
            return back();
        }
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('systemsetting::show');
    }

    public function edit($id)
    {
        $font_list = $this->fonts();
        $certificate = Certificate::findOrFail($id);
        $formats = DateFormat::all();
        return view('certificate::certificate.index', compact('certificate', 'font_list', 'formats'));
    }

    public function update(Request $request, $id)
    {
        if (demoCheck()) {
            return redirect()->back();
        }

        try {
            $certificate = Certificate::findOrFail($id);
            $input = $request->except(['image', 'signature', '_token', 'certificate_id', 'makeURL', 'uploadURL', 'bgImageInput', 'sigImageInput']);
            $certificate->fill($input);

            if ($request->file('image') != "") {
                $name = md5($request->title . time()) . '.' . 'png';
                $img = Image::make($request->image);
                $upload_path = 'public/uploads/certificate/';
                $img->save($upload_path . $name);
                $certificate->image = 'public/uploads/certificate/' . $name;
            }
            if ($request->file('signature') != "") {
                $name = md5($request->title . time()) . '.' . 'png';
                $img = Image::make($request->signature);
                $upload_path = 'public/uploads/certificate/';
                $img->save($upload_path . $name);
                $certificate->signature = 'public/uploads/certificate/' . $name;
            }
            $certificate->save();
            Toastr::success(trans('certificate.Certificate Update Successfully'), trans('common.Success'));
            return redirect()->route('certificate.index');
        } catch (\Exception $e) {
            dd($e);
            Toastr::success(trans('common.Something Went Wrong'), trans('common.Success'));
            return back();
        }
    }

    public function destroy($id)
    {
        if (demoCheck()) {
            return redirect()->back();
        }
        try {
            Certificate::destroy($id);
            Toastr::success(trans('certificate.Certificate Deleted Successfully'), trans('common.Success'));
            return back();
        } catch (\Exception $e) {
            Toastr::success(trans('common.Something Went Wrong'), trans('common.Success'));
            return back();
        }
    }

    public function courseCertificate($id)
    {
        try {
            $certificate = Certificate::find($id);
            $certificate->for_course = 1;
            $certificate->for_quiz = 0;
            $certificate->save();
            Toastr::success(trans('certificate.Certificate for Course Selected Successfully'), trans('common.Success'));
            return back();
        } catch (\Exception $e) {
            Toastr::success(trans('common.Something Went Wrong'), trans('common.Success'));
            return back();
        }
    }

    public function quizCertificate($id)
    {
        try {
            $certificate = Certificate::find($id);
            $certificate->for_quiz = 1;
            $certificate->for_course = 0;
            $certificate->save();
            Toastr::success(trans('certificate.Certificate for Quiz Selected Successfully'), trans('common.Success'));
            return back();
        } catch (\Exception $e) {
            Toastr::success(trans('common.Something Went Wrong'), trans('common.Success'));
            return back();
        }
    }

    public function getVariants(Request $request)
    {
        $font_family = $request->font;
        $url = "https://www.googleapis.com/webfonts/v1/webfonts?key=AIzaSyAdtrr9rVkPASrFJCfmeOmV3ZLtpsk-BaU";
        $result = json_decode(file_get_contents($url));
        $output = '';
        foreach ($result->items as $font) {
            if ($font->family == $font_family) {
                $variants = $font->variants;
                $files = [];
                foreach ($font->files as $key => $file)
                    $files[] = $file;
                foreach ($variants as $key => $variant) {
                    if (is_numeric($variant) || $variant == 'regular')
                        $output .= '<option value="' . $variant . '">' . $variant . '</option>';
                }
            }
        }
        return $output;
    }

    public function view($id, Request $request)
    {
        try {
            $certificate = $this->makeCertificate($id, $request)['image'] ?? '';
            return $certificate->response('png');
        } catch (\Exception $e) {
            Toastr::success(trans('common.Something Went Wrong'), trans('common.Success'));
            return back();
        }


//todo save certificate and view it as image
    }

    public function makeCertificate($id, Request $request)
    {

        if (!empty($id)) {
            $certificate = Certificate::find($id);
        }

        if (!empty($request->bgImage)) {
            $bg_image = $request->bgImage;
        } elseif ($id) {
            $bg_image = $certificate->image ?? '';
        } else {
            $bg_image = '';
        }


        if (!empty($request->sigImageInput)) {
            $sig_image = $request->sigImageInput;
        } elseif ($id) {
            $sig_image = $certificate->signature ?? '';
        } else {
            $sig_image = '';
        }
        if (!empty($request->bgImage) || $id) {
            $width = getimagesize($bg_image)[0] ?? 1300;
            $height = getimagesize($bg_image)[1] ?? 910;
        } else {
            $width = 1300;
            $height = 910;
        };


        $img = Image::canvas($width, $height);
        if (!empty($bg_image)) {
            $img->insert(asset($bg_image));
        }


        if (!empty($request->title)) {
            $title = $request->title;
        } elseif (!empty($id)) {
            $title = $certificate->title ?? '';
        } else {
            $title = 'Certificate Title';
        }

        if (!empty($request->title_position_x)) {
            $title_position_x = $request->title_position_x;
        } elseif (!empty($id)) {
            $title_position_x = $certificate->title_position_x ?? '';
        } else {
            $title_position_x = 0;
        }


        if (!empty($request->title_position_y)) {
            $title_position_y = $request->title_position_y;
        } elseif (!empty($id)) {
            $title_position_y = $certificate->title_position_y ?? '';
        } else {
            $title_position_y = 0;
        }


        if (!empty($request->title_font_color)) {
            $title_font_color = $request->title_font_color;
        } elseif (!empty($id)) {
            $title_font_color = $certificate->title_font_color ?? '#000';
        } else {
            $title_font_color = '#000';
        }


        if (!empty($request->title_font_size)) {
            $title_font_size = $request->title_font_size;
        } elseif (!empty($id)) {
            $title_font_size = $certificate->title_font_size ?? 30;
        } else {
            $title_font_size = 30;
        }

        if (!empty($request->title_font_family)) {
            $title_font_family = $request->title_font_family;
        } elseif (!empty($id)) {
            $title_font_family = $certificate->title_font_family ?? 'nunito';
        } else {
            $title_font_family = 'nunito';
        }


//body part style start form here
        if (!empty($request->body)) {
            $body = $request->body;
        } elseif (!empty($id)) {
            if (isset($request->user) & isset($request->course)) {
                $body = $certificate->body;
                $body = str_replace("[name]", $request->user->name, $body);
                $body = str_replace("[course]", $request->course->title, $body);
            } else {
                $body = $certificate->body ?? '';
            }

        } else {

            $body = '';
        }

        if (!empty($request->body_position_x)) {
            $body_position_x = $request->body_position_x;
        } elseif (!empty($id)) {
            $body_position_x = $certificate->body_position_x ?? 0;
        } else {
            $body_position_x = 0;
        }

        if (!empty($request->body_position_y)) {
            $body_position_y = $request->body_position_y;
        } elseif (!empty($id)) {
            $body_position_y = $certificate->body_position_y ?? 0;
        } else {
            $body_position_y = 0;
        }

        if (!empty($request->body_font_family)) {
            $body_font_family = $request->body_font_family;
        } elseif (!empty($id)) {
            $body_font_family = $certificate->body_font_family ?? 'nunito';
        } else {
            $body_font_family = 'nunito';
        }


        if (!empty($request->body_max_len)) {
            $body_max_len = $request->body_max_len;
        } elseif (!empty($id)) {
            $body_max_len = $certificate->body_max_len ?? 80;
        } else {
            $body_max_len = 80;
        }

        if (!empty($request->body_font_size)) {
            $body_font_size = $request->body_font_size;
        } elseif (!empty($id)) {
            $body_font_size = $certificate->body_font_size ?? 25;
        } else {
            $body_font_size = 25;
        };

        if (!empty($request->body_font_color)) {
            $body_font_color = $request->body_font_color;
        } elseif (!empty($id)) {
            $body_font_color = $certificate->body_font_color ?? '#000';
        } else {
            $body_font_color = '#000';
        }


        $profile = $request->profile ?? 1;

        if (!empty($request->profile_x)) {
            $profile_x = $request->profile_x;
        } elseif (!empty($id)) {
            $profile_x = $certificate->profile_x ?? 0;
        } else {
            $profile_x = 0;
        }


        if (!empty($request->profile_y)) {
            $profile_y = $request->profile_y;
        } elseif (!empty($id)) {
            $profile_y = $certificate->profile_y ?? 0;
        } else {
            $profile_y = 0;
        }


        if (!empty($request->profile_height)) {
            $profile_height = $request->profile_height;
        } elseif (!empty($id)) {
            $profile_height = $certificate->profile_height ?? 50;
        } else {
            $profile_height = 50;
        }


        if (!empty($request->profile_weight)) {
            $profile_weight = $request->profile_weight;
        } elseif (!empty($id)) {
            $profile_weight = $certificate->profile_weight ?? 50;
        } else {
            $profile_weight = 50;
        }

        $studentName = 'Student Name';
        if (isset($request->name)) {
            $name = $request->name;
        } elseif (isset($certificate->name)) {
            if (isset($request->user) & isset($request->course)) {
                $studentName = $request->user->name;
            }
            $name = $certificate->name;
        } else {
            $name = 1;
        }


        if (!empty($request->name_position_x)) {
            $name_position_x = $request->name_position_x;
        } elseif (!empty($id)) {
            $name_position_x = $certificate->name_position_x ?? 0;
        } else {
            $name_position_x = 0;
        }

        if (!empty($request->name_position_y)) {
            $name_position_y = $request->name_position_y;
        } elseif (!empty($id)) {
            $name_position_y = $certificate->name_position_y ?? 0;
        } else {
            $name_position_y = 0;
        }

        if (!empty($request->name_font_family)) {
            $name_font_family = $request->name_font_family;
        } elseif (!empty($id)) {
            $name_font_family = $certificate->name_font_family ?? 'nunito';
        } else {
            $name_font_family = 'nunito';
        }

        if (!empty($request->name_font_size)) {
            $name_font_size = $request->name_font_size;
        } elseif (!empty($id)) {
            $name_font_size = $certificate->name_font_size ?? 50;
        } else {
            $name_font_size = 50;
        }

        if (!empty($request->name_font_color)) {
            $name_font_color = $request->name_font_color;
        } elseif (!empty($id)) {
            $name_font_color = $certificate->name_font_color ?? '#000';
        } else {
            $name_font_color = '#000';
        }


        if (isset($request->date)) {
            $date = $request->date;
        } elseif (isset($certificate->date)) {
            $date = $certificate->date;
        } else {
            $date = 0;
        }

        if (!empty($request->date_position_x)) {
            $date_position_x = $request->date_position_x;
        } elseif (!empty($id)) {
            $date_position_x = $certificate->date_position_x ?? 0;
        } else {
            $date_position_x = 0;
        }

        if (!empty($request->date_position_y)) {
            $date_position_y = $request->date_position_y;
        } elseif (!empty($id)) {
            $date_position_y = $certificate->date_position_y ?? 0;
        } else {
            $date_position_y = 0;
        }

        if (!empty($request->date_font_family)) {
            $date_font_family = $request->date_font_family;
        } elseif (!empty($id)) {
            $date_font_family = $certificate->date_font_family ?? 'nunito';
        } else {
            $date_font_family = 'nunito';
        }

        if (!empty($request->date_font_size)) {
            $date_font_size = $request->date_font_size;
        } elseif (!empty($id)) {
            $date_font_size = $certificate->date_font_size ?? 30;
        } else {
            $date_font_size = 30;
        }

        if (!empty($request->date_font_color)) {
            $date_font_color = $request->date_font_color;
        } elseif (!empty($id)) {
            $date_font_color = $certificate->date_font_color ?? '#000';
        } else {
            $date_font_color = '#000';
        }


        if (!empty($request->date_format)) {
            $date_format = $request->date_format;
        } elseif (!empty($id)) {
            $date_format = $certificate->date_format ?? 1;
        } else {
            $date_format = 1;
        }


        if (!empty($request->signature_position_x)) {
            $signature_position_x = $request->signature_position_x;
        } elseif (!empty($id)) {
            $signature_position_x = $certificate->signature_position_x ?? 0;
        } else {
            $signature_position_x = 0;
        }


        if (!empty($request->signature_position_y)) {
            $signature_position_y = $request->signature_position_y;
        } elseif (!empty($id)) {
            $signature_position_y = $certificate->signature_position_y ?? 0;
        } else {
            $signature_position_y = 0;
        }


        if (!empty($request->signature_height)) {
            $signature_height = $request->signature_height;
        } elseif (!empty($id)) {
            $signature_height = $certificate->signature_height ?? 100;
        } else {
            $signature_height = 70;
        }

        if (!empty($request->signature_weight)) {
            $signature_weight = $request->signature_weight;
        } elseif (!empty($id)) {
            $signature_weight = $certificate->signature_weight ?? 100;
        } else {
            $signature_weight = 100;
        }

        if (!empty($request->signature_text)) {
            $signature_text = $request->signature_text;
        } elseif (!empty($id)) {
            $signature_text = $certificate->signature_text ?? '';
        } else {
            $signature_text = '';
        }
        if (!empty($request->signature_text_position_x)) {
            $signature_text_position_x = $request->signature_text_position_x;
        } elseif (!empty($id)) {
            $signature_text_position_x = $certificate->signature_text_position_x ?? 0;
        } else {
            $signature_text_position_x = 0;
        }

        if (!empty($request->signature_text_position_y)) {
            $signature_text_position_y = $request->signature_text_position_y;
        } elseif (!empty($id)) {
            $signature_text_position_y = $certificate->signature_text_position_y ?? 0;
        } else {
            $signature_text_position_y = 0;
        }

        if (!empty($request->signature_text_font_family)) {
            $signature_text_font_family = $request->signature_text_font_family;
        } elseif (!empty($id)) {
            $signature_text_font_family = $certificate->signature_text_font_family ?? 'nunito';
        } else {
            $signature_text_font_family = 'nunito';
        }


        if (!empty($request->signature_text_font_size)) {
            $signature_text_font_size = $request->signature_text_font_size;
        } elseif (!empty($id)) {
            $signature_text_font_size = $certificate->signature_text_font_size ?? 30;
        } else {
            $signature_text_font_size = 30;
        }


        if (!empty($request->signature_text_font_color)) {
            $signature_text_font_color = $request->signature_text_font_color;
        } elseif (!empty($id)) {
            $signature_text_font_color = $certificate->signature_text_font_color ?? '#000';
        } else {
            $signature_text_font_color = '#000';
        }


        //title part
        $img->text($title, ($width / 2) + $title_position_x, $title_position_y + 150, function ($font) use ($title_font_family, $title_font_size, $title_font_color) {
            $font->size($title_font_size);
            $font->file(public_path('fonts/' . $title_font_family . '.ttf'));
            $font->color($title_font_color);
            $font->align('center');
            $font->valign('top');
        });

        if ($name == 1) {
            $img->text($studentName, ($width / 2) + $name_position_x, $name_position_y + 200, function ($font) use ($name_font_family, $name_font_size, $name_font_color) {
                $font->size($name_font_size);
                $font->file(public_path('fonts/' . $name_font_family . '.ttf'));
                $font->color($name_font_color);
                $font->align('center');
                $font->valign('top');
            });
        }


// body part
        $center_x = ($width / 2) + $body_position_x;
        $center_y = ($height / 2) + $body_position_y;
        $max_len = $body_max_len;
        $font_height = 20;
        $lines = explode("\n", wordwrap($body, $max_len));
        $y = $center_y - ((count($lines) - 1) * $font_height);
        foreach ($lines as $line) {
            $img->text($line, $center_x, $y, function ($font) use ($body_font_size, $body_font_family, $body_font_color) {
                $font->file(public_path('fonts/' . $body_font_family . '.ttf'));
                $font->size($body_font_size);
                $font->color($body_font_color);
                $font->align('center');
                $font->valign('center');
            });
            $y += $font_height * 2;
        }


        //Profile  part
        if ($profile == 1) {
            if (isset($request->user) & isset($request->course)) {
                $imagePath = getStudentImage($request->user->image);

            } else {
                $imagePath = asset('public/uploads/staff/user.png');
            }

            $profileImageRow = Image::make($imagePath);
            $profileImageRow->resize($profile_weight, $profile_height);
            $profileImg = Image::canvas($profile_weight, $profile_height);
            $profileImg->opacity(0);
            $profileImg->insert($profileImageRow, 'center', 0, 0);
            $img->insert($profileImg, 'top-left', $profile_x + 200, $profile_y + 250);
        }

        if ($date == 1) {
            $dateFormat = DateFormat::find($date_format);
            $img->text('Date: ' . date($dateFormat->format ?? 'd/m/Y'), (200 + ($width / 2)) + $date_position_x, (($height / 2) - 200) + $date_position_y, function ($font) use ($date_font_color, $date_font_size, $date_font_family) {
                $font->size($date_font_size);
                $font->file(public_path('fonts/' . $date_font_family . '.ttf'));
                $font->color($date_font_color);
                $font->align('right');
                $font->valign('right');

            });

        }

        if (!empty($sig_image)) {
            $sigImageRow = Image::make(asset($sig_image));
            $sigImageRow->resize($signature_weight, $signature_height);
            $sigImg = Image::canvas($signature_weight, $signature_height);
            $sigImg->opacity(0);
            $sigImg->insert($sigImageRow, 'center', 0, 0);
            $img->insert($sigImg, 'bottom', $signature_position_x + 300, $signature_position_y + 200);
        }


        $img->text('------------------------', ($width / 2) + $signature_text_position_x, ($height - (round($height / 5))) + $signature_text_position_y, function ($font) use ($signature_text_font_size, $signature_text_font_color, $signature_text_font_family) {
            $font->size($signature_text_font_size);
            $font->file(public_path('fonts/' . $signature_text_font_family . '.ttf'));
            $font->color($signature_text_font_color);
            $font->align('center');
            $font->valign('bottom');

        });


        $img->text($signature_text, ($width / 2) + $signature_text_position_x, ($height - (round($height / 7) + $signature_text_position_y)), function ($font) use ($signature_text_font_size, $signature_text_font_color, $signature_text_font_family) {
            $font->size($signature_text_font_size);
            $font->file(public_path('fonts/' . $signature_text_font_family . '.ttf'));
            $font->color($signature_text_font_color);
            $font->align('center');
            $font->valign('bottom');

        });
        $data['image'] = $img;
        $data['height'] = $height;
        $data['width'] = $width;

        return $data;
    }

    public function download($id, Request $request)
    {
        try {
            $certificate = $this->makeCertificate($id, $request)['image'] ?? '';

            $certificate->encode('jpg');
            $headers = [
                'Content-Type' => 'image/jpeg',
                'Content-Disposition' => 'attachment; filename=' . 'demo.jpg',
            ];
            return response()->stream(function () use ($certificate) {
                echo $certificate;
            }, 200, $headers);
        } catch (\Exception $e) {
            Toastr::success(trans('common.Something Went Wrong'), trans('common.Success'));
            return back();
        }

    }

    public function preview(Request $request)
    {
        $id = $request->id;
        $certificate = $this->makeCertificate($id, $request);
        $data['image'] = $certificate['image']->encode('data-url');
        $data['height'] = $certificate['height'];
        $data['width'] = $certificate['width'];
        return json_encode($data);
    }

    public function upload(Request $request)
    {
        if ($_FILES["file"]["name"] != '') {
            $test = explode('.', $_FILES["file"]["name"]);
            $ext = end($test);
            $name = md5(rand(100, 999999999999) . time()) . '.' . $ext;
            $location = public_path('uploads/certificate') . '/' . $name;
            $public_path = 'public/uploads/certificate/' . $name;
            $status = move_uploaded_file($_FILES["file"]["tmp_name"], $location);
            if ($status) {
                $data['type'] = 'Success';
                $data['location'] = $public_path;
            } else {
                $data['type'] = 'Error';
                $data['location'] = '';
            }


        } else {
            $data['type'] = 'Error';
            $data['location'] = '';
        }
        return json_encode($data);
    }
}
