<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## О приложении

Данное приложение представляет собой блог с возможностью регистрации и добавления новых постов. Приложение делится на 2 больших блока: админская часть и пользовательская часть.

## Админская часть

Для написания админской части использовался шаблон Bootstrap [AdminLTE](https://adminlte.io/):

<p align="center"><img src="https://drive.google.com/uc?export=view&id=13yG-xsgplxQV1hC2urNj8xRZ0t7b9KAl" alt=""></p>

Панель администратора позволяет управлять 4 сущностями: теги, администраторы, посты и категории. Все сущности выводятся в виде таблицы jQuery [DataTables](https://datatables.net/) с применением библиотеки для Laravel [yajra/datatables](https://github.com/yajra/laravel-datatables), что позволяет осуществлять поиск и фильтрацию по свойствам модели:

<p align="center"><img src="https://drive.google.com/uc?export=view&id=1byDUEJXZIQNR1CxlFVvDHVLfeeurznfI" alt=""></p>

Для загрузки изображения поста в форму использовалась библиотека jQuery [Dropify](https://github.com/JeremyFagis/dropify):

<p align="center"><img src="https://drive.google.com/uc?export=view&id=1GrjbIVNXmdAGLIt707hlRTjri3xM3_6e" alt=""></p>

Для авторизации администратора был создан отдельный guard, модель Admin и таблица admins в БД.

## Пользовательская часть

Для написания пользовательской части использовался шаблон [Templatemo](https://templatemo.com/):

<p align="center"><img src="https://drive.google.com/uc?export=view&id=1_90j_SXxVDOS5tB1f3z5QSPqljOPe8-6" alt=""></p>

### Поиск

Поиск по статьям осуществляется по вхождению искомого выражения в заголовок или тело статьи:

<p align="center"><img src="https://drive.google.com/uc?export=view&id=1OIcRlgyk6L-LkdMJLp1QksavwqMVq4Jg" alt=""></p>

Кроме того, поиск по статьям осуществляется по категориям и тегам:

<p align="center"><img src="https://drive.google.com/uc?export=view&id=1P3CXefKxqexohaGhTi8tGMCVOqmPABem" alt=""></p>

<p align="center"><img src="https://drive.google.com/uc?export=view&id=1wN6o5XW-u9LH54BNChsLf0D3NfwkZyDR" alt=""></p>

### Модель Post

В пользовательской части приложения модель Post вытаскивается из БД по уникальному полю slug, который формируется на основе title поста с помощью библиотеки [cviebrock/eloquent-sluggable](https://github.com/cviebrock/eloquent-sluggable). Функционал количества просмотров постов реализован с помощью библиотеки [cyrildewit/eloquent-viewable](https://github.com/cyrildewit/eloquent-viewable). Для оптимизации приложения данная библиотека позволяет кэшировать просмотры на заданное время:

<p align="center"><img src="https://drive.google.com/uc?export=view&id=1DTt_AqGHXwRFarDVoVWlC0PYpnCRvqhR" alt=""></p>

### Регистрация

Вновь прибывшие пользователи смогут зарегистрироваться в приложении через форму ниже. После регистрации пользователю придет письмо на указанный адрес электронной почты для ее подтверждения. В случае, если письмо не пришло, имеется ссылка для повторной отправки письма. Отправка писем происходит путем генерации соответствующих событий и их обработки слушателями. Классы писем реализуют контракт ShouldQueue, что позволяет осуществлять отправку в фоновом режиме:

<p align="center"><img src="https://drive.google.com/uc?export=view&id=1CzaWN84cqc8lmNbY8w83X6z--BNBlghE" alt=""></p>

<p align="center"><img src="https://drive.google.com/uc?export=view&id=11uUkfOMbJB1E27KRJcaTet3yrwUi2k-Y" alt=""></p>

### Аутентификация

Пользователи с подтвержденным адресом электронной почты могут авторизоваться под указанным логином и паролем. В случае, если пароль был забыт, имеется форма для восстановления пароля, ссылка на которую так же высылается на адрес электронной почты:

<p align="center"><img src="https://drive.google.com/uc?export=view&id=1Hqr2KXkksZkq9VyXiqRCbYeoVts3U6lO" alt=""></p>

<p align="center"><img src="https://drive.google.com/uc?export=view&id=1Agsmf4Lc_1Nkq7rKV3-ASDRjCb118kZT" alt=""></p>

## Авторизация

Авторизация прав пользователей осуществляется с применением политик. Таким образом, пользователь вправе удалить или отредактировать пост, который создал он сам.

## Профиль

Пользователь имеет возможность редактировать данные своего профиля: имя, адрес электронной почты и пароль:

<p align="center"><img src="https://drive.google.com/uc?export=view&id=1Yw3ibJFb28ceeM9ywieECFsd_E8KGlR7" alt=""></p>

В случае изменения пароля необходимо ввести старый пароль и придумать новый:

<p align="center"><img src="https://drive.google.com/uc?export=view&id=10KIvGLYjtFQlRI8WL_H_q9SrSb_v2quu" alt=""></p>

В случае изменения адреса электронной почты на старый адрес высылается шестизначный цифровой код, который будет активным в течение часа. Данный код необходимо ввести в соответствующую форму для завершения этапа смены адреса электронной почты:

<p align="center"><img src="https://drive.google.com/uc?export=view&id=1GrOOeobXMFDBVxzZV6aSXPDmLNwAe83J" alt=""></p>

<p align="center"><img src="https://drive.google.com/uc?export=view&id=1tf7L43e6bIJNSRz7JXLUXM_qYZQPy4f4" alt=""></p>

<p align="center"><img src="https://drive.google.com/uc?export=view&id=1SY3rBtNpC6Ln7jluIZCGrCH0OBKy1cXO" alt=""></p>

Планировщик задач, описанный в методе schedule, позволяет ежедневно очищать таблицу, шестизначные коды в которой истекли.

## Форма создания поста

Форма создания поста выглядит аналогично форме в админской части приложения:

<p align="center"><img src="https://drive.google.com/uc?export=view&id=1L6OfJFFCWL_h92HXlb8junN6dLNRWKw4" alt=""></p>

## Sidebar

Боковая панель приложения включает в себя раздел из недавних постов, списка категорий и списка тегов. Так как панель используется на большинстве страниц данные в вид передаются через view composer. Кроме того, теги и категории кэшируются на заданное время для уменьшения количества запросов к БД.
