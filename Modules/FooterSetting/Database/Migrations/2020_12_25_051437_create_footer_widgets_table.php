<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class CreateFooterWidgetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('footer_widgets', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('name');
            $table->string('slug');
            $table->text('description');

            $table->string('category');
            $table->string('page');
            $table->integer('page_id');
            $table->string('section');
            $table->boolean('is_static')->default(1);
            $table->boolean('status')->default(1);
            $table->timestamps();
        });


        $data = [
            [
                'user_id' => 1,
                'category' => 1,
                'page' => '',
                'page_id' => '',
                'section' => 1,
                'status' => 1,
                'is_static' => 1,

                'name' => 'Unlock Your Potential',
                'slug' => Str::slug('Unlock Your Potential'),
                'description' => 'Do you ever feel like you have the potential to do great things with your life, but just aren’t sure how to start? We know that feeling very well, as it’s taken me years of reflection to figure out what activities makes you feel happy and fulfilled. We hope we will give you a gentle shove in the right direction',
            ], [
                'user_id' => 1,
                'category' => 1,
                'page' => '',
                'page_id' => '',
                'section' => 1,
                'status' => 1,
                'is_static' => 1,

                'name' => 'Privacy policy and cookie policy',
                'slug' => Str::slug('Privacy policy and cookie policy'),
                'description' => "A Privacy Policy is a legal document that explains the different ways you collect and manage a user's personal data. It is one of the most important legal documents for your website.A Cookies Policy is a policy explaining detailed and specific information about the cookies your website uses. The policy should explain the use of cookies and how a user can limit or prevent the placement of cookies on a device.Your website might need a separate Cookies Policy and Privacy Policy depending on your target audience and the privacy laws affecting your business.",
            ], [
                'user_id' => 1,
                'category' => 1,
                'page' => '',
                'page_id' => '',
                'section' => 1,
                'status' => 1,
                'is_static' => 1,

                'name' => 'Sitemap',
                'slug' => Str::slug('Sitemap'),
                'description' => "Sitemap, or XML sitemap, is a list of different pages on a website. XML is short for “extensible markup language,” which is a way to display information on a site. I've consulted with so many website owners who are intimidated by this concept because sitemaps are considered a technical component of SEO",
            ], [
                'name' => 'Featured courses',
                'slug' =>Str::slug('Featured courses'),
                'user_id' => 1,
                'category' => 1,
                'page' => '',
                'page_id' => '',
                'section' => 1,
                'status' => 1,
                'is_static' => 1,
                'description' => "Sitemap, or XML sitemap, is a list of different pages on a website. XML is short for “extensible markup language,” which is a way to display information on a site. I've consulted with so many website owners who are intimidated by this concept because sitemaps are considered a technical component of SEO",

            ], [
                'name' => 'Join Us',
                'slug' => Str::slug('Join Us'),
                'user_id' => 1,
                'category' => 1,
                'page' => '',
                'page_id' => '',
                'section' => 1,
                'status' => 1,
                'is_static' => 1,
                'description' => "Our goal is to learn the next generation of creative professionals for a future in any industry. We offer course in most demanded industries. Whether begin to your journey on our courses website or choose the flexibility of video learning our courses are designed to help you along your path.",
            ],


            [
                'name' => 'InfixEdu for Business',
                'slug' => Str::slug('InfixEdu for Business'),
                'user_id' => 1,
                'category' => 2,
                'page' => '',
                'page_id' => '',
                'section' => 2,
                'status' => 1,
                'is_static' => 1,
                'description' => "'Think about your specific user experience, and the journey the user will go through as they navigate your site,' added Gabriel Shaoolian, CEO of website design and digital marketing agency Blue Fountain Media. 'Whatever the fundamental goal of your website is or whatever the focus may be, users should be easily able to achieve it, and the goal itself should be reinforced as users navigate throughout your site.'If you don't plan to accept payments through your website, you won't have as much work to do in setting it up. If you are a retailer or service provider and want to offer customers the option to pay online, you'll need to use an external service to receive your payments, which we'll discuss later in this article. ",
            ],
            [
                'name' => 'Teach on InfixEdu',
                'slug' => Str::slug('Teach on InfixEdu'),
                'user_id' => 1,
                'category' => 2,
                'page' => '',
                'page_id' => '',
                'section' => 2,
                'status' => 1,
                'is_static' => 1,
                'description' => "From lesson plans and reproducibles to mini-books and differentiated collections, Scholastic Teachables has everything you need to go with your lessons in every subject. It’s the best of Scholastic classroom resources right at your fingertips.Best for Finding and Leveling Books: Book Wizard Use Scholastic’s Book Wizard to level your classroom library, discover resources for the books you teach, and find books at just the right level for students with Guided Reading, Lexile® Measure, and DRA levels for children's books. Best for Craft Projects: Crayola For Educators FInd hundreds of standards-based lesson plans, crafts, and activities for every grade level, plus art techniques for beginners to practiced artists. Here you will find what you need to supplement learning in every subject.",
            ], [
                'name' => 'Get the app',
                'slug' => Str::slug('Get the app'),
                'user_id' => 1,
                'category' => 2,
                'page' => '',
                'page_id' => '',
                'section' => 2,
                'status' => 1,
                'is_static' => 1,
                'description' => 'Our goal is to learn the next generation of creative professionals for a future in any industry. We offer course in most demanded industries. Whether begin to your journey on our courses website or choose the flexibility of video learning our courses are designed to help you along your path',
            ], [
                'name' => 'About us',
                'slug' => 'about-us',
                'category' => 2,
                'page' => 'about',
                'user_id' => 1,
                'page_id' => '',
                'section' => 2,
                'status' => 1,
                'is_static' => 0,
                'description' => 'Our goal is to learn the next generation of creative professionals for a future in any industry. We offer course in most demanded industries. Whether begin to your journey on our courses website or choose the flexibility of video learning our courses are designed to help you along your path',
            ], [
                'name' => 'Contact us',
                'slug' => 'contact-us',
                'category' => 2,
                'page' => 'contact',
                'section' => 2,
                'page_id' => '',
                'status' => 1,
                'user_id' => 1,
                'is_static' => 0,
                'description' => 'Our goal is to learn the next generation of creative professionals for a future in any industry. We offer course in most demanded industries. Whether begin to your journey on our courses website or choose the flexibility of video learning our courses are designed to help you along your path',
            ],


            [
                'name' => 'Careers',
                'slug' => Str::slug('Careers'),
                'category' => 3,
                'page' => 'contact',
                'section' => 3,
                'page_id' => '',
                'status' => 1,
                'user_id' => 1,
                'is_static' => 1,
                'description' => 'Go Beyond Traditional Careers and Build Your Dreams with Us

At LMS, we believe in working hard, failing fast and learning every second. We are constantly exploring ways of making our customers life simple and empowered.

We are a family of youthful and diverse risk-takers and challengers who are solving global problems through transformation and disruption.

We are what our teacher and students are- the number one in the industry; and the greatest way we reward them is through the opportunity to Go Beyond in developing a nation through education',
            ], [
                'name' => 'Blog',
                'slug' => 'blogs',
                'category' => 3,
                'page' => 'blogs',
                'section' => 3,
                'page_id' => '',
                'status' => 1,
                'user_id' => 1,
                'is_static' => 0,
                'description' => "Plus, you'll also learn Justin's go-to camera settings, must-have gear, and recommendations on a budget. By the end, you'll know how to master your settings, shoot in manual mode for total control. Transfers of Personal Data: The Services are hosted and operated in the United States (“U.S.”) through Skillshare and its service providers, and if you do not reside in the U.S., laws in the U.S. may differ from the laws where you reside. By using the Services, you acknowledge that any Personal Data about you.",
            ], [
                'name' => 'Help and Support',
                'slug' => Str::slug('Help and Support'),
                'category' => 3,
                'page' => '',
                'section' => 3,
                'page_id' => '',
                'status' => 1,
                'user_id' => 1,
                'is_static' => 1,
                'description' => "Plus, you'll also learn Justin's go-to camera settings, must-have gear, and recommendations on a budget. By the end, you'll know how to master your settings, shoot in manual mode for total control. Transfers of Personal Data: The Services are hosted and operated in the United States (“U.S.”) through Skillshare and its service providers, and if you do not reside in the U.S., laws in the U.S. may differ from the laws where you reside. By using the Services, you acknowledge that any Personal Data about you.",
            ],  [
                'name' => 'Terms',
                'slug' => 'terms',
                'category' => 3,
                'page' => '',
                'section' => 3,
                'page_id' => '',
                'status' => 1,
                'user_id' => 1,
                'is_static' => 1,
                'description' => "A terminologist intends to hone categorical organization by improving the accuracy and content of its terminology. Technical industries and standardization institutes compile their own glossaries. This provides the consistency needed in the various areas—fields and branches, movements and specialties—to work with core terminology to then offer material for the discipline's traditional and doctrinal literature.

Terminology is also then key in boundary-crossing problems, such as in language translation and social epistemology. Terminology helps to build bridges and to extend one area into another. Translators research the terminology of the languages they translate. Terminology is taught alongside translation in universities and translation schools. Large translation departments and translation bureaus have a Terminology section",
            ],
        ];

        DB::table('footer_widgets')->insert($data);


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('footer_widgets');
    }
}
