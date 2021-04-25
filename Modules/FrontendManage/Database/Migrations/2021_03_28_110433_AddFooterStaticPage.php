<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Modules\FooterSetting\Entities\FooterWidget;
use Modules\FrontendManage\Entities\FrontPage;

class AddFooterStaticPage extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $unlock = FrontPage::where('slug', 'unlock-your-potential')->first();
        if (!$unlock) {
            DB::table('front_pages')->insert([
                'name' => 'Unlock Your Potential',
                'title' => 'Unlock Your Potential',
                'sub_title' => 'Unlock Your Potential',
                'details' => 'Do you ever feel like you have the potential to do great things with your life, but just aren’t sure how to start? We know that feeling very well, as it’s taken me years of reflection to figure out what activities makes you feel happy and fulfilled. We hope we will give you a gentle shove in the right direction',
                'slug' => 'unlock-your-potential',
                'status' => 1,
                'is_static' => 0,
            ]);
            $unlock = FrontPage::where('slug', 'unlock-your-potential')->first();
        }

        $check1 = FooterWidget::where('slug', 'unlock-your-potential')->first();

        if ($check1) {
            $check1->slug = $unlock->slug;
            $check1->page_id = $unlock->id;
            $check1->is_static = $unlock->is_static;
            $check1->save();

        }


        $privacy = FrontPage::where('slug', 'privacy-policy-and-cookie-policy')->first();
        if (!$privacy) {
            DB::table('front_pages')->insert([
                'name' => 'Privacy policy and cookie policy',
                'title' => 'Privacy policy and cookie policy',
                'sub_title' => 'Privacy policy and cookie policy',
                'details' => "A Privacy Policy is a legal document that explains the different ways you collect and manage a user's personal data. It is one of the most important legal documents for your website.A Cookies Policy is a policy explaining detailed and specific information about the cookies your website uses. The policy should explain the use of cookies and how a user can limit or prevent the placement of cookies on a device.Your website might need a separate Cookies Policy and Privacy Policy depending on your target audience and the privacy laws affecting your business.",
                'slug' => 'privacy-policy-and-cookie-policy',
                'status' => 1,
                'is_static' => 0,
            ]);
            $privacy = FrontPage::where('slug', 'privacy-policy-and-cookie-policy')->first();
        }


        $check2 = FooterWidget::where('slug', 'privacy-policy-and-cookie-policy')->first();
        if ($check2) {
            $check2->slug = $privacy->slug;
            $check2->page_id = $privacy->id;
            $check2->is_static = $privacy->is_static;
            $check2->save();
        }


        $Sitemap = FrontPage::where('slug', 'sitemap')->first();
        if (!$Sitemap) {
            DB::table('front_pages')->insert([
                'name' => 'Sitemap',
                'title' => 'Sitemap',
                'sub_title' => 'Sitemap',
                'details' => "Sitemap, or XML sitemap, is a list of different pages on a website. XML is short for “extensible markup language,” which is a way to display information on a site. I've consulted with so many website owners who are intimidated by this concept because sitemaps are considered a technical component of SEO",
                'slug' => 'sitemap',
                'status' => 1,
                'is_static' => 0,
            ]);
            $Sitemap = FrontPage::where('slug', 'sitemap')->first();

        }
        $check3 = FooterWidget::where('slug', 'sitemap')->first();
        if ($check3) {
            $check3->slug = $Sitemap->slug;
            $check3->page_id = $Sitemap->id;
            $check3->is_static = $Sitemap->is_static;
            $check3->save();
        }


        $featured = FrontPage::where('slug', 'featured-courses')->first();
        if (!$featured) {
            DB::table('front_pages')->insert([
                'name' => 'Featured courses',
                'title' => 'Featured courses',
                'sub_title' => 'Featured courses',
                'details' => "Sitemap, or XML sitemap, is a list of different pages on a website. XML is short for “extensible markup language,” which is a way to display information on a site. I've consulted with so many website owners who are intimidated by this concept because sitemaps are considered a technical component of SEO",
                'slug' => 'featured-courses',
                'status' => 1,
                'is_static' => 0,
            ]);
            $featured = FrontPage::where('slug', 'featured-courses')->first();

        }
        $check4 = FooterWidget::where('slug', 'featured-courses')->first();
        if ($check4) {
            $check4->slug = $featured->slug;
            $check4->page_id = $featured->id;
            $check4->is_static = $featured->is_static;
            $check4->save();
        }


        $join = FrontPage::where('slug', 'join-us')->first();
        if (!$join) {
            DB::table('front_pages')->insert([
                'name' => 'Join Us',
                'title' => 'Join Us',
                'sub_title' => 'Join Us',
                'details' => "Our goal is to learn the next generation of creative professionals for a future in any industry. We offer course in most demanded industries. Whether begin to your journey on our courses website or choose the flexibility of video learning our courses are designed to help you along your path.",
                'slug' => 'join-us',
                'status' => 1,
                'is_static' => 0,
            ]);
            $join = FrontPage::where('slug', 'join-us')->first();

        }
        $check5 = FooterWidget::where('slug', 'join-us')->first();
        if ($check5) {
            $check5->slug = $join->slug;
            $check5->page_id = $join->id;
            $check5->is_static = $join->is_static;
            $check5->save();

        }


        $infixedu = FrontPage::where('slug', 'infixedu-for-business')->first();
        if (!$infixedu) {
            DB::table('front_pages')->insert([
                'name' => 'InfixEdu for Business',
                'title' => 'InfixEdu for Business',
                'sub_title' => 'InfixEdu for Business',
                'details' => "'Think about your specific user experience, and the journey the user will go through as they navigate your site,' added Gabriel Shaoolian, CEO of website design and digital marketing agency Blue Fountain Media. 'Whatever the fundamental goal of your website is or whatever the focus may be, users should be easily able to achieve it, and the goal itself should be reinforced as users navigate throughout your site.'If you don't plan to accept payments through your website, you won't have as much work to do in setting it up. If you are a retailer or service provider and want to offer customers the option to pay online, you'll need to use an external service to receive your payments, which we'll discuss later in this article. ",
                'slug' => 'infixedu-for-business',
                'status' => 1,
                'is_static' => 0,
            ]);
            $infixedu = FrontPage::where('slug', 'infixedu-for-business')->first();

        }
        $check6 = FooterWidget::where('slug', 'infixedu-for-business')->first();
        if ($check6) {
            $check6->slug = $infixedu->slug;
            $check6->page_id = $infixedu->id;
            $check6->is_static = $infixedu->is_static;
            $check6->save();
        }


        $teach = FrontPage::where('slug', 'teach-on-infixedu')->first();
        if (!$teach) {
            DB::table('front_pages')->insert([
                'name' => 'Teach on InfixEdu',
                'title' => 'Teach on InfixEdu',
                'sub_title' => 'Teach on InfixEdu',
                'details' => "From lesson plans and reproducibles to mini-books and differentiated collections, Scholastic Teachables has everything you need to go with your lessons in every subject. It’s the best of Scholastic classroom resources right at your fingertips.Best for Finding and Leveling Books: Book Wizard Use Scholastic’s Book Wizard to level your classroom library, discover resources for the books you teach, and find books at just the right level for students with Guided Reading, Lexile® Measure, and DRA levels for children's books. Best for Craft Projects: Crayola For Educators FInd hundreds of standards-based lesson plans, crafts, and activities for every grade level, plus art techniques for beginners to practiced artists. Here you will find what you need to supplement learning in every subject.",
                'slug' => 'teach-on-infixedu',
                'status' => 1,
                'is_static' => 0,
            ]);
            $teach = FrontPage::where('slug', 'teach-on-infixedu')->first();

        }
        $check7 = FooterWidget::where('slug', 'teach-on-infixedu')->first();
        if ($check7) {
            $check7->slug = $teach->slug;
            $check7->page_id = $teach->id;
            $check7->is_static = $teach->is_static;
            $check7->save();
        }


        $app = FrontPage::where('slug', 'get-the-app')->first();
        if (!$app) {
            DB::table('front_pages')->insert([
                'name' => 'Get the app',
                'title' => 'Get the app',
                'sub_title' => 'Get the app',
                'details' => "Our goal is to learn the next generation of creative professionals for a future in any industry. We offer course in most demanded industries. Whether begin to your journey on our courses website or choose the flexibility of video learning our courses are designed to help you along your path",
                'slug' => 'get-the-app',
                'status' => 1,
                'is_static' => 0,
            ]);
            $app = FrontPage::where('slug', 'get-the-app')->first();

        }
        $check8 = FooterWidget::where('slug', 'get-the-app')->first();
        if ($check8) {
            $check8->slug = $app->slug;
            $check8->page_id = $app->id;
            $check8->is_static = $app->is_static;
            $check8->save();
        }


        $help = FrontPage::where('slug', 'help-and-support')->first();
        if (!$help) {
            DB::table('front_pages')->insert([
                'name' => 'Help and Support',
                'title' => 'Help and Support',
                'sub_title' => 'Help and Support',
                'details' => "Plus, you'll also learn Justin's go-to camera settings, must-have gear, and recommendations on a budget. By the end, you'll know how to master your settings, shoot in manual mode for total control. Transfers of Personal Data: The Services are hosted and operated in the United States (“U.S.”) through Skillshare and its service providers, and if you do not reside in the U.S., laws in the U.S. may differ from the laws where you reside. By using the Services, you acknowledge that any Personal Data about you.",
                'slug' => 'help-and-support',
                'status' => 1,
                'is_static' => 0,
            ]);
            $help = FrontPage::where('slug', 'help-and-support')->first();

        }

        $check9 = FooterWidget::where('slug', 'help-and-support')->first();
        if ($check9) {
            $check9->slug = $help->slug;
            $check9->page_id = $help->id;
            $check9->is_static = $help->is_static;
            $check9->save();
        }


        $terms = FrontPage::where('slug', 'terms')->first();
        if (!$terms) {
            DB::table('front_pages')->insert([
                'name' => 'Terms',
                'title' => 'Terms',
                'sub_title' => 'Terms',
                'details' => "A terminologist intends to hone categorical organization by improving the accuracy and content of its terminology. Technical industries and standardization institutes compile their own glossaries. This provides the consistency needed in the various areas—fields and branches, movements and specialties—to work with core terminology to then offer material for the discipline's traditional and doctrinal literature.

Terminology is also then key in boundary-crossing problems, such as in language translation and social epistemology. Terminology helps to build bridges and to extend one area into another. Translators research the terminology of the languages they translate. Terminology is taught alongside translation in universities and translation schools. Large translation departments and translation bureaus have a Terminology section",
                'slug' => 'terms',
                'status' => 1,
                'is_static' => 0,
            ]);
            $terms = FrontPage::where('slug', 'terms')->first();

        }
        $check10 = FooterWidget::where('slug', 'terms')->first();
        if ($check10) {
            $check10->slug = $terms->slug;
            $check10->page_id = $terms->id;
            $check10->is_static = $terms->is_static;
            $check10->save();
        }


        $careers = FrontPage::where('slug', 'careers')->first();
        if (!$careers) {
            $careers = DB::table('front_pages')->insert([
                'name' => 'careers',
                'title' => 'Careers',
                'sub_title' => 'careers',
                'details' => "Go Beyond Traditional Careers and Build Your Dreams with Us

At LMS, we believe in working hard, failing fast and learning every second. We are constantly exploring ways of making our customers life simple and empowered.

We are a family of youthful and diverse risk-takers and challengers who are solving global problems through transformation and disruption.

We are what our teacher and students are- the number one in the industry; and the greatest way we reward them is through the opportunity to Go Beyond in developing a nation through education",
                'slug' => 'careers',
                'status' => 1,
                'is_static' => 0,
            ]);
            $careers = FrontPage::where('slug', 'careers')->first();

        }

        $check11 = FooterWidget::where('slug', 'careers')->first();
        if ($check11) {
            $check11->slug = $careers->slug;
            $check11->page_id = $careers->id;
            $check11->is_static = $careers->is_static;
            $check11->save();
        }


        $about = FrontPage::where('slug', '/about-us')->first();

        $check12 = FooterWidget::where('slug', 'about-us')->first();
        if ($check12) {
            $check12->slug = $about->slug;
            $check12->page_id = $about->id;
            $check12->is_static = $about->is_static;
            $check12->save();
        }


        $contact = FrontPage::where('slug', '/contact-us')->first();
        if (empty($contact)) {
            $contact = FrontPage::where('slug', 'contact-us')->first();
            if ($contact) {
                $contact->slug = '/contact-us';
                $contact->save();
            }
        }

        $check13 = FooterWidget::where('slug', 'contact-us')->first();
        if ($check13) {
            $check13->slug = $contact->slug;
            $check13->page_id = $contact->id;
            $check13->is_static = $contact->is_static;
            $check13->save();
        }


        $blogs = FrontPage::where('slug', '/blogs')->first();

        $check14 = FooterWidget::where('slug', 'blogs')->first();
        if ($check14) {
            $check14->slug = $blogs->slug;
            $check14->page_id = $blogs->id;
            $check14->is_static = $blogs->is_static;
            $check14->save();
        }


        $courses = FrontPage::where('slug', '/courses')->first();
        if (empty($courses)) {
            $courses = FrontPage::where('slug', 'courses')->first();
            if ($courses) {
                $courses->slug = '/courses';
                $courses->save();
            }
        }

        $classes = FrontPage::where('slug', '/classes')->first();
        if (empty($classes)) {
            $classes = FrontPage::where('slug', 'classes')->first();
            if ($classes) {
                $classes->slug = '/classes';
                $classes->save();
            }
        }
        $quizzes = FrontPage::where('slug', '/quizzes')->first();
        if (empty($quizzes)) {
            $quizzes = FrontPage::where('slug', 'quizzes')->first();
            if ($quizzes) {
                $quizzes->slug = '/quizzes';
                $quizzes->save();
            }
        }
        $instructors = FrontPage::where('slug', '/instructors')->first();
        if (empty($instructors)) {
            $instructors = FrontPage::where('slug', 'instructors')->first();
            if ($instructors) {
                $instructors->slug = '/instructors';
                $instructors->save();
            }
        }


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
