<?php
while (true) {
    echo "Running scheduled tasks..." . PHP_EOL;
    exec('php artisan schedule:run');
    sleep(30); // Đợi 1 phút trước khi chạy lại
}
