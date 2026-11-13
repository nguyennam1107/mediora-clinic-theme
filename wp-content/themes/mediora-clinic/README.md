# MEDIORA Luxury Clinic - Giao Diện WordPress Thẩm Mỹ Y Khoa Cao Cấp

> **Phiên bản:** 1.0.0  
> **Tác giả:** MEDIORA Clinic Development Team  
> **Bản quyền:** © 2026 MEDIORA Clinic. Mọi quyền được bảo lưu.

---

## 1. Giới Thiệu Tổng Quan

**MEDIORA Clinic Theme** là giải pháp giao diện WordPress chuyên nghiệp chuẩn y khoa, được thiết kế và tối ưu riêng cho các phòng khám chuyên khoa thẩm mỹ, viện thẩm mỹ 5 sao, trung tâm trẻ hóa da liễu và bệnh viện tạo hình vi phẫu.

Theme kết hợp hài hòa giữa ngôn ngữ hình ảnh sang trọng (Luxury Gold & Dark Medical Aesthetic), hiệu ứng mượt mà và nền tảng mã nguồn chuẩn WordPress VIP Coding Standards, đảm bảo:
- **Tốc độ tải trang vượt trội**: Tối ưu Core Web Vitals, Responsive Images (`<picture>` & `srcset`), Lazy-loading video cơ sở vật chất và hình ảnh chuẩn kỹ thuật.
- **Chuẩn SEO Y Tế & Schema.org**: Tích hợp cấu trúc dữ liệu JSON-LD cho `MedicalBusiness`, `Physician`, `MedicalProcedure` và OpenGraph/Twitter Cards tự động.
- **An toàn bảo mật & Tiêu chuẩn Y khoa**: Quy trình đặt lịch khám bảo mật nonce token, lọc XSS/SQLi nghiêm ngặt và lưu trữ thông tin đăng ký tư vấn trực tiếp trong hệ thống quản trị.
- **Khả năng tùy biến linh hoạt**: Tích hợp WordPress Customizer toàn diện, hỗ trợ quản lý hotline, giấy phép hoạt động, video cơ sở vật chất, liên kết mạng xã hội chỉ với vài cú nhấp chuột.

---

## 2. Y Cầu Hệ Thống

Theme tương thích hoàn toàn với các môi trường máy chủ và phiên bản WordPress hiện đại:

- **WordPress:** Phiên bản 6.0 trở lên (khuyến nghị 6.4 - 6.6+).
- **PHP:** Phiên bản 7.4, 8.0, 8.1, 8.2 hoặc **8.3+** (khuyến nghị PHP 8.2 trở lên).
- **Cơ sở dữ liệu:** MySQL 5.7+ hoặc MariaDB 10.4+.
- **Tiện ích mở rộng PHP yêu cầu:** `curl`, `mbstring`, `xml`, `gd` (hoặc `imagick`), `json`.
- **Cấu hình máy chủ khuyến nghị:**
  - `memory_limit` >= 256M
  - `upload_max_filesize` >= 64M
  - `post_max_size` >= 64M
  - `max_execution_time` >= 120s

---

## 3. Hướng Dẫn Cài Đặt Giao Diện

Có hai phương pháp triển khai theme lên website của bạn:

### Cách 1: Cài đặt thông qua WordPress Admin (Khuyên Dùng)
1. Đóng gói thư mục `mediora-clinic` thành file nén `.zip` (ví dụ: `mediora-clinic.zip`).
2. Đăng nhập trang quản trị WordPress (**WP Admin**).
3. Truy cập **Giao diện -> Giao diện** (*Appearance -> Themes*).
4. Nhấn nút **Thêm giao diện mới** (*Add New Theme*) -> **Tải giao diện lên** (*Upload Theme*).
5. Chọn file zip vừa nén và nhấn **Cài đặt ngay** (*Install Now*).
6. Sau khi quá trình tải lên hoàn tất, nhấn **Kích hoạt** (*Activate*).

### Cách 2: Triển khai trực tiếp qua FTP / SSH / Hosting File Manager
1. Giải nén thư mục `mediora-clinic`.
2. Sao chép toàn bộ thư mục `mediora-clinic` vào đường dẫn:
   ```
   wp-content/themes/mediora-clinic/
   ```
3. Đăng nhập vào trang quản trị WP Admin, vào **Giao diện -> Giao diện**, tìm giao diện **MEDIORA Luxury Clinic** và chọn **Kích hoạt**.

---

## 4. Hướng Dẫn Cấu Hình Trang Chủ & Trang Nội Dung

Sau khi kích hoạt giao diện, hãy thiết lập trang chủ tĩnh để website hiển thị đúng giao diện landing page:

1. **Tạo các trang bắt buộc** (nếu chưa nhập dữ liệu mẫu):
   - Vào **Trang -> Thêm trang mới** (*Pages -> Add New*):
     - Trang 1: Đặt tiêu đề **Trang Chủ** (Slug: `trang-chu`). Để nguyên Template mặc định.
     - Trang 2: Đặt tiêu đề **Về Chúng Tôi** (Slug: `ve-chung-toi`). Tại mục *Thuộc tính trang (Page Attributes)* -> Chọn Giao diện (*Template*): **Về Chúng Tôi - Mediora** (`page-about.php`).
     - Trang 3: Đặt tiêu đề **Dịch Vụ** (Slug: `dich-vu`). Tại mục *Thuộc tính trang* -> Chọn Giao diện: **Danh Mục Dịch Vụ - Mediora** (`page-services.php`).
     - Trang 4: Đặt tiêu đề **Liên Hệ** (Slug: `lien-he`). Tại mục *Thuộc tính trang* -> Chọn Giao diện: **Liên Hệ - Mediora** (`page-contact.php`).
     - Trang 5: Đặt tiêu đề **Tin Tức** (Slug: `tin-tuc`). Trang này dùng làm trang hiển thị bài viết.
2. **Cấu hình trang chủ tĩnh**:
   - Truy cập **Cài đặt -> Đọc** (*Settings -> Reading*).
   - Tại mục **Bố cục trang chủ** (*Your homepage displays*), chọn tùy chọn: **Một trang tĩnh (chọn ở dưới)** (*A static page*).
   - **Trang chủ** (*Homepage*): Chọn **Trang Chủ**.
   - **Trang bài viết** (*Posts page*): Chọn **Tin Tức**.
   - Nhấn **Lưu thay đổi** (*Save Changes*).
3. **Cập nhật Đường dẫn tĩnh (Permalinks)**:
   - Truy cập **Cài đặt -> Đường dẫn tĩnh** (*Settings -> Permalinks*).
   - Chọn định dạng: **Tiêu đề bài viết** (*Post name*): `/%postname%/`.
   - Nhấn **Lưu thay đổi** để làm mới Rewrite Rules cho CPT `dich-vu` và `bac-si`.

---

## 5. Hướng Dẫn Nhập Dữ Liệu Mẫu (Demo Data)

Giao diện đi kèm file dữ liệu mẫu chuẩn WXR 1.2 tại đường dẫn:
```
wp-content/themes/mediora-clinic/demo-data/sample-data.xml
```

Dữ liệu demo bao gồm:
- Toàn bộ trang cơ bản: Trang chủ, Về chúng tôi, Dịch vụ, Liên hệ, Tin tức.
- 6 Dịch vụ thẩm mỹ mẫu với đầy đủ quy trình và danh mục chuyên khoa.
- 3 Hồ sơ bác sĩ chuyên khoa với đầy đủ bằng cấp, số chứng chỉ hành nghề CCHN.
- 4 Bài viết kiến thức y khoa & làm đẹp chuyên sâu.
- Cấu trúc Menu chính và Menu chân trang được thiết lập sẵn.

### Các bước nhập:
1. Trong WP Admin, vào **Công cụ -> Nhập** (*Tools -> Import*).
2. Tại mục **WordPress**, nếu chưa cài plugin importer, hãy nhấn **Cài đặt ngay** (*Install Now*).
3. Nhấn **Chạy trình nhập** (*Run Importer*).
4. Nhấn **Choose File** (Chọn tệp) và tìm đến file `wp-content/themes/mediora-clinic/demo-data/sample-data.xml`.
5. Nhấn **Tải tệp lên và nhập** (*Upload file and import*).
6. Tại màn hình gán tác giả, gán các bài viết cho tài khoản quản trị hiện tại của bạn.
7. Đánh dấu tích vào ô **Tải về và nhập các tệp đính kèm** (*Download and import file attachments*).
8. Nhấn **Gửi** (*Submit*) và đợi quá trình nhập hoàn tất.
9. Sau khi nhập xong, vào **Giao diện -> Menu** để gán **Menu chính** vào vị trí `primary_menu` và **Menu chân trang** vào `footer_menu`.

---

## 6. Hướng Dẫn Sử Dụng WordPress Customizer (Tùy Biến Giao Diện)

Truy cập **Giao diện -> Tùy biến** (*Appearance -> Customize*) -> Chọn mục **Cấu hình MEDIORA Luxury Clinic**:

### 1. Phân mục "Thông tin phòng khám & Pháp lý"
- **Tên phòng khám / Thương hiệu**: Tên hiển thị trên bản quyền và các khối giới thiệu.
- **Hotline tư vấn hiển thị**: Số điện thoại hiển thị trên Header, Footer và nút gọi nhấp nháy góc màn hình (VD: `0945.334.832`).
- **Địa chỉ trụ sở phòng khám**: Địa chỉ phòng khám hiển thị tại chân trang và trang liên hệ.
- **Khu vực thành phố (Footer)**: Tiêu đề địa điểm hoạt động (VD: `TP. Hồ Chí Minh`).
- **Giấy phép hoạt động y tế (Title & Số GP)**: Số giấy phép khám chữa bệnh được Sở Y Tế cấp (VD: `Giấy phép hoạt động KBCB số: 09876/HCM-GPHĐ`).
- **Nội dung pháp lý 1, 2, 3**: Tên người chịu trách nhiệm chuyên môn kỹ thuật, số CCHN, thời gian phục vụ.

### 2. Phân mục "Đa phương tiện & Video CSVC"
- **URL Video Cơ sở vật chất (MP4)**: Đường dẫn file video quay không gian 5 sao của phòng khám. Hỗ trợ lazy-loading mượt mà.
- **URL Video Demo GMISS (MP4)**: Đường dẫn video kỹ thuật trẻ hóa vi phẫu GMISS hiển thị tại section trang chủ.
- **Đoạn văn triết lý thương hiệu**: Nội dung hiển thị tại khối triết lý thẩm mỹ trang chủ.
- **Ảnh nền khối Đăng ký nhận ưu đãi**: Tùy chỉnh banner cho section form cuối trang.

### 3. Phân mục "Mạng xã hội & Kênh liên lạc"
- **Đường dẫn Facebook Fanpage** (VD: `https://www.facebook.com/pkcktmmediora`).
- **Đường dẫn TikTok Channel** (VD: `https://www.tiktok.com/@phongkhammediora`).
- **Đường dẫn YouTube Channel**.
- **Đường dẫn Zalo Official Account** (VD: `https://zalo.me/636737550228660397`).
- **Đường dẫn Facebook Messenger** (VD: `https://m.me/pkcktmmediora`).

---

## 7. Quản Lý Dịch Vụ Thẩm Mỹ & Đội Ngũ Bác Sĩ

Theme tích hợp sẵn 2 Custom Post Types chuyên biệt trong thanh menu bên trái WP Admin:

### Quản lý Dịch Vụ Thẩm Mỹ (`service`)
- Truy cập **Dịch vụ Thẩm mỹ -> Thêm dịch vụ mới**:
  - **Tiêu đề**: Tên dịch vụ (VD: *Nâng cơ trẻ hóa bằng sợi sinh học GMISS độc quyền*).
  - **Nội dung**: Chi tiết ưu điểm, đối tượng chỉ định, quy trình lâm sàng từng bước và hướng dẫn chăm sóc.
  - **Tóm tắt (Excerpt)**: Đoạn mô tả ngắn hiển thị trên thẻ card ở trang danh mục dịch vụ.
  - **Ảnh đại diện (Featured Image)**: Ảnh sắc nét tỷ lệ 16:9 hoặc 4:3 (khuyến nghị kích thước từ 800x500px trở lên).
  - **Chuyên khoa / Danh mục**: Phân loại theo chuyên khoa (VD: *Trẻ Hóa & Nâng Cơ Sinh Học*, *Phẫu Thuật Tạo Hình Vi Phẫu*, *Điều Trị & Chăm Sóc Da Y Khoa*).

### Quản lý Đội Ngũ Bác Sĩ (`doctor`)
- Truy cập **Đội ngũ Bác sĩ -> Thêm bác sĩ mới**:
  - **Tiêu đề**: Họ và tên bác sĩ (VD: *ThS. BS Trần Minh Trí*).
  - **Nội dung**: Tiểu sử, quá trình đào tạo, thành tích y khoa, chứng chỉ quốc tế.
  - **Ảnh đại diện (Chân dung)**: Ảnh chụp bác sĩ mặc blouse trắng hoặc trang phục phẫu thuật, tỷ lệ 1:1 hoặc chân dung chuyên nghiệp.
  - **Hộp thông tin chuyên môn (MEDIORA Clinical Info)**:
    - *Chức danh / Học vị*: VD `Thạc sĩ - Bác sĩ Chuyên khoa II`.
    - *Chuyên khoa chính*: VD `Phẫu thuật Tạo hình & Trẻ hóa vi phẫu GMISS`.
    - *Số năm kinh nghiệm*: VD `16+ năm kinh nghiệm`.
    - *Số chứng chỉ hành nghề (CCHN)*: VD `012345/BYT-CCHN`.

---

## 8. Kết Nối Form Đặt Lịch Tư Vấn

Theme hỗ trợ 2 giải pháp form đặt lịch:

### Giải pháp 1: Form AJAX bảo mật tích hợp sẵn (Mặc định - Khuyên dùng)
- Theme đã lập trình sẵn module AJAX booking bảo mật cao tại `inc/ajax-booking.php` và template `template-parts/booking-form.php`.
- Khách hàng điền thông tin (Họ tên, Số điện thoại, Dịch vụ quan tâm, Khung giờ mong muốn, Ghi chú tình trạng).
- Dữ liệu được gửi qua AJAX mượt mà, thông báo trạng thái tức thì không cần tải lại trang.
- Đơn đăng ký tự động lưu trữ bảo mật trong cơ sở dữ liệu (`wp_options` key `mediora_leads_log`) và gửi email thông báo trực tiếp đến quản trị viên website (`admin_email`).

### Giải pháp 2: Sử dụng Plugin ngoài (Contact Form 7 / WPForms)
Nếu bạn muốn sử dụng plugin tạo form chuyên dụng:
1. Cài đặt và kích hoạt plugin **Contact Form 7** hoặc **WPForms**.
2. Tạo form mới với các trường tương ứng.
3. Sao chép mã Shortcode của form (ví dụ: `[contact-form-7 id="123" title="Form Tư Vấn"]`).
4. Truy cập **Giao diện -> Tùy biến -> Thông tin phòng khám & Pháp lý** -> Dán shortcode vào ô **Shortcode form đặt lịch thay thế**.
5. Nhấn **Đăng** (*Publish*). Khối đăng ký và modal popup trên website sẽ tự động chuyển sang hiển thị form plugin của bạn.

---

## 9. Cấu Trúc Mã Nguồn Giao Diện

```
mediora-clinic/
├── 404.php                     # Trang thông báo lỗi 404 sang trọng
├── archive.php                 # Trang lưu trữ danh mục bài viết / taxonomy
├── footer.php                  # Chân trang chuẩn pháp lý y tế, hotline nổi, modal tư vấn
├── front-page.php              # Trang chủ landing page 7 sections chuẩn MEDIORA
├── functions.php               # Khởi tạo theme, enqueues, cấu hình hỗ trợ
├── header.php                  # Đầu trang, thanh bar hotline, menu điều hướng
├── index.php                   # Trang danh sách bài viết blog
├── page.php                    # Giao diện hiển thị trang tĩnh mặc định
├── page-about.php              # Template chuyên biệt: Về Chúng Tôi (Triết lý & Bác sĩ)
├── page-contact.php            # Template chuyên biệt: Liên Hệ (Bản đồ Google Maps & CSVC)
├── page-services.php           # Template chuyên biệt: Danh Mục Dịch Vụ Thẩm Mỹ
├── screenshot.png              # Ảnh chụp giao diện xem trước trong WP Admin
├── single.php                  # Chi tiết bài viết tin tức y khoa
├── single-service.php          # Chi tiết dịch vụ thẩm mỹ chuyên sâu (Layout 2 cột)
├── style.css                   # Định nghĩa metadata của Theme
├── assets/
│   ├── css/
│   │   ├── bootstrap-grid.min.css # Lưới layout 12 cột chuẩn nhẹ
│   │   ├── swiper-bundle.min.css  # Thư viện slider quốc tế
│   │   └── theme-style.css        # Toàn bộ CSS phong cách sang trọng MEDIORA
│   ├── js/
│   │   ├── swiper-bundle.min.js   # Script điều khiển trình diễn slider
│   │   └── theme-main.js          # Khởi tạo Swiper, Lazy-load Video, Form AJAX
│   └── imgs/                      # Tài nguyên ảnh banner, icon SVG/PNG chính hãng
├── demo-data/
│   └── sample-data.xml            # Dữ liệu mẫu WordPress WXR 1.2
├── inc/
│   ├── ajax-booking.php           # Xử lý logic đặt lịch AJAX và lưu trữ Lead
│   ├── customizer.php             # Tùy biến thông tin qua WP Customizer
│   ├── post-types.php             # Đăng ký CPT Service & Doctor kèm Meta box
│   └── template-tags.php          # Hàm bổ trợ: SEO Meta, Breadcrumb, Schema JSON-LD
└── template-parts/
    └── booking-form.php           # Giao diện thành phần Form Đăng Ký Tư Vấn
```

---

## 10. Tiêu Chuẩn Kỹ Thuật & Hiệu Năng

- **W3C Valid HTML5 / CSS3**: Mã nguồn tuân thủ nghiêm ngặt các tiêu chuẩn web hiện đại.
- **WordPress VIP Guidelines**: Toàn bộ dữ liệu nhập xuất đều được lọc an toàn qua `esc_html()`, `esc_attr()`, `esc_url()`, `sanitize_text_field()`, `wp_verify_nonce()`.
- **PHP 8.3 Ready**: Kiểm thử cú pháp `php -l` đạt tỷ lệ 100% không cảnh báo, tương thích ngược đến PHP 7.4.
- **Mobile First Responsive**: Tương thích mượt mà trên tất cả kích thước màn hình từ Smartphone (320px), Tablet (768px), Laptop đến Màn hình 4K (Ultra HD).

---

*Mọi thắc mắc kỹ thuật hoặc hỗ trợ triển khai, vui lòng liên hệ đội ngũ kỹ thuật MEDIORA.*
