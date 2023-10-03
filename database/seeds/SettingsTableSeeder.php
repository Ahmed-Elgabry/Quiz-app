<?php

use Illuminate\Database\Seeder;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        return \App\Settings::create([
            'sitename_ar'  => 'المقياس',
            'sitename_en' => 'Almiqias',
            'description_ar' => 'المقياس يتيح لك إنشاء اختبارات خاصة بك ونشرها مع من تريد ، بالاضافة الى العديد من المميزات والخدمات .',
            'aboutUs_text_ar' => 'المقياس يتيح لك إنشاء اختبارات خاصة بك ونشرها مع من تريد ، بالاضافة الى العديد من المميزات والخدمات .',
            'description_en' => 'Almiqias allows you to create your own Quizzes and share them with whoever you want, in addition to many features and services.',
            'aboutUs_text_en' => 'Almiqias allows you to create your own Quizzes and share them with whoever you want, in addition to many features and services.',
            'email'=>'contact@almiqias.com',
            'facebook'=>'https://www.facebook.com/Almiqias/posts/?ref=page_internal',
            'twitter'=>'https://twitter.com/Almiqias',
            'snapshat'=>'https://www.snapchat.com/add/almiqias',
            'instagram'=>'https://www.instagram.com/almiqias/'
            /* 'logo' => '',*/

        ]);
    }
}
