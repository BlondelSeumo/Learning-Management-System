<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreatePermissionsTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permissions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('module_id')->nullable();
            $table->integer('parent_id')->nullable();
            $table->string('name')->nullable();
            $table->string('route')->nullable();
            $table->tinyInteger('status')->default(1);
            $table->integer('created_by')->default(1)->unsigned();
            $table->integer('updated_by')->default(1)->unsigned();
            $table->integer('type')->nullable()->comment('1 for main menu, 2 for sub menu , 3 action');
            $table->timestamps();
        });

        $sql = [

            // // Main Module
            ['id' => 1, 'module_id' => 1, 'parent_id' => null, 'name' => 'Dashboard', 'route' => 'dashboard', 'type' => 1],
            ['id' => 2, 'module_id' => 2, 'parent_id' => null, 'name' => 'Students', 'route' => 'students', 'type' => 1],
            ['id' => 4, 'module_id' => 4, 'parent_id' => null, 'name' => 'Instructors', 'route' => 'instructors', 'type' => 1],
            ['id' => 5, 'module_id' => 5, 'parent_id' => null, 'name' => 'Courses', 'route' => 'courses', 'type' => 1],
            ['id' => 6, 'module_id' => 6, 'parent_id' => null, 'name' => 'Coupons', 'route' => 'coupons', 'type' => 1],
            ['id' => 7, 'module_id' => 7, 'parent_id' => null, 'name' => 'Quiz', 'route' => 'quiz', 'type' => 1],
            ['id' => 8, 'module_id' => 8, 'parent_id' => null, 'name' => 'Communications', 'route' => 'communications', 'type' => 1],
            ['id' => 9, 'module_id' => 9, 'parent_id' => null, 'name' => 'Payments', 'route' => 'payments', 'type' => 1],
            ['id' => 12, 'module_id' => 12, 'parent_id' => null, 'name' => 'Settings', 'route' => 'settings', 'type' => 1],

            ['id' => 16, 'module_id' => 16, 'parent_id' => null, 'name' => 'Frontend CMS', 'route' => 'frontend_CMS', 'type' => 1],
            ['id' => 17, 'module_id' => 17, 'parent_id' => null, 'name' => 'Image Gallery', 'route' => 'image_gallery', 'type' => 1],
            ['id' => 18, 'module_id' => 10, 'parent_id' => null, 'name' => 'Report', 'route' => 'reports', 'type' => 1],
            ['id' => 19, 'module_id' => 11, 'parent_id' => null, 'name' => 'Certificate', 'route' => 'certificate.index', 'type' => 1],

            ['id' => 134, 'module_id' => 10, 'parent_id' => 18, 'name' => 'Admin Revenue', 'route' => 'admin.reveuneList', 'type' => 2],
            ['id' => 135, 'module_id' => 10, 'parent_id' => 18, 'name' => 'Instructor Revenue', 'route' => 'admin.reveuneListInstructor', 'type' => 2],
            //Certificate
            ['id' => 247, 'module_id' => 11, 'parent_id' => 19, 'name' => 'Certificate List', 'route' => 'certificate.index', 'type' => 2],
            ['id' => 248, 'module_id' => 11, 'parent_id' => 247, 'name' => 'Add', 'route' => 'certificate.create', 'type' => 3],
            ['id' => 249, 'module_id' => 11, 'parent_id' => 247, 'name' => 'Edit', 'route' => 'certificate.edit', 'type' => 3],
            ['id' => 250, 'module_id' => 11, 'parent_id' => 247, 'name' => 'Delete', 'route' => 'certificate.destroy', 'type' => 3],

            // 1. Dashboard
            ['id' => 273, 'module_id' => 1, 'parent_id' => 1, 'name' => 'Number of Instructors', 'route' => 'dashboard.number_of_instructor', 'type' => 2],
            ['id' => 274, 'module_id' => 1, 'parent_id' => 1, 'name' => 'Number of Enrolled', 'route' => 'dashboard.number_of_enrolled', 'type' => 2],
            ['id' => 275, 'module_id' => 1, 'parent_id' => 1, 'name' => 'Number of Subject', 'route' => 'dashboard.number_of_subject', 'type' => 2],
            ['id' => 276, 'module_id' => 1, 'parent_id' => 1, 'name' => 'Total Revenue', 'route' => 'dashboard.total_revenue', 'type' => 2],
            ['id' => 277, 'module_id' => 1, 'parent_id' => 1, 'name' => 'Total Enrolled Today', 'route' => 'dashboard.total_enrolled_today', 'type' => 2],
            ['id' => 278, 'module_id' => 1, 'parent_id' => 1, 'name' => 'Total Enrolled This Month', 'route' => 'dashboard.total_enrolled_this_month', 'type' => 2],
            ['id' => 279, 'module_id' => 1, 'parent_id' => 1, 'name' => 'Total Amount from Enrolled', 'route' => 'dashboard.total_amount_from_enrolled', 'type' => 2],
            ['id' => 285, 'module_id' => 1, 'parent_id' => 1, 'name' => 'Number of Students', 'route' => 'dashboard.number_of_student', 'type' => 2],

            ['id' => 280, 'module_id' => 1, 'parent_id' => 1, 'name' => 'Monthly Income', 'route' => 'dashboard.monthly_income', 'type' => 2],
            ['id' => 281, 'module_id' => 1, 'parent_id' => 1, 'name' => 'Payment Statistic', 'route' => 'dashboard.payment_statistic', 'type' => 2],
            ['id' => 282, 'module_id' => 1, 'parent_id' => 1, 'name' => 'Recent Enrolls', 'route' => 'dashboard.recent_enrolls', 'type' => 2],
            ['id' => 283, 'module_id' => 1, 'parent_id' => 1, 'name' => 'Overview of Courses', 'route' => 'dashboard.overview_of_courses', 'type' => 2],
            ['id' => 284, 'module_id' => 1, 'parent_id' => 1, 'name' => 'Daily Wise Enroll', 'route' => 'dashboard.daily_wise_enroll', 'type' => 2],


            //2. Student
            ['id' => 31, 'module_id' => 2, 'parent_id' => 2, 'name' => 'Student List', 'route' => 'student.student_list', 'type' => 2],
            ['id' => 32, 'module_id' => 2, 'parent_id' => 31, 'name' => 'Add', 'route' => 'student.store', 'type' => 3],
            ['id' => 33, 'module_id' => 2, 'parent_id' => 31, 'name' => 'Edit', 'route' => 'student.edit', 'type' => 3],
            ['id' => 34, 'module_id' => 2, 'parent_id' => 31, 'name' => 'Delete', 'route' => 'student.delete', 'type' => 3],
            ['id' => 35, 'module_id' => 2, 'parent_id' => 31, 'name' => 'Enable & Disable', 'route' => 'student.enable_disable', 'type' => 3],
            ['id' => 36, 'module_id' => 2, 'parent_id' => 31, 'name' => 'Change Status', 'route' => 'student.change_status', 'type' => 3],
            ['id' => 37, 'module_id' => 2, 'parent_id' => 2, 'name' => 'Enrolled Student', 'route' => 'admin.enrollLogs', 'type' => 2],
            ['id' => 38, 'module_id' => 2, 'parent_id' => 37, 'name' => 'Change Status', 'route' => 'enrollLogs.change_status', 'type' => 3],
            //4. Instructors
            ['id' => 44, 'module_id' => 4, 'parent_id' => 4, 'name' => 'All Instructor', 'route' => 'allInstructor', 'type' => 2],
            ['id' => 45, 'module_id' => 4, 'parent_id' => 44, 'name' => 'Add', 'route' => 'instructor.store', 'type' => 3],
            ['id' => 46, 'module_id' => 4, 'parent_id' => 44, 'name' => 'Edit', 'route' => 'instructor.edit', 'type' => 3],
            ['id' => 47, 'module_id' => 4, 'parent_id' => 44, 'name' => 'Delete', 'route' => 'instructor.delete', 'type' => 3],
            ['id' => 48, 'module_id' => 4, 'parent_id' => 44, 'name' => 'Change Status', 'route' => 'instructor.change_status', 'type' => 3],
            ['id' => 49, 'module_id' => 4, 'parent_id' => 4, 'name' => 'Payout List', 'route' => 'admin.instructor.payout', 'type' => 2],

            //5.Courses
            ['id' => 50, 'module_id' => 5, 'parent_id' => 5, 'name' => 'Category List', 'route' => 'course.category', 'type' => 2],
            ['id' => 51, 'module_id' => 5, 'parent_id' => 50, 'name' => 'Add', 'route' => 'course.category.store', 'type' => 3],
            ['id' => 52, 'module_id' => 5, 'parent_id' => 50, 'name' => 'Edit', 'route' => 'course.category.edit', 'type' => 3],
            ['id' => 53, 'module_id' => 5, 'parent_id' => 50, 'name' => 'Delete', 'route' => 'course.category.delete', 'type' => 3],
            ['id' => 54, 'module_id' => 5, 'parent_id' => 50, 'name' => 'Change Status', 'route' => 'course.category.status_update', 'type' => 3],

            ['id' => 55, 'module_id' => 5, 'parent_id' => 5, 'name' => 'Sub Category List', 'route' => 'course.subcategory', 'type' => 2],
            ['id' => 56, 'module_id' => 5, 'parent_id' => 55, 'name' => 'Add', 'route' => 'course.subcategory.store', 'type' => 3],
            ['id' => 57, 'module_id' => 5, 'parent_id' => 55, 'name' => 'Edit', 'route' => 'course.subcategory.edit', 'type' => 3],
            ['id' => 58, 'module_id' => 5, 'parent_id' => 55, 'name' => 'Delete', 'route' => 'course.subcategory.delete', 'type' => 3],
            ['id' => 59, 'module_id' => 5, 'parent_id' => 55, 'name' => 'Change Status', 'route' => 'course.subcategory.status_update', 'type' => 3],

            ['id' => 60, 'module_id' => 5, 'parent_id' => 5, 'name' => 'All Cources', 'route' => 'getAllCourse', 'type' => 2],
            ['id' => 61, 'module_id' => 5, 'parent_id' => 60, 'name' => 'Add', 'route' => 'course.store', 'type' => 3],
            ['id' => 62, 'module_id' => 5, 'parent_id' => 60, 'name' => 'Edit', 'route' => 'course.edit', 'type' => 3],
            ['id' => 63, 'module_id' => 5, 'parent_id' => 60, 'name' => 'Details', 'route' => 'course.details', 'type' => 3],
            ['id' => 64, 'module_id' => 5, 'parent_id' => 60, 'name' => 'View', 'route' => 'course.view', 'type' => 3],
            ['id' => 67, 'module_id' => 5, 'parent_id' => 60, 'name' => 'Change Status', 'route' => 'course.status_update', 'type' => 3],

            ['id' => 68, 'module_id' => 5, 'parent_id' => 5, 'name' => 'Chapter', 'route' => 'chapterPage', 'type' => 2],
            ['id' => 69, 'module_id' => 5, 'parent_id' => 68, 'name' => 'Add', 'route' => 'saveChapterPage', 'type' => 3],
            ['id' => 70, 'module_id' => 5, 'parent_id' => 68, 'name' => 'Edit', 'route' => 'chapterEdit', 'type' => 3],
            ['id' => 71, 'module_id' => 5, 'parent_id' => 68, 'name' => 'Delete', 'route' => 'chapterDelete', 'type' => 3],

            ['id' => 72, 'module_id' => 5, 'parent_id' => 5, 'name' => 'Active Course', 'route' => 'getActiveCourse', 'type' => 2],
            ['id' => 74, 'module_id' => 5, 'parent_id' => 5, 'name' => 'Pending Course', 'route' => 'getPendingCourse', 'type' => 2],

            //6.Coupons
            ['id' => 76, 'module_id' => 6, 'parent_id' => 6, 'name' => 'Coupons List', 'route' => 'coupons.manage', 'type' => 2],
            ['id' => 77, 'module_id' => 6, 'parent_id' => 76, 'name' => 'Add', 'route' => 'coupons.store', 'type' => 3],
            ['id' => 78, 'module_id' => 6, 'parent_id' => 76, 'name' => 'Edit', 'route' => 'coupons.edit', 'type' => 3],
            ['id' => 79, 'module_id' => 6, 'parent_id' => 76, 'name' => 'Delete', 'route' => 'coupons.delete', 'type' => 3],
            ['id' => 80, 'module_id' => 6, 'parent_id' => 76, 'name' => 'Change Status', 'route' => 'coupons.status_update', 'type' => 3],

            ['id' => 81, 'module_id' => 6, 'parent_id' => 6, 'name' => 'Common Coupons', 'route' => 'coupons.common', 'type' => 2],
            ['id' => 82, 'module_id' => 6, 'parent_id' => 81, 'name' => 'Add', 'route' => 'coupons.common.store', 'type' => 3],
            ['id' => 83, 'module_id' => 6, 'parent_id' => 81, 'name' => 'Edit', 'route' => 'coupons.common.edit', 'type' => 3],
            ['id' => 84, 'module_id' => 6, 'parent_id' => 81, 'name' => 'Delete', 'route' => 'coupons.common.delete', 'type' => 3],
            ['id' => 85, 'module_id' => 6, 'parent_id' => 81, 'name' => 'Change Status', 'route' => 'coupons.common.status_update', 'type' => 3],

            ['id' => 86, 'module_id' => 6, 'parent_id' => 6, 'name' => 'Single Coupons', 'route' => 'coupons.single', 'type' => 2],
            ['id' => 87, 'module_id' => 6, 'parent_id' => 86, 'name' => 'Add', 'route' => 'coupons.single.store', 'type' => 3],
            ['id' => 88, 'module_id' => 6, 'parent_id' => 86, 'name' => 'Edit', 'route' => 'coupons.single.edit', 'type' => 3],
            ['id' => 89, 'module_id' => 6, 'parent_id' => 86, 'name' => 'Delete', 'route' => 'coupons.single.delete', 'type' => 3],
            ['id' => 90, 'module_id' => 6, 'parent_id' => 86, 'name' => 'Change Status', 'route' => 'coupons.single.status_update', 'type' => 3],

            ['id' => 91, 'module_id' => 6, 'parent_id' => 6, 'name' => 'Personalized Coupons', 'route' => 'coupons.personalized', 'type' => 2],
            ['id' => 92, 'module_id' => 6, 'parent_id' => 91, 'name' => 'Add', 'route' => 'coupons.personalized.store', 'type' => 3],
            ['id' => 93, 'module_id' => 6, 'parent_id' => 91, 'name' => 'Edit', 'route' => 'coupons.personalized.edit', 'type' => 3],
            ['id' => 94, 'module_id' => 6, 'parent_id' => 91, 'name' => 'Delete', 'route' => 'coupons.personalized.delete', 'type' => 3],
            ['id' => 95, 'module_id' => 6, 'parent_id' => 91, 'name' => 'Change Status', 'route' => 'coupons.personalized.status_update', 'type' => 3],

            ['id' => 96, 'module_id' => 6, 'parent_id' => 6, 'name' => 'Invite By Code', 'route' => 'coupons.invite_code', 'type' => 2],
            ['id' => 97, 'module_id' => 6, 'parent_id' => 96, 'name' => 'Edit', 'route' => 'coupons.invite_code.edit', 'type' => 3],
            ['id' => 98, 'module_id' => 6, 'parent_id' => 96, 'name' => 'Delete', 'route' => 'coupons.invite_code.delete', 'type' => 3],
            ['id' => 99, 'module_id' => 6, 'parent_id' => 96, 'name' => 'Change Status', 'route' => 'coupons.invite_code.status_update', 'type' => 3],

            ['id' => 100, 'module_id' => 6, 'parent_id' => 6, 'name' => 'Invite Settings', 'route' => 'coupons.inviteSettings', 'type' => 2],
            ['id' => 101, 'module_id' => 6, 'parent_id' => 100, 'name' => 'Add', 'route' => 'coupons.inviteSettings.store', 'type' => 3],
            ['id' => 102, 'module_id' => 6, 'parent_id' => 100, 'name' => 'Edit', 'route' => 'coupons.inviteSettings.edit', 'type' => 3],
            ['id' => 103, 'module_id' => 6, 'parent_id' => 100, 'name' => 'Delete', 'route' => 'coupons.inviteSettings.delete', 'type' => 3],
            ['id' => 104, 'module_id' => 6, 'parent_id' => 100, 'name' => 'Change Status', 'route' => 'coupons.inviteSettings.status_update', 'type' => 3],
            //7.Quiz
            ['id' => 105, 'module_id' => 7, 'parent_id' => 7, 'name' => 'Question Group', 'route' => 'question-group', 'type' => 2],
            ['id' => 106, 'module_id' => 7, 'parent_id' => 105, 'name' => 'Add', 'route' => 'question-group.store', 'type' => 3],
            ['id' => 107, 'module_id' => 7, 'parent_id' => 105, 'name' => 'Edit', 'route' => 'question-group.edit', 'type' => 3],
            ['id' => 108, 'module_id' => 7, 'parent_id' => 105, 'name' => 'Delete', 'route' => 'question-group.delete', 'type' => 3],

            ['id' => 109, 'module_id' => 7, 'parent_id' => 7, 'name' => 'Question Bank', 'route' => 'question-bank', 'type' => 2],
            ['id' => 110, 'module_id' => 7, 'parent_id' => 109, 'name' => 'Add', 'route' => 'question-bank.store', 'type' => 3],
            ['id' => 111, 'module_id' => 7, 'parent_id' => 109, 'name' => 'Edit', 'route' => 'question-bank.edit', 'type' => 3],
            ['id' => 112, 'module_id' => 7, 'parent_id' => 109, 'name' => 'Delete', 'route' => 'question-bank.delete', 'type' => 3],

            ['id' => 113, 'module_id' => 7, 'parent_id' => 7, 'name' => 'Set Quiz', 'route' => 'online-quiz', 'type' => 2],
            ['id' => 114, 'module_id' => 7, 'parent_id' => 113, 'name' => 'Add', 'route' => 'set-quiz.store', 'type' => 3],
            ['id' => 115, 'module_id' => 7, 'parent_id' => 113, 'name' => 'Edit', 'route' => 'set-quiz.edit', 'type' => 3],
            ['id' => 116, 'module_id' => 7, 'parent_id' => 113, 'name' => 'Delete', 'route' => 'set-quiz.delete', 'type' => 3],
            ['id' => 117, 'module_id' => 7, 'parent_id' => 113, 'name' => 'Set Question', 'route' => 'set-quiz.set-question', 'type' => 3],
            ['id' => 118, 'module_id' => 7, 'parent_id' => 113, 'name' => 'Manage Question', 'route' => 'set-quiz.manage-question', 'type' => 3],
            ['id' => 119, 'module_id' => 7, 'parent_id' => 113, 'name' => 'Publish Now', 'route' => 'set-quiz.publish-now', 'type' => 3],
            ['id' => 120, 'module_id' => 7, 'parent_id' => 113, 'name' => 'Mark Register', 'route' => 'set-quiz.mark-register', 'type' => 3],

            ['id' => 121, 'module_id' => 7, 'parent_id' => 7, 'name' => 'Quiz Setup', 'route' => 'quizSetup', 'type' => 2],
            ['id' => 122, 'module_id' => 7, 'parent_id' => 121, 'name' => 'Add', 'route' => 'quiz-setup.store', 'type' => 3],

            ['id' => 123, 'module_id' => 7, 'parent_id' => 7, 'name' => 'Quiz Report', 'route' => 'quizResult', 'type' => 2],
            //8.Communication
            ['id' => 124, 'module_id' => 8, 'parent_id' => 8, 'name' => 'Private Message', 'route' => 'communication.PrivateMessage', 'type' => 2],
            ['id' => 125, 'module_id' => 8, 'parent_id' => 124, 'name' => 'Send', 'route' => 'communication.send', 'type' => 3],

//            ['id' => 126, 'module_id' => 8, 'parent_id' => 8, 'name' => 'Question & Answer', 'route' => 'communication.QuestionAnswer', 'type' => 2],

            //9.Payment
            ['id' => 127, 'module_id' => 9, 'parent_id' => 9, 'name' => 'Payment Received Online', 'route' => 'onlineLog', 'type' => 2],

            ['id' => 128, 'module_id' => 9, 'parent_id' => 9, 'name' => 'Offline Payment', 'route' => 'offlinePayment', 'type' => 2],
            ['id' => 129, 'module_id' => 9, 'parent_id' => 128, 'name' => 'Add', 'route' => 'offlinePayment.add', 'type' => 3],
            ['id' => 130, 'module_id' => 9, 'parent_id' => 128, 'name' => 'Fund History', 'route' => 'offlinePayment.fund-history', 'type' => 3],
            ['id' => 286, 'module_id' => 9, 'parent_id' => 9, 'name' => 'Bank Payment', 'route' => 'bankPayment.index', 'type' => 2],

            //10.Report
            ['id' => 136, 'module_id' => 6, 'parent_id' => 135, 'name' => 'Change Status', 'route' => 'report.status_update', 'type' => 3],
            //12.Settings
            ['id' => 141, 'module_id' => 12, 'parent_id' => 12, 'name' => 'Activation', 'route' => 'setting.activation', 'type' => 2],
            ['id' => 272, 'module_id' => 12, 'parent_id' => 12, 'name' => 'Api Settings', 'route' => 'api.setting', 'type' => 2],
            ['id' => 287, 'module_id' => 12, 'parent_id' => 12, 'name' => 'Module Manager', 'route' => 'modulemanager.index', 'type' => 2],
            ['id' => 288, 'module_id' => 12, 'parent_id' => 12, 'name' => 'Aws S3 Setting', 'route' => 'AwsS3Setting', 'type' => 2],
            ['id' => 289, 'module_id' => 12, 'parent_id' => 12, 'name' => 'Appearance', 'route' => 'appearance.themes.index', 'type' => 2],


            ['id' => 142, 'module_id' => 12, 'parent_id' => 141, 'name' => 'Change Activation Status', 'route' => 'settings.ChangeActivationStatus', 'type' => 3],


            ['id' => 150, 'module_id' => 12, 'parent_id' => 12, 'name' => 'General Setting', 'route' => 'setting.general_settings', 'type' => 2],
            ['id' => 151, 'module_id' => 12, 'parent_id' => 150, 'name' => 'Update', 'route' => 'settings.general_setting_update', 'type' => 3],


            ['id' => 152, 'module_id' => 12, 'parent_id' => 12, 'name' => 'Commission', 'route' => 'setting.setCommission', 'type' => 2],
            ['id' => 153, 'module_id' => 12, 'parent_id' => 152, 'name' => 'Flat Commission Update', 'route' => 'setting.setCourseFee_update', 'type' => 3],

//            ['id' => 154, 'module_id' => 12, 'parent_id' => 12, 'name' => 'Instructor Commission', 'route' => 'setting.instructorCommission', 'type' => 2],
            ['id' => 155, 'module_id' => 12, 'parent_id' => 152, 'name' => 'Instructor Commission Edit', 'route' => 'setting.instructorCommission_edit', 'type' => 3],
            ['id' => 156, 'module_id' => 12, 'parent_id' => 152, 'name' => 'Instructor Commission Update', 'route' => 'setting.instructorCommission_update', 'type' => 3],

//            ['id' => 157, 'module_id' => 12, 'parent_id' => 12, 'name' => 'Course Commission', 'route' => 'setting.courseCommissionView', 'type' => 2],
            ['id' => 158, 'module_id' => 12, 'parent_id' => 152, 'name' => 'Course Commission Edit', 'route' => 'setting.courseCommission_edit', 'type' => 3],
            ['id' => 159, 'module_id' => 12, 'parent_id' => 152, 'name' => 'Course Commission Update', 'route' => 'setting.courseCommission_update', 'type' => 3],

            ['id' => 160, 'module_id' => 12, 'parent_id' => 12, 'name' => 'Email Configuration', 'route' => 'setting.email_setup', 'type' => 2],
            ['id' => 161, 'module_id' => 12, 'parent_id' => 160, 'name' => 'Send Test Mail', 'route' => 'setting.send_test_mail', 'type' => 3],
            ['id' => 162, 'module_id' => 12, 'parent_id' => 160, 'name' => 'Update', 'route' => 'setting.email_credentials_update', 'type' => 3],

            ['id' => 165, 'module_id' => 12, 'parent_id' => 12, 'name' => 'Payment Method Setting', 'route' => 'paymentmethodsetting.payment_method_setting', 'type' => 2],
            ['id' => 166, 'module_id' => 12, 'parent_id' => 165, 'name' => 'Update', 'route' => 'paymentmethodsetting.payment_method_setting_update', 'type' => 3],

            ['id' => 167, 'module_id' => 12, 'parent_id' => 12, 'name' => 'SEO Setting', 'route' => 'setting.seo_setting', 'type' => 2],
            ['id' => 168, 'module_id' => 12, 'parent_id' => 167, 'name' => 'Update', 'route' => 'setting.seo_setting_update', 'type' => 3],

            ['id' => 171, 'module_id' => 12, 'parent_id' => 12, 'name' => 'Instructor Role', 'route' => 'permission.roles.index', 'type' => 2],
//            ['id' => 172, 'module_id' => 12, 'parent_id' => 171, 'name' => 'Add', 'route' => 'role_add', 'type' => 3],
//            ['id' => 173, 'module_id' => 12, 'parent_id' => 171, 'name' => 'Edit', 'route' => 'role_edit', 'type' => 3],
//            ['id' => 174, 'module_id' => 12, 'parent_id' => 171, 'name' => 'Delete', 'route' => 'role_delete', 'type' => 3],
            ['id' => 175, 'module_id' => 12, 'parent_id' => 171, 'name' => 'Assign Permission', 'route' => 'permission.permissions.store', 'type' => 3],

            ['id' => 176, 'module_id' => 12, 'parent_id' => 12, 'name' => 'Footer Email Configuration', 'route' => 'footerEmailConfig', 'type' => 2],

            ['id' => 178, 'module_id' => 12, 'parent_id' => 176, 'name' => 'Update', 'route' => 'footerTemplateUpdate', 'type' => 3],

            ['id' => 179, 'module_id' => 12, 'parent_id' => 12, 'name' => 'Email Template', 'route' => 'EmailTemp', 'type' => 2],
//            ['id' => 180, 'module_id' => 12, 'parent_id' => 179, 'name' => 'View', 'route' => 'EmailTemp', 'type' => 3],
            ['id' => 181, 'module_id' => 12, 'parent_id' => 179, 'name' => 'Update', 'route' => 'updateEmailTemp', 'type' => 3],

            ['id' => 182, 'module_id' => 12, 'parent_id' => 12, 'name' => 'Language', 'route' => 'languages.index', 'type' => 2],
            ['id' => 183, 'module_id' => 12, 'parent_id' => 182, 'name' => 'Add', 'route' => 'languages.store', 'type' => 3],
            ['id' => 184, 'module_id' => 12, 'parent_id' => 182, 'name' => 'Edit', 'route' => 'languages.edit', 'type' => 3],
            ['id' => 185, 'module_id' => 12, 'parent_id' => 182, 'name' => 'Delete', 'route' => 'languages.destroy', 'type' => 3],
            ['id' => 186, 'module_id' => 12, 'parent_id' => 182, 'name' => 'Translate View', 'route' => 'languages.translate_view', 'type' => 3],
            ['id' => 187, 'module_id' => 12, 'parent_id' => 182, 'name' => 'RTL Status', 'route' => 'languages.update_rtl_status', 'type' => 3],
            ['id' => 188, 'module_id' => 12, 'parent_id' => 182, 'name' => 'Active Status', 'route' => 'languages.update_active_status', 'type' => 3],
            ['id' => 189, 'module_id' => 12, 'parent_id' => 182, 'name' => 'Key Value Store', 'route' => 'languages.key_value_store', 'type' => 3],
            ['id' => 190, 'module_id' => 12, 'parent_id' => 182, 'name' => 'Set Language', 'route' => 'languages.change', 'type' => 3],
            ['id' => 191, 'module_id' => 12, 'parent_id' => 182, 'name' => 'Get Translate File', 'route' => 'languages.get_translate_file', 'type' => 3],

            ['id' => 192, 'module_id' => 12, 'parent_id' => 12, 'name' => 'Currency', 'route' => 'currencies.index', 'type' => 2],
            ['id' => 193, 'module_id' => 12, 'parent_id' => 192, 'name' => 'Add', 'route' => 'currency.store', 'type' => 3],
            ['id' => 194, 'module_id' => 12, 'parent_id' => 192, 'name' => 'Edit', 'route' => 'currencies.edit_modal', 'type' => 3],
            ['id' => 195, 'module_id' => 12, 'parent_id' => 192, 'name' => 'Delete', 'route' => 'currencies.destroy', 'type' => 3],

            //16.Front Setting
            ['id' => 251, 'module_id' => 16, 'parent_id' => 16, 'name' => 'Home Content', 'route' => 'frontend.homeContent', 'type' => 2],


            ['id' => 256, 'module_id' => 16, 'parent_id' => 16, 'name' => 'Privacy Policy', 'route' => 'frontend.privacy_policy', 'type' => 2],

            ['id' => 257, 'module_id' => 16, 'parent_id' => 16, 'name' => 'Testimonial', 'route' => 'frontend.testimonials', 'type' => 2],
            ['id' => 258, 'module_id' => 16, 'parent_id' => 257, 'name' => 'Add', 'route' => 'frontend.testimonials_store', 'type' => 3],
            ['id' => 259, 'module_id' => 16, 'parent_id' => 257, 'name' => 'Edit', 'route' => 'frontend.testimonials_edit', 'type' => 3],
            ['id' => 260, 'module_id' => 16, 'parent_id' => 257, 'name' => 'Delete', 'route' => 'frontend.testimonials_delete', 'type' => 3],

            ['id' => 261, 'module_id' => 16, 'parent_id' => 16, 'name' => 'About', 'route' => 'frontend.AboutPage', 'type' => 2],


            ['id' => 262, 'module_id' => 16, 'parent_id' => 16, 'name' => 'Pages', 'route' => 'frontend.page.index', 'type' => 2],
            ['id' => 263, 'module_id' => 16, 'parent_id' => 262, 'name' => 'Add', 'route' => 'frontend.page.create', 'type' => 3],
            ['id' => 264, 'module_id' => 16, 'parent_id' => 262, 'name' => 'Edit', 'route' => 'frontend.page.edit', 'type' => 3],

            ['id' => 265, 'module_id' => 16, 'parent_id' => 16, 'name' => 'Become Instructor', 'route' => 'frontend.becomeInstructor', 'type' => 2],
            ['id' => 266, 'module_id' => 16, 'parent_id' => 265, 'name' => 'Edit', 'route' => 'frontend.becomeInstructorUpdate', 'type' => 3],

            ['id' => 267, 'module_id' => 16, 'parent_id' => 16, 'name' => 'Sponsor', 'route' => 'frontend.sponsors.index', 'type' => 2],
            ['id' => 268, 'module_id' => 16, 'parent_id' => 267, 'name' => 'Add', 'route' => 'sponsor.store', 'type' => 3],
            ['id' => 269, 'module_id' => 16, 'parent_id' => 267, 'name' => 'Edit', 'route' => 'frontend.sponsors.edit', 'type' => 3],
            ['id' => 270, 'module_id' => 16, 'parent_id' => 267, 'name' => 'destroy', 'route' => 'frontend.sponsors.destroy', 'type' => 3],
            ['id' => 271, 'module_id' => 16, 'parent_id' => 16, 'name' => 'Subscriber', 'route' => 'frontend.subscriber', 'type' => 2],

            ['id' => 199, 'module_id' => 16, 'parent_id' => 16, 'name' => 'Section Setting', 'route' => 'frontend.sectionSetting', 'type' => 2],
            ['id' => 200, 'module_id' => 16, 'parent_id' => 199, 'name' => 'Add', 'route' => 'frontend.sectionSetting.store', 'type' => 3],
            ['id' => 201, 'module_id' => 16, 'parent_id' => 199, 'name' => 'Edit', 'route' => 'frontend.sectionSetting.edit', 'type' => 3],
            ['id' => 202, 'module_id' => 16, 'parent_id' => 199, 'name' => 'Delete', 'route' => 'frontend.sectionSetting.delete', 'type' => 3],
            ['id' => 203, 'module_id' => 16, 'parent_id' => 199, 'name' => 'Change Status', 'route' => 'frontend.sectionSetting.status_update', 'type' => 3],

            ['id' => 204, 'module_id' => 16, 'parent_id' => 16, 'name' => 'Social Setting', 'route' => 'frontend.socialSetting', 'type' => 2],
            ['id' => 205, 'module_id' => 16, 'parent_id' => 204, 'name' => 'Add', 'route' => 'frontend.socialSetting.store', 'type' => 3],
            ['id' => 206, 'module_id' => 16, 'parent_id' => 204, 'name' => 'Edit', 'route' => 'frontend.socialSetting.edit', 'type' => 3],
            ['id' => 207, 'module_id' => 16, 'parent_id' => 204, 'name' => 'Delete', 'route' => 'frontend.socialSetting.delete', 'type' => 3],
            ['id' => 208, 'module_id' => 16, 'parent_id' => 204, 'name' => 'Top Bar', 'route' => 'frontend.socialSetting.topbar_status_update', 'type' => 3],
            ['id' => 209, 'module_id' => 16, 'parent_id' => 204, 'name' => 'Footer', 'route' => 'frontend.socialSetting.footer_status_update', 'type' => 3],
            ['id' => 210, 'module_id' => 16, 'parent_id' => 204, 'name' => 'Change Status', 'route' => 'frontend.socialSetting.status_update', 'type' => 3],
            ['id' => 290, 'module_id' => 16, 'parent_id' => 16, 'name' => 'Footer Setting', 'route' => 'footerSetting.footer.index', 'type' => 2],
            //17.Image Gallery
            ['id' => 211, 'module_id' => 17, 'parent_id' => 17, 'name' => 'Manage Gallery', 'route' => 'imagegallery.list', 'type' => 2],
            ['id' => 212, 'module_id' => 17, 'parent_id' => 211, 'name' => 'Add', 'route' => 'imagegallery.store', 'type' => 3],
            ['id' => 213, 'module_id' => 17, 'parent_id' => 211, 'name' => 'Edit', 'route' => 'imagegallery.edit', 'type' => 3],
            ['id' => 214, 'module_id' => 17, 'parent_id' => 211, 'name' => 'Delete', 'route' => 'imagegallery.delete', 'type' => 3],
            ['id' => 215, 'module_id' => 17, 'parent_id' => 211, 'name' => 'Change Status', 'route' => 'imagegallery.status_update', 'type' => 3],

            //7. Quiz more permission
            ['id' => 216, 'module_id' => 7, 'parent_id' => 113, 'name' => 'Result', 'route' => 'set-quiz.quiz_result', 'type' => 3],
            //12. Setting more permission
            ['id' => 217, 'module_id' => 12, 'parent_id' => 12, 'name' => 'Vimeo Configuration', 'route' => 'vimeosetting.index', 'type' => 2],
            ['id' => 218, 'module_id' => 12, 'parent_id' => 217, 'name' => 'Update', 'route' => 'vimeosetting.update', 'type' => 3],
//zoom module
            ['id' => 219, 'module_id' => 55, 'parent_id' => null, 'name' => 'Zoom', 'route' => 'zoom', 'type' => 1],
            ['id' => 220, 'module_id' => 55, 'parent_id' => 219, 'name' => 'Zoom Class', 'route' => 'zoom.meetings', 'type' => 2],
            ['id' => 221, 'module_id' => 55, 'parent_id' => 219, 'name' => 'Setting', 'route' => 'zoom.settings', 'type' => 2],
            ['id' => 222, 'module_id' => 55, 'parent_id' => 220, 'name' => 'List', 'route' => 'zoom.meetings.index', 'type' => 3],
            ['id' => 223, 'module_id' => 55, 'parent_id' => 220, 'name' => 'Store', 'route' => 'zoom.meetings.store', 'type' => 3],
            ['id' => 224, 'module_id' => 55, 'parent_id' => 220, 'name' => 'edit', 'route' => 'zoom.meetings.edit', 'type' => 3],
            ['id' => 225, 'module_id' => 55, 'parent_id' => 220, 'name' => 'Delete', 'route' => 'zoom.meetings.destroy', 'type' => 3],

//            bbb module
            ['id' => 226, 'module_id' => 56, 'parent_id' => null, 'name' => 'BBB', 'route' => 'bbb', 'type' => 1],
            ['id' => 227, 'module_id' => 56, 'parent_id' => 226, 'name' => 'BBB Class', 'route' => 'bbb.meetings', 'type' => 2],
            ['id' => 228, 'module_id' => 56, 'parent_id' => 226, 'name' => 'Setting', 'route' => 'bbb.settings', 'type' => 2],
            ['id' => 229, 'module_id' => 56, 'parent_id' => 227, 'name' => 'List', 'route' => 'bbb.meetings.index', 'type' => 3],
            ['id' => 230, 'module_id' => 56, 'parent_id' => 227, 'name' => 'Store', 'route' => 'bbb.meetings.store', 'type' => 3],
            ['id' => 231, 'module_id' => 56, 'parent_id' => 227, 'name' => 'edit', 'route' => 'bbb.meetings.edit', 'type' => 3],
            ['id' => 232, 'module_id' => 56, 'parent_id' => 227, 'name' => 'Delete', 'route' => 'bbb.meetings.destroy', 'type' => 3],


//          Virtual Class
            ['id' => 233, 'module_id' => 57, 'parent_id' => null, 'name' => 'Virtual Class', 'route' => 'virtual-class', 'type' => 1],
            ['id' => 234, 'module_id' => 57, 'parent_id' => 233, 'name' => 'Virtual Class List', 'route' => 'virtual-class.index', 'type' => 2],
            ['id' => 235, 'module_id' => 57, 'parent_id' => 233, 'name' => 'Setting', 'route' => 'virtual-class.setting', 'type' => 2],
            ['id' => 236, 'module_id' => 57, 'parent_id' => 234, 'name' => 'List', 'route' => 'virtual-class.index', 'type' => 3],
            ['id' => 237, 'module_id' => 57, 'parent_id' => 234, 'name' => 'Store', 'route' => 'virtual-class.create', 'type' => 3],
            ['id' => 238, 'module_id' => 57, 'parent_id' => 234, 'name' => 'edit', 'route' => 'virtual-class.edit', 'type' => 3],
            ['id' => 239, 'module_id' => 57, 'parent_id' => 234, 'name' => 'Delete', 'route' => 'virtual-class.destroy', 'type' => 3],


//          Blog
            ['id' => 240, 'module_id' => 58, 'parent_id' => null, 'name' => 'Blog', 'route' => 'blog', 'type' => 1],
            ['id' => 241, 'module_id' => 58, 'parent_id' => 240, 'name' => 'Blog List', 'route' => 'blogs.index', 'type' => 2],
            ['id' => 244, 'module_id' => 58, 'parent_id' => 241, 'name' => 'Blog Store', 'route' => 'blog.create', 'type' => 3],
            ['id' => 245, 'module_id' => 58, 'parent_id' => 241, 'name' => 'Blog Edit', 'route' => 'blog.edit', 'type' => 3],
            ['id' => 246, 'module_id' => 58, 'parent_id' => 241, 'name' => 'Blog Delete', 'route' => 'blog.destroy', 'type' => 3],

            //last  293
        ];


        DB::table('permissions')->insert($sql);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('permissions');
    }
}
