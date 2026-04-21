FROM php:8.3-apache

# 1. ติดตั้ง Extension ที่จำเป็นสำหรับ PHP ในการเชื่อมต่อ MySQL
RUN docker-php-ext-install pdo pdo_mysql

# 2. เปิดใช้งาน mod_rewrite ของ Apache เพื่อให้ .htaccess ในโฟลเดอร์ public ทำงานได้
RUN a2enmod rewrite

# 3. เปลี่ยน Document Root ให้ชี้ไปที่โฟลเดอร์ public
RUN sed -i '/<Directory \/var\/www\/>/,/<\/Directory>/ s/AllowOverride None/AllowOverride All/' /etc/apache2/apache2.conf
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/000-default.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf

# 4. ตั้งค่าสิทธิ์การเข้าถึงไฟล์
RUN chown -R www-data:www-data /var/www/html