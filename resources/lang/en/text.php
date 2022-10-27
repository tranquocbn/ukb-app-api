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
        'logout' => [
            'successfully' => 'Tài khoản đã được đăng xuất!'
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
        'limited' => 'Bạn đã nghỉ quá 2 buổi học!',
        'overtime' => 'Bạn chỉ có thể tạo đơn trước buổi học 1 giờ!',
        'successfully' => 'Tạo đơn xin nghỉ thành công!',
        'update' => [
            'fail' => 'Đơn đã được phê duyệt, không thể cập nhập!',
            'successfully' => 'Cập nhập đơn xin nghỉ thành công!'
        ],
        'delete' => [
            'fail' => 'Bạn chỉ có thể xóa đơn khi ngày hiện tại nhỏ hơn hoặc bằng ngày muốn nghỉ!',
            'successfully' => 'Đơn xin nghỉ đã được xóa!'
        ]
    ],
    'score' => [
        'update_successful' => 'Cập nhập điểm thành công!',
        'feedback_successful' => 'có phản hồi điểm mới!',
        'error_feedback' => 'Bạn chỉ có thể phản hồi điểm trong vòng 3 ngày, tính từ khi nhận được thông báo cập nhập điểm!'
    ]
];
