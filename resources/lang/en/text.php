<?php

return [
    'account' => [
        'http_unauthorized' => 'Không được cấp quyền!',
        // 'unauthorized' => 'Tài khoản không tồn tại',
        'login'             => [
            'successfully'       => 'Đăng nhập thành công',
            'fail'                 => [
                'user'      => 'Tài khoản không tồn tại',
                'password'  => 'Mật khẩu sai'
            ]
        ]
    ],
    'attendance' => [
        'check_schedule' => 'Hôm nay bạn không có tiết!',
        'turn_on_attendance' => 'Bật điểm danh thành công',
        'turn_off_attendance' => 'Tắt điểm danh thành công',
        'is_not_on' => 'Điểm danh buổi học không được bật',
        'out_of_range'=> 'Vị trí của bạn nằm ngoài phạm vi điểm danh',
        'successfully' => 'Bạn đã điểm danh thành công',
        'fail' => 'Thiết bị không chính xác'
    ]
];
