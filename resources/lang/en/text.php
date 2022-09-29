<?php

return [
    'account' => [
        'http_unauthorized' => 'Không được cấp quyền!',
        'login'             => [
            'successfully'       => 'Đăng nhập thành công',
            'fail'                 => [
                'user'      => 'Tài khoản không tồn tại',
                'password'  => 'Mật khẩu sai'
            ]
        ],
        'update' => [
            'successfully' => 'Cập nhập thành công!',
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
    ],
    'score' => [
        'update_successful' => 'Cập nhập điểm thành công!',
        'feedback_successful' => 'có phản hồi điểm mới!',
        'error_feedback' => 'Bạn chỉ có thể phản hồi điểm trong vòng 3 ngày, tính từ khi nhận được thông báo cập nhập điểm!'
    ]
];
