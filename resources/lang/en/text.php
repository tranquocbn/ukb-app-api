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
        'error_attendance' => 'Chưa đến thời gian buổi học!',
        'turn_on_attendance' => 'Bật điểm danh thành công!',
        'turn_off_attendance' => 'Tắt điểm danh thành công!',
        'is_not_on' => 'Điểm danh buổi học không được bật!',
        'successfully' => 'Bạn đã điểm danh thành công!',
        'fail' => 'Thiết bị không chính xác!'
    ],
    'leave' => [
        'date_invalid' => 'Ngày xin nghỉ hợp lệ!',
        'date_uninvalid' => 'Ngày xin nghỉ không hợp lệ!'
    ]
];
