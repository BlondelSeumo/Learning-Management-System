<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
class CreateLanguageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('languages', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->string('name');
            $table->string('native');
            $table->tinyInteger('rtl')->default('0');
            $table->tinyInteger('status')->default('1');
            $table->tinyInteger('json_exist')->default('0');
            $table->timestamps();
        });

        DB::statement("INSERT INTO languages (id, code, name, native, rtl, status) VALUES
        (1, 'af', 'Afrikaans', 'Afrikaans', 0, 0),
        (2, 'am', 'Amharic', 'አማርኛ', 0, 0),
        (3, 'ar', 'Arabic', 'العربية', 1, 1),
        (4, 'ay', 'Aymara', 'Aymar', 0, 0),
        (5, 'az', 'Azerbaijani', 'Azərbaycanca / آذربايجان', 0, 0),
        (6, 'be', 'Belarusian', 'Беларуская', 0, 0),
        (7, 'bg', 'Bulgarian', 'Български', 0, 0),
        (8, 'bi', 'Bislama', 'Bislama', 0, 0),
        (9, 'bn', 'Bengali', 'বাংলা', 0, 1),
        (10, 'bs', 'Bosnian', 'Bosanski', 0, 0),
        (11, 'ca', 'Catalan', 'Català', 0, 0),
        (12, 'ch', 'Chamorro', 'Chamoru', 0, 0),
        (13, 'cs', 'Czech', 'Česky', 0, 0),
        (14, 'da', 'Danish', 'Dansk', 0, 0),
        (15, 'de', 'German', 'Deutsch', 0, 0),
        (16, 'dv', 'Divehi', 'ދިވެހިބަސް', 1, 0),
        (17, 'dz', 'Dzongkha', 'ཇོང་ཁ', 0, 0),
        (18, 'el', 'Greek', 'Ελληνικά', 0, 0),
        (19, 'en', 'English', 'English', 0 , 1),
        (20, 'es', 'Spanish', 'Español', 0, 1),
        (21, 'et', 'Estonian', 'Eesti', 0, 0),
        (22, 'eu', 'Basque', 'Euskara', 0, 0),
        (23, 'fa', 'Persian', 'فارسی', 1, 0),
        (24, 'ff', 'Peul', 'Fulfulde', 0, 0),
        (25, 'fi', 'Finnish', 'Suomi', 0, 0),
        (26, 'fj', 'Fijian', 'Na Vosa Vakaviti', 0, 0),
        (27, 'fo', 'Faroese', 'Føroyskt', 0, 0),
        (28, 'fr', 'French', 'Français', 0, 0),
        (29, 'ga', 'Irish', 'Gaeilge', 0, 0),
        (30, 'gl', 'Galician', 'Galego', 0, 0),
        (31, 'gn', 'Guarani', 'Avañe\'ẽ', 0, 0),
        (32, 'gv', 'Manx', 'Gaelg', 0, 0),
        (33, 'he', 'Hebrew', 'עברית', 1, 0),
        (34, 'hi', 'Hindi', 'हिन्दी', 0, 0),
        (35, 'hr', 'Croatian', 'Hrvatski', 0, 0),
        (36, 'ht', 'Haitian', 'Krèyol ayisyen', 0, 0),
        (37, 'hu', 'Hungarian', 'Magyar', 0, 0),
        (38, 'hy', 'Armenian', 'Հայերեն', 0, 0),
        (39, 'indo', 'Indonesian', 'Bahasa Indonesia', 0, 0),
        (40, 'is', 'Icelandic', 'Íslenska', 0, 0),
        (41, 'it', 'Italian', 'Italiano', 0, 0),
        (42, 'ja', 'Japanese', '日本語', 0, 0),
        (43, 'ka', 'Georgian', 'ქართული', 0, 0),
        (44, 'kg', 'Kongo', 'KiKongo', 0, 0),
        (45, 'kk', 'Kazakh', 'Қазақша', 0, 0),
        (46, 'kl', 'Greenlandic', 'Kalaallisut', 0, 0),
        (47, 'km', 'Cambodian', 'ភាសាខ្មែរ', 0, 0),
        (48, 'ko', 'Korean', '한국어', 0, 0),
        (49, 'ku', 'Kurdish', 'Kurdî / كوردی', 1, 0),
        (50, 'ky', 'Kirghiz', 'Kırgızca / Кыргызча', 0, 0),
        (51, 'la', 'Latin', 'Latina', 0, 0),
        (52, 'lb', 'Luxembourgish', 'Lëtzebuergesch', 0, 0),
        (53, 'ln', 'Lingala', 'Lingála', 0, 0),
        (54, 'lo', 'Laotian', 'ລາວ / Pha xa lao', 0, 0),
        (55, 'lt', 'Lithuanian', 'Lietuvių', 0, 0),
        (56, 'lu', '', '', 0, 0),
        (57, 'lv', 'Latvian', 'Latviešu', 0, 0),
        (58, 'mg', 'Malagasy', 'Malagasy', 0, 0),
        (59, 'mh', 'Marshallese', 'Kajin Majel / Ebon', 0, 0),
        (60, 'mi', 'Maori', 'Māori', 0, 0),
        (61, 'mk', 'Macedonian', 'Македонски', 0, 0),
        (62, 'mn', 'Mongolian', 'Монгол', 0, 0),
        (63, 'ms', 'Malay', 'Bahasa Melayu', 0, 0),
        (64, 'mt', 'Maltese', 'bil-Malti', 0, 0),
        (65, 'my', 'Burmese', 'မြန်မာစာ', 0, 0),
        (66, 'na', 'Nauruan', 'Dorerin Naoero', 0, 0),
        (67, 'nb', '', '', 0, 0),
        (68, 'nd', 'North Ndebele', 'Sindebele', 0, 0),
        (69, 'ne', 'Nepali', 'नेपाली', 0, 0),
        (70, 'nl', 'Dutch', 'Nederlands', 0, 0),
        (71, 'nn', 'Norwegian Nynorsk', 'Norsk (nynorsk)', 0, 0),
        (72, 'no', 'Norwegian', 'Norsk (bokmål / riksmål)', 0, 0),
        (73, 'nr', 'South Ndebele', 'isiNdebele', 0, 0),
        (74, 'ny', 'Chichewa', 'Chi-Chewa', 0, 0),
        (75, 'oc', 'Occitan', 'Occitan', 0, 0),
        (76, 'pa', 'Panjabi / Punjabi', 'ਪੰਜਾਬੀ / पंजाबी / پنجابي', 0, 0),
        (77, 'pl', 'Polish', 'Polski', 0, 0),
        (78, 'ps', 'Pashto', 'پښتو', 1, 0),
        (79, 'pt', 'Portuguese', 'Português', 0, 0),
        (80, 'qu', 'Quechua', 'Runa Simi', 0, 0),
        (81, 'rn', 'Kirundi', 'Kirundi', 0, 0),
        (82, 'ro', 'Romanian', 'Română', 0, 0),
        (83, 'ru', 'Russian', 'Русский', 0, 0),
        (84, 'rw', 'Rwandi', 'Kinyarwandi', 0, 0),
        (85, 'sg', 'Sango', 'Sängö', 0, 0),
        (86, 'si', 'Sinhalese', 'සිංහල', 0, 0),
        (87, 'sk', 'Slovak', 'Slovenčina', 0, 0),
        (88, 'sl', 'Slovenian', 'Slovenščina', 0, 0),
        (89, 'sm', 'Samoan', 'Gagana Samoa', 0, 0),
        (90, 'sn', 'Shona', 'chiShona', 0, 0),
        (91, 'so', 'Somalia', 'Soomaaliga', 0, 0),
        (92, 'sq', 'Albanian', 'Shqip', 0, 0),
        (93, 'sr', 'Serbian', 'Српски', 0, 0),
        (94, 'ss', 'Swati', 'SiSwati', 0, 0),
        (95, 'st', 'Southern Sotho', 'Sesotho', 0, 0),
        (96, 'sv', 'Swedish', 'Svenska', 0, 0),
        (97, 'sw', 'Swahili', 'Kiswahili', 0, 0),
        (98, 'ta', 'Tamil', 'தமிழ்', 0, 0),
        (99, 'tg', 'Tajik', 'Тоҷикӣ', 0, 0),
        (100, 'th', 'Thai', 'ไทย / Phasa Thai', 0, 0),
        (101, 'ti', 'Tigrinya', 'ትግርኛ', 0, 0),
        (102, 'tk', 'Turkmen', 'Туркмен /تركمن ', 0, 0),
        (103, 'tn', 'Tswana', 'Setswana', 0, 0),
        (104, 'to', 'Tonga', 'Lea Faka-Tonga', 0, 0),
        (105, 'tr', 'Turkish', 'Türkçe', 0, 0),
        (106, 'ts', 'Tsonga', 'Xitsonga', 0, 0),
        (107, 'uk', 'Ukrainian', 'Українська', 0, 0),
        (108, 'ur', 'Urdu', 'اردو', 1, 0),
        (109, 'uz', 'Uzbek', 'Ўзбек', 0, 0),
        (110, 've', 'Venda', 'Tshivenḓa', 0, 0),
        (111, 'vi', 'Vietnamese', 'Tiếng Việt', 0, 0),
        (112, 'xh', 'Xhosa', 'isiXhosa', 0, 0),
        (113, 'zh', 'Chinese', '中文', 0, 0),
        (114, 'zu', 'Zulu', 'isiZulu', 0, 0)");

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('languages');
    }
}
