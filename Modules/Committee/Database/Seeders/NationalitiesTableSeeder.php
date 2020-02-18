<?php


namespace Modules\Committee\Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Modules\Committee\Entities\Nationality;

class NationalitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table(Nationality::table())->truncate();

        $Nationalities = [
            
              [
                'name' =>  'آروبا',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ], 
               [
                'name' =>   'أذربيجان',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ], 
               [
                'name' =>   'أرمينيا',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ], 
              [
                'name' =>   'أسبانيا',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ], 
               [
                'name' =>   'أستراليا',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ], 
              [
                'name' =>   'أفغانستان',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ], 
           [
                'name' =>   'ألبانيا',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ], 
           [
                'name' =>   'ألمانيا',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ], 
           [
                'name' =>   'أنتيجوا وبربودا',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ], 
           [
                'name' =>    'أنجولا',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ], 
           [
                'name' =>    'أنجويلا',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ], 
           [
                'name' =>   'أندورا',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ], 
           [
                'name' =>   'أورجواي',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ], 
           [
                'name' =>   'أوزبكستان',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ], 
           [
                'name' =>   'أوغندا',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ], 
           [
                'name' =>   'أوكرانيا',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ], 
           [
                'name' =>    'أيرلندا',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ], 
           [
                'name' =>    'أيسلندا',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ], 
           [
                'name' =>    'اثيوبيا',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ], 
           [
                'name' =>   'اريتريا',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ], 
           [
                'name' =>  'استونيا',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ], 
           [
                'name' =>   'اسرائيل',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ], 
           [
                'name' =>   'الأرجنتين',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ], 
           [
                'name' =>    'الأردن',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ], 
           [
                'name' =>    'الاكوادور',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ], 
           [
                'name' =>    'الامارات العربية المتحدة',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ], 
           [
                'name' =>   'الباهاما',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ], 
           [
                'name' =>   'البحرين',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ], 
           [
                'name' =>    'البرازيل',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ], 
           [
                'name' =>    'البرتغال',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ], 
           [
                'name' =>    'البوسنة والهرسك',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ], 
           [
                'name' =>    'الجابون',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ], 
           [
                'name' =>    'الجبل الأسود',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ], 
           [
                'name' =>    'الجزائر',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ], 
           [
                'name' =>    'الدانمرك',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ], 
           [
                'name' =>    'الرأس الأخضر',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ], 
           [
                'name' =>    'السلفادور',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ], 
           [
                'name' =>    'السنغال',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ], 
           [
                'name' =>    'السودان',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ], 
           [
                'name' =>    'السويد',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ], 
           [
                'name' =>    'الصحراء الغربية',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ], 
           [
                'name' =>   'الصومال',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ], 
           [
                'name' =>    'الصين',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ], 
           [
                'name' =>   'العراق',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ], 
           [
                'name' =>    'الفاتيكان',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ], 
           [
                'name' =>    'الفيلبين',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ], 
           [
                'name' =>    'القطب الجنوبي',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ], 
           [
                'name' =>   'الكاميرون',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ], 
           [
                'name' =>    'الكونغو - برازافيل',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ], 
           [
                'name' =>    'الكويت',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ], 
           [
                'name' =>    'المجر',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ], 
           [
                'name' =>    'المحيط الهندي البريطاني',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ], 
           [
                'name' =>    'المغرب',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ], 
           [
                'name' =>   'المقاطعات الجنوبية الفرنسية',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ], 
           [
                'name' =>    'المكسيك',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ], 
           [
                'name' =>    'المملكة العربية السعودية',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ], 
           [
                'name' =>   'المملكة المتحدة',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ], 
           [
                'name' =>   'النرويج',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ], 
           [
                'name' =>   'النمسا',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ], 
           [
                'name' =>    'النيجر',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ], 
           [
                'name' =>    'الهند',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ], 
           [
                'name' =>   'الولايات المتحدة الأمريكية',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ], 
           [
                'name' =>    'اليابان',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ], 
           [
                'name' =>   'اليمن',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ], 
           [
                'name' =>    'اليونان',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ], 
           [
                'name' =>    'اندونيسيا',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ], 
           [
                'name' =>    'ايران',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ], 
           [
                'name' =>    'ايطاليا',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ], 
           [
                'name' =>    'بابوا غينيا الجديدة',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ], 
           [
                'name' =>    'باراجواي',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ], 
           [
                'name' =>    'باكستان',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ], 
           [
                'name' =>   'بالاو',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ], 
           [
                'name' =>    'بتسوانا',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ], 
           [
                'name' =>   'بتكايرن',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ], 
           [
                'name' =>   'بربادوس',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ], 
           [
                'name' =>    'برمودا',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ], 
           [
                'name' =>    'بروناي',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ], 
           [
                'name' =>    'بلجيكا',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ], 
           [
                'name' =>   'بلغاريا',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ], 
           [
                'name' =>    'بليز',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ], 
           [
                'name' =>    'بنجلاديش',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ], 
           [
                'name' =>    'بنما',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ], 
           [
                'name' =>   'بنين',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ], 
           [
                'name' =>    'بوتان',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ], 
           [
                'name' =>    'بورتوريكو',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ], 
           [
                'name' =>   'بوركينا فاسو',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ], 
           [
                'name' =>    'بوروندي',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ], 
           [
                'name' =>    'بولندا',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ], 
           [
                'name' =>   'بوليفيا',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ], 
           [
                'name' =>    'بولينيزيا الفرنسية',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ], 
           [
                'name' =>    'بيرو',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ], 
           [
                'name' =>   'تانزانيا',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ], 
           [
                'name' =>    'تايلند',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ], 
           [
                'name' =>    'تايوان',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ], 
           [
                'name' =>    'تركمانستان',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ], 
           [
                'name' =>    'تركيا',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ], 
           [
                'name' =>    'ترينيداد وتوباغو',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ], 
           [
                'name' =>    'تشاد',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ], 
           [
                'name' =>   'توجو',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ], 
           [
                'name' =>   'توفالو',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ], 
           [
                'name' =>   'توكيلو',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ], 
           [
                'name' =>    'تونجا',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ], 
           [
                'name' =>   'تونس',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ], 
           [
                'name' =>    'تيمور الشرقية',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ], 
           [
                'name' =>   'جامايكا',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ], 
           [
                'name' =>    'جبل طارق',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ], 
           [
                'name' =>    'جرينادا',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ], 
           [
                'name' =>   'جرينلاند',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ], 
           [
                'name' =>    'جزر أولان',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ], 
           [
                'name' =>   'جزر الأنتيل الهولندية',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ], 
           [
                'name' =>    'جزر الترك وجايكوس',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ], 
           [
                'name' =>    'جزر القمر',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ], 
           [
                'name' =>    'جزر الكايمن',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ], 
           [
                'name' =>    'جزر المارشال',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ], 
           [
                'name' =>    'جزر الملديف',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ], 
           [
                'name' =>    'جزر الولايات المتحدة البعيدة الصغيرة',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ], 
           [
                'name' =>   'جزر سليمان',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ], 
           [
                'name' =>    'جزر فارو',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ], 
           [
                'name' =>    'جزر فرجين الأمريكية',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ], 
           [
                'name' =>    'جزر فرجين البريطانية',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ], 
           [
                'name' =>    'جزر فوكلاند',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ], 
           [
                'name' =>    'جزر كوك',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ], 
           [
                'name' =>   'جزر كوكوس',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ], 
           [
                'name' =>   'جزر ماريانا الشمالية',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ], 
           [
                'name' =>   'جزر والس وفوتونا',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ], 
           [
                'name' =>  'جزيرة الكريسماس',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ], 
           [
                'name' =>    'جزيرة بوفيه',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ], 
           [
                'name' =>    'جزيرة مان',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ], 
           [
                'name' =>   'جزيرة نورفوك',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ], 
           [
                'name' =>    'جزيرة هيرد وماكدونالد',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ], 
           [
                'name' =>   'جمهورية افريقيا الوسطى',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ], 
           [
                'name' =>    'جمهورية التشيك',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ], 
           [
                'name' =>   'جمهورية الدومينيك',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ], 
           [
                'name' =>    'جمهورية الكونغو الديمقراطية',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ], 
           [
                'name' =>   'جمهورية جنوب افريقيا',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ], 
           [
                'name' =>    'جواتيمالا',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ], 
           [
                'name' =>    'جوادلوب',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ], 
           [
                'name' =>    'جوام',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ], 
           [
                'name' =>   'جورجيا',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ], 
           [
                'name' =>    'جورجيا الجنوبية وجزر ساندويتش الجنوبية',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ], 
           [
                'name' =>    'جيبوتي',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ], 
           [
                'name' =>    'جيرسي',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ], 
           [
                'name' =>  'دومينيكا',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ], 
           [
                'name' =>   'رواندا',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ], 
           [
                'name' =>    'روسيا',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ], 
           [
                'name' =>    'روسيا البيضاء',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ], 
           [
                'name' =>    'رومانيا',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ], 
           [
                'name' =>    'روينيون',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ], 
           [
                'name' =>    'زامبيا',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ], 
           [
                'name' =>    'زيمبابوي',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ], 
           [
                'name' =>    'ساحل العاج',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ], 
           [
                'name' =>    'ساموا',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ], 
           [
                'name' =>  'ساموا الأمريكية',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ], 
           [
                'name' =>    'سان مارينو',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ], 
           [
                'name' =>    'سانت بيير وميكولون',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ], 
           [
                'name' =>    'سانت فنسنت وغرنادين',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ], 
           [
                'name' =>    'سانت كيتس ونيفيس',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ], 
           [
                'name' =>    'سانت لوسيا',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ], 
           [
                'name' =>    'سانت مارتين',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ], 
           [
                'name' =>    'سانت هيلنا',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ], 
           [
                'name' =>    'ساو تومي وبرينسيبي',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ], 
           [
                'name' =>    'سريلانكا',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ], 
           [
                'name' =>    'سفالبارد وجان مايان',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ], 
           [
                'name' =>    'سلوفاكيا',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ], 
           [
                'name' =>    'سلوفينيا',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ], 
           [
                'name' =>    'سنغافورة',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ], 
           [
                'name' =>    'سوازيلاند',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ], 
           [
                'name' =>   'سوريا',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ], 
           [
                'name' =>    'سورينام',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ], 
           [
                'name' =>   'سويسرا',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ], 
           [
                'name' =>    'سيراليون',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ], 
           [
                'name' =>   'سيشل',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ], 
           [
                'name' =>    'شيلي',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ], 
           [
                'name' =>    'صربيا',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ], 
           [
                'name' =>    'صربيا والجبل الأسود',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ], 
           [
                'name' =>   'طاجكستان',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ], 
           [
                'name' =>    'عمان',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ], 
           [
                'name' =>    'غامبيا',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ], 
           [
                'name' =>    'غانا',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ], 
           [
                'name' =>   'غويانا',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ], 
           [
                'name' =>    'غيانا',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ], 
           [
                'name' =>    'غينيا',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ], 
           [
                'name' =>    'غينيا الاستوائية',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ], 
           [
                'name' =>    'غينيا بيساو',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ], 
           [
                'name' =>   'فانواتو',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ], 
           [
                'name' =>    'فرنسا',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ], 
           [
                'name' =>   'فلسطين',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ], 
           [
                'name' =>   'فنزويلا',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ], 
           [
                'name' =>   'فنلندا',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ], 
           [
                'name' =>    'فيتنام',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ], 
           [
                'name' =>   'فيجي',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ], 
           [
                'name' =>    'قبرص',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ], 
           [
                'name' =>    'قرغيزستان',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ], 
           [
                'name' =>    'قطر',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ], 
           [
                'name' =>    'كازاخستان',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ], 
           [
                'name' =>    'كاليدونيا الجديدة',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ], 
           [
                'name' =>    'كرواتيا',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ], 
           [
                'name' =>   'كمبوديا',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ], 
           [
                'name' =>    'كندا',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ], 
           [
                'name' =>    'كوبا',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ], 
           [
                'name' =>    'كوريا الجنوبية',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ], 
           [
                'name' =>   'كوريا الشمالية',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ], 
           [
                'name' =>   'كوستاريكا',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ], 
           [
                'name' =>  'كولومبيا',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ], 
           [
                'name' =>    'كيريباتي',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ], 
           [
                'name' =>    'كينيا',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ], 
           [
                'name' =>    'لاتفيا',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ], 
           [
                'name' =>    'لاوس',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ], 
           [
                'name' =>   'لبنان',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ], 
           [
                'name' =>    'لوكسمبورج',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ], 
           [
                'name' =>  'ليبيا',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ], 
           [
                'name' =>   'ليبيريا',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ], 
           [
                'name' =>    'ليتوانيا',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ], 
           [
                'name' =>   'ليختنشتاين',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ], 
           [
                'name' =>    'ليسوتو',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ], 
           [
                'name' =>    'مارتينيك',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ], 
           [
                'name' =>    'ماكاو الصينية',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ], 
           [
                'name' =>   'مالطا',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ], 
           [
                'name' =>    'مالي',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ], 
           [
                'name' =>    'ماليزيا',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ], 
           [
                'name' =>    'مايوت',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ], 
           [
                'name' =>    'مدغشقر',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ], 
           [
                'name' =>    'مصر',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ], 
           [
                'name' =>    'مقدونيا',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ], 
           [
                'name' =>    'ملاوي',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ], 
           [
                'name' =>    'منطقة غير معرفة',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ], 
           [
                'name' =>    'منغوليا',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ], 
           [
                'name' =>   'موريتانيا',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ], 
           [
                'name' =>   'موريشيوس',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ], 
           [
                'name' =>    'موزمبيق',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ], 
           [
                'name' =>    'مولدافيا',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ], 
           [
                'name' =>    'موناكو',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ], 
           [
                'name' =>     'مونتسرات',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ], 
           [
                'name' =>    'ميانمار',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ], 
           [
                'name' =>    'ميكرونيزيا',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ], 
           [
                'name' =>    'ناميبيا',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ], 
           [
                'name' =>   'نورو',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ], 
           [
                'name' =>    'نيبال',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ], 
           [
                'name' =>    'نيجيريا',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ], 
           [
                'name' =>   'نيكاراجوا',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ], 
           [
                'name' =>    'نيوزيلاندا',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ], 
           [
                'name' =>    'نيوي',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ], 
           [
                'name' =>    'هايتي',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ], 
           [
                'name' =>   'هندوراس',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ], 
           [
                'name' =>    'هولندا',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ], 
           [
                'name' =>    'هونج كونج الصينية',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ], 
        ];

        Nationality::insert($Nationalities);
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}