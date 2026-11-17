<?php

return [
    // الأدوار اللي 2FA إجباري عليها
    'required_roles' => ['admin'],

    // مدة تذكّر الجهاز بالأيام
    'remember_days' => 30,

    // اسم الكوكي
    'cookie' => 'admin_device',

    // عدد رموز الاسترداد
    'recovery_codes' => 8,
];
