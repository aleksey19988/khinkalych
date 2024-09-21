@extends('layouts.app')

@section('title', $title)

@section('content')
    <x-section-header :title="$title"/>
    <x-utility.utility-button :route="route('utilities.statistics.index')" :title="'Моя статистика'"/>
    <x-utility.utility-button :route="route('utilities.check-seals.index')" :title="'Проверить кол-во печатей'"/>
    <x-utility.utility-button :route="route('utilities.guest-edit.index')" :title="'Редактировать данные о госте'"/>
@endsection
