<?php
/*
 * CamperManagement
 *
 * Copyright 2011 by Mark Hamstra <business@markhamstra.nl>
 *
 * This file is part of CamperManagement, a camper/caravan inventory management
 * addon for MODX Revolution.
 *
 * CamperManagement is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License as published by the Free Software
 * Foundation; either version 2 of the License, or (at your option) any later
 * version.
 *
 * CamperManagement is distributed in the hope that it will be useful, but WITHOUT ANY
 * WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR
 * A PARTICULAR PURPOSE. See the GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License along with
 * CamperManagement; if not, write to the Free Software Foundation, Inc., 59 Temple Place,
 * Suite 330, Boston, MA 02111-1307 USA
 *
 */

$_lang['campermgmt'] = 'Кемпер - Управление';
$_lang['campermgmt.description'] = 'Кемпер &amp; Караван - Управление товарами в наличии.';
$_lang['campermgmt.campers'] = 'Кемперы &amp; Караваны';
$_lang['campermgmt.camper'] = 'Кемпер';
$_lang['campermgmt.camper.new'] = 'Добавить новый кемпер или караван';
$_lang['campermgmt.camper.delete'] = 'Удалить кемпер';
$_lang['campermgmt.camper.confirmdelete'] = '<p>Вы уверены в том, что хотите удалить этот кемпер из системы? <span style="color: #ff0000">Это действие НЕОБРАТИМО!</span></p><p>Выберите Сохранить (Save), чтобы удалить этот транспорт.</p>';
$_lang['campermgmt.owners'] = 'Владельцы';
$_lang['campermgmt.owner'] = 'Владелец';
$_lang['campermgmt.owner.new'] = 'Добавить нового владельца';
$_lang['campermgmt.owner.new.or'] = '... или';
$_lang['campermgmt.options'] = 'Опции';
$_lang['campermgmt.option'] = 'Опция';
$_lang['campermgmt.option.new'] = 'Добавить новую опцию';
$_lang['campermgmt.brands'] = 'Бренды';
$_lang['campermgmt.brand'] = 'Бренд';
$_lang['campermgmt.brand.new'] = 'Добавить новый бренд';
$_lang['campermgmt.name'] = 'Имя';
$_lang['campermgmt.images'] = 'Изображения';
$_lang['campermgmt.image'] = 'Изображение';
$_lang['campermgmt.image.rank'] = 'Порядок';
$_lang['campermgmt.image.upload'] = 'Загрузить новые изображения';
$_lang['campermgmt.image.requiressave'] = 'Загрузить изображения можно только после того, как сохранён в первый раз транспорт.';
$_lang['campermgmt.campersaved'] = 'Транспорт успешно сохранён.';
$_lang['campermgmt.error.undefined'] = 'Что-то пошло не так.';
$_lang['campermgmt.error.missingrequired'] = 'Пожалуйста, заполните все необходимые поля в этой форме.';
$_lang['campermgmt.error.noid'] = 'Не найден ни один ID.';
$_lang['campermgmt.error.id_invalid'] = 'Неправильный ID транспорта.';
$_lang['campermgmt.error.status_nf'] = 'Не найден новый статус.';
$_lang['campermgmt.error.camper_nf'] = 'Транспорт с ID [[+id]] не найден.';
$_lang['campermgmt.error.image_nf'] = 'Изображение с ID [[+id]] не найдено.';
$_lang['campermgmt.error.option_nf'] = 'Опция с ID [[+id]] не найдена.';
$_lang['campermgmt.error.brand_nf'] = 'Бренд с ID [[+id]] не найден.';
$_lang['campermgmt.error.brand_invalid'] = 'Найден неправильный бренд. Вы точно правильно ввели поле?';
$_lang['campermgmt.error.brand_undefined'] = 'Что-то пошло не так при сохранении бренда.';
$_lang['campermgmt.error.select_image'] = 'Пожалуйста выберите изображение перед правым кликом.';
$_lang['campermgmt.button.backtooverview'] = 'Назад к просмотру';
$_lang['campermgmt.title.edit'] = 'Редактировать транспорт';
$_lang['campermgmt.title.new'] = 'Создать новый транспорт';
$_lang['campermgmt.tab.general'] = 'Общее';
$_lang['campermgmt.tab.vehicle'] = 'Хар-ки транспорта';
$_lang['campermgmt.tab.options'] = $_lang['campermgmt.options'];
$_lang['campermgmt.tab.images'] = 'Изображения';
$_lang['campermgmt.status'] = 'Статус';
$_lang['campermgmt.added'] = 'Добавлен';
$_lang['campermgmt.archived'] = 'Заархивирован';
$_lang['campermgmt.status.edit'] = 'Обновить статус';
$_lang['campermgmt.status0'] = 'Не подтверждён';
$_lang['campermgmt.status1'] = 'Активный';
$_lang['campermgmt.status2'] = 'В закладки';
$_lang['campermgmt.status3'] = 'Условно продан';
$_lang['campermgmt.status4'] = 'Продан';
$_lang['campermgmt.status5'] = 'Неактивен';
$_lang['campermgmt.field.price'] = 'Цена (в &euro;)';
$_lang['campermgmt.field.key'] = 'Ключ';
$_lang['campermgmt.field.remarks'] = 'Замечания';
$_lang['campermgmt.field.type'] = 'Тип';
$_lang['campermgmt.field.plate'] = 'Номер';
$_lang['campermgmt.field.car'] = 'Машина';
$_lang['campermgmt.field.engine'] = 'Двигатель';
$_lang['campermgmt.field.manufactured'] = 'Производитель';
$_lang['campermgmt.field.beds'] = 'Кровати';
$_lang['campermgmt.field.weight'] = 'Вес';
$_lang['campermgmt.field.mileage'] = 'Пробег';
$_lang['campermgmt.field.periodiccheck'] = 'Периодическая проверка';
$_lang['campermgmt.field.id'] = '#';
$_lang['campermgmt.field.firstname'] = 'Имя';
$_lang['campermgmt.field.lastname'] = 'Фамилия';
$_lang['campermgmt.field.address'] = 'Адресс';
$_lang['campermgmt.field.city'] = 'Город';
$_lang['campermgmt.field.postal'] = 'Почтовый адрес';
$_lang['campermgmt.field.email'] = 'Email';
$_lang['campermgmt.field.phone1'] = 'Телефон (1)';
$_lang['campermgmt.field.phone2'] = 'Телефон (2)';
$_lang['campermgmt.field.country'] = 'Страна';
$_lang['campermgmt.field.country.default'] = 'Украина';
$_lang['campermgmt.field.bank'] = 'Банк';
$_lang['campermgmt.ctxmenu1'] = 'Создание окна листа';
$_lang['campermgmt.ctxmenu2'] = 'Создание контракта';
$_lang['campermgmt.overview'] = 'Создание списка характеристик';
$_lang['campermgmt.showarchived'] = 'Показать заархивированный транспорт';
$_lang['campermgmt.hidearchived'] = 'Показать активный транспорт';


?>
