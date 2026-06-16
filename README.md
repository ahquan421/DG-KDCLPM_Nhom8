# NHÓM 8: KIỂM THỬ CHỨC NĂNG VÀ HIỆU NĂNG CHO HỆ THỐNG WEBSITE BÁN SÁCH TRỰC TUYẾN
Thành viên: 

| Họ và tên            | MSSV     | 
| -------------------- | -------- | 
| Nguyễn Thị Thuỳ Linh | 23010633 | 
| Nguyễn Anh Quân      | 23010375 |
## 1. Giới thiệu

Dự án được thực hiện nhằm kiểm thử chất lượng của hệ thống Website Bán Sách Trực Tuyến được phát triển trên nền tảng Laravel và MySQL. Quá trình kiểm thử tập trung đánh giá tính đúng đắn của các chức năng nghiệp vụ, khả năng hoạt động ổn định của hệ thống và hiệu năng xử lý khi có nhiều người dùng truy cập đồng thời.

Các phương pháp kiểm thử được áp dụng bao gồm:

* Kiểm thử hộp trắng (White Box Testing)
* Kiểm thử hộp đen (Black Box Testing)
* Kiểm thử hiệu năng (Performance Testing)

## 2. Mục tiêu

* Kiểm tra tính chính xác của các chức năng nghiệp vụ.
* Đảm bảo hệ thống đáp ứng các yêu cầu đã được mô tả trong tài liệu SRS.
* Phát hiện và ghi nhận các lỗi trong quá trình vận hành.
* Đánh giá khả năng đáp ứng của hệ thống dưới tải.
* Đưa ra nhận xét và đề xuất cải tiến nhằm nâng cao chất lượng phần mềm.

## 3. Công nghệ sử dụng

### Hệ thống được kiểm thử

* Framework: Laravel
* Ngôn ngữ: PHP
* Cơ sở dữ liệu: MySQL
* Web Server: Apache (XAMPP)

### Công cụ kiểm thử

* Apache JMeter
* MySQL Workbench
* Visual Studio Code
* GitHub

## 4. Môi trường kiểm thử

| Thành phần   | Cấu hình                                       |
| ------------ | ---------------------------------------------- |
| Hệ điều hành | Windows 10/11                                  |
| Web Server   | Apache (XAMPP)                                 |
| PHP          | 8.x                                            |
| Framework    | Laravel                                        |
| Database     | MySQL                                          |
| Trình duyệt  | Google Chrome, Microsoft Edge, Mozilla Firefox |


## 5. Các chức năng được kiểm thử

### Chức năng người dùng

* Đăng ký tài khoản
* Đăng nhập
* Quản lý thông tin cá nhân
* Tìm kiếm sản phẩm
* Quản lý giỏ hàng
* Đặt hàng và thanh toán
* Xem lịch sử đơn hàng

### Chức năng quản trị viên

* Quản lý sản phẩm
* Quản lý danh mục
* Quản lý đơn hàng
* Quản lý người dùng
* Thống kê doanh thu


## 6. Kiểm thử hộp trắng (White Box Testing)

Các chức năng được lựa chọn kiểm thử hộp trắng:

* Đăng ký tài khoản
* Đăng nhập
* Thêm vào giỏ hàng
* Thanh toán đơn hàng

Kỹ thuật sử dụng:

* Basis Path Testing
* Cyclomatic Complexity

Mục tiêu:

* Kiểm tra luồng xử lý.
* Kiểm tra điều kiện rẽ nhánh.
* Đảm bảo các đường đi quan trọng được thực hiện.


## 7. Kiểm thử hộp đen (Black Box Testing)

Kỹ thuật áp dụng:

* Equivalence Partitioning
* Boundary Value Analysis

Các chức năng kiểm thử:

* Đăng ký tài khoản
* Đăng nhập
* Tìm kiếm sản phẩm
* Quản lý giỏ hàng
* Đặt hàng và thanh toán
* Quản lý sản phẩm
* Quản lý đơn hàng
* Thống kê doanh thu

Mục tiêu:

* Kiểm tra dữ liệu hợp lệ và không hợp lệ.
* Kiểm tra kết quả đầu ra.
* Đánh giá tính đúng đắn của các nghiệp vụ.

## 8. Kiểm thử hiệu năng

Công cụ sử dụng:

Apache JMeter

Các kịch bản kiểm thử:

* Truy cập trang chủ
* Đăng nhập hệ thống
* Tìm kiếm sản phẩm
* Đặt hàng

Các chỉ số đánh giá:

* Response Time
* Throughput
* Error Rate
* Concurrent Users

## 9. Kết quả đạt được

* Các chức năng chính hoạt động đúng theo yêu cầu.
* Dữ liệu được lưu trữ và xử lý chính xác.
* Hệ thống đáp ứng tốt các nghiệp vụ bán sách trực tuyến.
* Hiệu năng hệ thống đáp ứng yêu cầu trong môi trường kiểm thử.
* Các lỗi phát hiện được ghi nhận và xử lý trong quá trình kiểm thử.

## 10. Kết luận

Kết quả kiểm thử cho thấy hệ thống Website Bán Sách Trực Tuyến đáp ứng được các yêu cầu chức năng và hiệu năng cơ bản. Các phương pháp kiểm thử được áp dụng đã giúp phát hiện và xử lý các lỗi trong quá trình phát triển, góp phần nâng cao chất lượng và độ ổn định của hệ thống trước khi đưa vào sử dụng.
