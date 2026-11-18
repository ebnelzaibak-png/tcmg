# ملفات الاستبدال

الملفات هنا نسخ كاملة منفصلة عن الصفحات الأصلية، ومقسمة إلى نسختين:

- `static/`: صفحات HTML التي كانت في جذر المشروع، مع `figma-replacement.css` و`tcmg-theme.js`.
- `laravel/resources/views/`: قوالب Blade كاملة، مع `partials/topbar.blade.php`.
- `laravel/public/css/figma-replacement.css`: الثيم المشترك لقوالب Laravel.

## الاستبدال

لصفحات HTML، انسخ ملفات `.html` إلى جذر المشروع، وانسخ `figma-replacement.css` و`tcmg-theme.js` إلى المجلد نفسه.

لـLaravel، انسخ ملفات Blade إلى `tcmg-laravel/resources/views/`، ومجلد `partials` إلى `resources/views/partials/`، وملف CSS إلى `tcmg-laravel/public/css/`.

النسخة الثابتة تحتفظ ببيانات العرض التجريبية الموجودة في صفحات HTML. صفحات Laravel تحتفظ بمسارات النماذج وبيانات قاعدة البيانات.
