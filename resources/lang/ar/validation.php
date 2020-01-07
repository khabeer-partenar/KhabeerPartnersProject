<?php
return [
    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */
    'accepted'             => 'يجب قبول :attribute.',
    'active_url'           => ':attribute لا يُمثّل رابطًا صحيحًا.',
    'after'                => 'يجب على :attribute أن يكون تاريخًا لاحقًا للتاريخ :date.',
    'after_or_equal'       => ':attribute يجب أن يكون تاريخاً لاحقاً أو مطابقاً للتاريخ :date.',
    'alpha'                => 'يجب أن لا يحتوي :attribute سوى على حروف.',
    'alpha_dash'           => 'يجب أن لا يحتوي :attribute سوى على حروف، أرقام ومطّات.',
    'alpha_num'            => 'يجب أن يحتوي :attribute على حروفٍ وأرقامٍ فقط.',
    'array'                => 'يجب أن يكون :attribute ًمصفوفة.',
    'before'               => 'يجب على :attribute أن يكون تاريخًا سابقًا للتاريخ :date.',
    'before_or_equal'      => ':attribute يجب أن يكون تاريخا سابقا أو مطابقا للتاريخ :date.',
    'between'              => [
        'numeric' => 'يجب أن تكون قيمة :attribute بين :min و :max.',
        'file'    => 'يجب أن يكون حجم الملف :attribute بين :min و :max كيلوبايت.',
        'string'  => 'يجب أن يكون عدد حروف النّص :attribute بين :min و :max.',
        'array'   => 'يجب أن يحتوي :attribute على عدد من العناصر بين :min و :max.',
    ],
    'boolean'              => 'يجب أن تكون قيمة :attribute إما true أو false .',
    'confirmed'            => 'حقل التأكيد غير مُطابق للحقل :attribute.',
    'date'                 => ':attribute ليس تاريخًا صحيحًا.',
    'date_equals'          => 'يجب أن يكون :attribute مطابقاً للتاريخ :date.',
    'date_format'          => 'لا يتوافق :attribute مع الشكل :format.',
    'different'            => 'يجب أن يكون الحقلان :attribute و :other مُختلفين.',
    'digits'               => 'يجب أن يحتوي :attribute على :digits رقمًا/أرقام.',
    'digits_between'       => 'يجب أن يحتوي :attribute بين :min و :max رقمًا/أرقام .',
    'dimensions'           => 'الـ :attribute يحتوي على أبعاد صورة غير صالحة.',
    'distinct'             => 'للحقل :attribute قيمة مُكرّرة.',
    'email'                => 'يجب أن يكون :attribute عنوان بريد إلكتروني صحيح البُنية.',
    'exists'               => 'القيمة المحددة :attribute غير موجودة.',
    'file'                 => 'الـ :attribute يجب أن يكون ملفا.',
    'filled'               => ':attribute إجباري.',
    'gt'                   => [
        'numeric' => 'يجب أن تكون قيمة :attribute أكبر من :value.',
        'file'    => 'يجب أن يكون حجم الملف :attribute أكبر من :value كيلوبايت.',
        'string'  => 'يجب أن يكون طول النّص :attribute أكثر من :value حروفٍ/حرفًا.',
        'array'   => 'يجب أن يحتوي :attribute على أكثر من :value عناصر/عنصر.',
    ],
    'gte'                  => [
        'numeric' => 'يجب أن تكون قيمة :attribute مساوية أو أكبر من :value.',
        'file'    => 'يجب أن يكون حجم الملف :attribute على الأقل :value كيلوبايت.',
        'string'  => 'يجب أن يكون طول النص :attribute على الأقل :value حروفٍ/حرفًا.',
        'array'   => 'يجب أن يحتوي :attribute على الأقل على :value عُنصرًا/عناصر.',
    ],
    'image'                => 'يجب أن يكون :attribute صورةً.',
    'in'                   => ':attribute غير موجود.',
    'in_array'             => ':attribute غير موجود في :other.',
    'integer'              => 'يجب أن يكون :attribute عددًا صحيحًا.',
    'ip'                   => 'يجب أن يكون :attribute عنوان IP صحيحًا.',
    'ipv4'                 => 'يجب أن يكون :attribute عنوان IPv4 صحيحًا.',
    'ipv6'                 => 'يجب أن يكون :attribute عنوان IPv6 صحيحًا.',
    'json'                 => 'يجب أن يكون :attribute نصآ من نوع JSON.',
    'lt'                   => [
        'numeric' => 'يجب أن تكون قيمة :attribute أصغر من :value.',
        'file'    => 'يجب أن يكون حجم الملف :attribute أصغر من :value كيلوبايت.',
        'string'  => 'يجب أن يكون طول النّص :attribute أقل من :value حروفٍ/حرفًا.',
        'array'   => 'يجب أن يحتوي :attribute على أقل من :value عناصر/عنصر.',
    ],
    'lte'                  => [
        'numeric' => 'يجب أن تكون قيمة :attribute مساوية أو أصغر من :value.',
        'file'    => 'يجب أن لا يتجاوز حجم الملف :attribute :value كيلوبايت.',
        'string'  => 'يجب أن لا يتجاوز طول النّص :attribute :value حروفٍ/حرفًا.',
        'array'   => 'يجب أن لا يحتوي :attribute على أكثر من :value عناصر/عنصر.',
    ],
    'max'                  => [
        'numeric' => 'يجب أن تكون قيمة :attribute مساوية أو أصغر من :max.',
        'file'    => 'يجب أن لا يتجاوز حجم الملف :attribute :max كيلوبايت.',
        'string'  => 'يجب أن لا يتجاوز طول النّص :attribute :max حروفٍ/حرفًا.',
        'array'   => 'يجب أن لا يحتوي :attribute على أكثر من :max عناصر/عنصر.',
    ],
    'mimes'                => 'يجب أن يكون ملفًا من نوع : :values.',
    'mimetypes'            => 'يجب أن يكون ملفًا من نوع : :values.',
    'min'                  => [
        'numeric' => 'يجب أن تكون قيمة :attribute مساوية أو أكبر من :min.',
        'file'    => 'يجب أن يكون حجم الملف :attribute على الأقل :min كيلوبايت.',
        'string'  => 'يجب أن يكون طول النص :attribute على الأقل :min حروفٍ/حرفًا.',
        'array'   => 'يجب أن يحتوي :attribute على الأقل على :min عُنصرًا/عناصر.',
    ],
    'not_in'               => ':attribute موجود.',
    'not_regex'            => 'صيغة :attribute غير صحيحة.',
    'numeric'              => 'يجب على :attribute أن يكون رقمًا.',
    'present'              => 'يجب تقديم :attribute.',
    'regex'                => 'صيغة :attribute .غير صحيحة.',
    'required'             => ':attribute مطلوب.',
    'required_if'          => ':attribute مطلوب في حال ما إذا كان :other يساوي :value.',
    'required_unless'      => ':attribute مطلوب في حال ما لم يكن :other يساوي :values.',
    'required_with'        => ':attribute مطلوب إذا توفّر :values.',
    'required_with_all'    => ':attribute مطلوب إذا توفّر :values.',
    'required_without'     => ':attribute مطلوب إذا لم يتوفّر :values.',
    'required_without_all' => ':attribute مطلوب إذا لم يتوفّر :values.',
    'same'                 => 'يجب أن يتطابق :attribute مع :other.',
    'size'                 => [
        'numeric' => 'يجب أن تكون قيمة :attribute مساوية لـ :size.',
        'file'    => 'يجب أن يكون حجم الملف :attribute :size كيلوبايت.',
        'string'  => 'يجب أن يحتوي النص :attribute على :size حروفٍ/حرفًا بالضبط.',
        'array'   => 'يجب أن يحتوي :attribute على :size عنصرٍ/عناصر بالضبط.',
    ],
    'starts_with'          => 'يجب أن يبدأ :attribute بأحد القيم التالية: :values',
    'string'               => 'يجب أن يكون :attribute نصًا.',
    'timezone'             => 'يجب أن يكون :attribute نطاقًا زمنيًا صحيحًا.',
    'unique'               => 'قيمة :attribute مُستخدمة من قبل.',
    'uploaded'             => 'فشل في تحميل الـ :attribute.',
    'url'                  => 'صيغة الرابط :attribute غير صحيحة.',
    'uuid'                 => ':attribute يجب أن يكون بصيغة UUID سليمة.',
    'national_id'          => ':attribute يجب ان يكون سعودي',
    'phone_number'         => ':attribute غير صحيح البنيه',
    'filter_string'        => ':attribute لا يمكن ان يحتوني على رموز',
    'gov_email'            => ':attribute يجب ان ينتهي بإمتداد gov.sa',
    'wrong choice'         => ':attribute يجب أن يكون من النوع الصحيح',
    'main_coordinator_nominate_delegates'         => ' تم الترشيح من قبل المنسق المرجعى لا يمكنك الترشيح',
    'is_president_chairman'=> 'مطلوب واحد علي الأقل في حالة أن رئيس اللجنة هو معالي رئيس الهيئة',
    'if_date_is_after'     => ':attribute يجب أن يكون أكبر من :after',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */
    'custom' => [
        'first_meeting_at' => [
            'after' => 'يجب على :attribute أن يكون تاريخًا لاحقًا لتاريخ اليوم',
        ],
    ],
    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */
    'attributes' => [
        'name'                  => 'الاسم',
        'national_id'           => 'رقم الهوية',
        'username'              => 'اسم المُستخدم',
        'email'                 => 'البريد الالكتروني',
        'first_name'            => 'الاسم الأول',
        'last_name'             => 'اسم العائلة',
        'password'              => 'كلمة المرور',
        'password_confirmation' => 'تأكيد كلمة المرور',
        'city'                  => 'المدينة',
        'country'               => 'الدولة',
        'address'               => 'العنوان',
        'phone'                 => 'الهاتف',
        'mobile'                => 'الجوال',
        'age'                   => 'العمر',
        'sex'                   => 'الجنس',
        'gender'                => 'النوع',
        'day'                   => 'اليوم',
        'month'                 => 'الشهر',
        'year'                  => 'السنة',
        'hour'                  => 'ساعة',
        'minute'                => 'دقيقة',
        'second'                => 'ثانية',
        'title'                 => 'العنوان',
        'content'               => 'المُحتوى',
        'description'           => 'الوصف',
        'excerpt'               => 'المُلخص',
        'date'                  => 'التاريخ',
        'time'                  => 'الوقت',
        'available'             => 'مُتاح',
        'size'                  => 'الحجم',

        'main_department_id'    => 'نوع الجهة',
        'parent_department_id'  => 'اسم الجهة',
        'direct_department_id'  => 'الإدارة',
        'phone_number'          => 'رقم الجوال',
        'job_role_id'           => 'الدور الوظيفي',
        'title'                 => 'اللقب',
        'job_title'             => 'المسمي الوظيفي',
        'department_reference'  => 'مرجعية الجهة',
        'is_reference'          => 'جهة مرجعية',
        'reference_id'          => 'مرجعية الجهة',
        'telephone'             => 'الهاتف',
        'department_name'       => 'اسم الإدارة',
        'direct_manager_id'     => 'المدير',
        'resource_staff_number' => 'رقم وارد الهيئة',
        'resource_at' => 'تاريخ التوريد',
        'please choose' => 'من فضلك قم بالاختيار',
        'treatment_type_id' => 'نوع المعاملة',
        'resource_by' => 'وردت من',
        'treatment_number' => 'رقم المعاملة',
        'treatment_time' => 'تاريخ المعاملة',
        'recommended_by_id' => 'الجهة الموصية بالدراسة',
        'recommendation_number' => 'رقم التوصية',
        'recommended_at' => 'تاريخ التوصية',
        'source_of_study_id' => 'الجهة مصدر الدراسة',
        'treatment_urgency_id' => 'اعجلية المعاملة',
        'treatment_importance_id' => 'سرية المعاملة',
        'first_meeting_at' => 'تاريخ أول اجتماع',
        'subject' => 'الموضوع',
        'president_id' => 'رئيس الدراسة',
        'advisor_id' => 'المستشار المسؤول عن الدراسة',
        'tasks' => 'مهام الاجتماع',
        'participant_advisors' => 'مستشارين مشاركين',
        'members_count' => 'عدد الأعضاء',
        'file' => 'الملف',
        'direct_department' => 'الإدارة',
    ],
];
