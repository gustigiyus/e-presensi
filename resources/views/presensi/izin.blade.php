@extends('layouts.presensi')

@section('header')
    <!-- App Header -->
    <div class="appHeader bg-primary text-light">
        <div class="left">
            <a href="javascript:;" class="headerButton goBack">
                <ion-icon name="chevron-back-outline"></ion-icon>
            </a>
        </div>
        <div class="pageTitle">Data Izin / Sakit</div>
        <div class="right"></div>
    </div>
    <!-- * App Header -->
@endsection

@section('content')
    <div class="fab-button bottom-right" style="margin-bottom: 70px">
        <a href="/presensi/izinadd" class="fab">
            <ion-icon name="add-outline"></ion-icon>
        </a>
    </div>
@endsection
