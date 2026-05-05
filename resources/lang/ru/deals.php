<?php

return [

    'title' => 'Сделки',

    'fields' => [
        'name' => 'Название сделки',
        'amount' => 'Сумма',
    ],

    'actions' => [
        'add' => 'Добавить',
    ],

    'pages' => [
        'create' => 'Добавить сделку',
        'board' => 'Канбан сделок',
    ],

    'statuses' => [
        'new' => 'Новая',
        'in_progress' => 'В работе',
        'won' => 'Закрыта',
        'lost' => 'Отменена',
    ],

    'stats' => [
        'won' => 'Закрыта',
        'pipeline' => 'В работе',
    ],

    'filters' => [
        'search_placeholder' => 'Поиск сделки...',
        'min' => 'Мин',
        'max' => 'Макс',
    ],

    'empty' => [
        'list' => 'Нет сделок',
        'notes' => 'Нет заметок',
    ],

];
