<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [

            'الأقسام',
            'قائمة الأقسام',
            'المنتجات',
            'قائمة المنتجات',
            'الزبائن',
            'قائمة الزبائن',
            'الطلبات',
            'قائمة الطلبات',
            'المستخدمين',
            'قائمة المستخدمين',
            'صلاحيات المستخدمين',


            'اضافة قسم',
            'تعديل القسم',
            ' حذف القسم',


            'اضافة مستخدم',
            'تعديل مستخدم',
            'حذف مستخدم',

            'عرض صلاحية',
            'اضافة صلاحية',
            'تعديل صلاحية',
            'حذف صلاحية',

            'اضافة منتج',
            'تعديل منتج',
            'حذف منتج',

            'اضافة زبون',
            'تعديل زبون',
            'حذف زبون',

            'اضافة طلب',
            'تعديل طلب',
            'حذف طلب',
            'عرض طلب',
            'طباعة طلب',



        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}