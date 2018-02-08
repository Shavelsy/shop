<?php
/**
 * Created by PhpStorm.
 * User: Vladislav
 * Date: 30.01.2018
 * Time: 20:38
 */

return array(
    // Товар:
    'product/([0-9]+)' => 'product/view/$1',
    // Каталог:
    'catalog' => 'catalog/index',
    // Категории:
    'category/([0-9]+)/page-([0-9]+)' => 'catalog/category/$1/$2',
    'category/([0-9]+)' => 'catalog/category/$1',
    // Пользователь:
    'user/register' => 'user/register',
    'user/login' => 'user/login',
    'user/logout' => 'user/logout',
    'user/history' => 'user/history',
    // Кабинет пользователя:
    'cabinet/edit' => 'cabinet/edit',
    'cabinet' => 'cabinet/index',
    // Корзина:
    'cart/delete/([0-9]+)' => 'cart/delete/$1',
    'cart/add/([0-9]+)' => 'cart/add/$1',
    'cart/checkout' => 'cart/checkout',
    'cart' => 'cart/index',
    // Управление товарами:
    'admin/product/create' => 'adminProduct/create',
    'admin/product/update/([0-9]+)' => 'adminProduct/update/$1',
    'admin/product/delete/([0-9]+)' => 'adminProduct/delete/$1',
    'admin/product' => 'adminProduct/index',
    // Управление категориями:
    'admin/category/create' => 'adminCategory/create',
    'admin/category/update/([0-9]+)' => 'adminCategory/update/$1',
    'admin/category/delete/([0-9]+)' => 'adminCategory/delete/$1',
    'admin/category' => 'adminCategory/index',
    // Управление заказами:
    'admin/order/update/([0-9]+)' => 'adminOrder/update/$1',
    'admin/order/delete/([0-9]+)' => 'adminOrder/delete/$1',
    'admin/order/view/([0-9]+)' => 'adminOrder/view/$1',
    'admin/order' => 'adminOrder/index',
    // Админпанель
    'admin' => 'admin/index',
    // О магазине
    'about' => 'site/about',
    // Главная страница сайта
    '' => 'site/index'
);