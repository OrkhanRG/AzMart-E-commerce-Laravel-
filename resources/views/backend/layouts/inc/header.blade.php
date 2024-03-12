<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>@yield('title')</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{ asset('backend/vendors/feather/feather.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/vendors/ti-icons/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/vendors/css/vendor.bundle.base.css') }}">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="{{ asset('backend/vendors/datatables.net-bs4/dataTables.bootstrap4.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/vendors/ti-icons/css/themify-icons.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/js/select.dataTables.min.css') }}">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="{{ asset('backend/css/vertical-layout-light/style.css') }}">

    <link rel="stylesheet" href="{{ asset('backend/css/alertify.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('backend/css/alertify-bootstrap.min.css') }}" />

    <!-- endinject -->
    <link rel="shortcut icon" href="{{ asset('backend/images/favicon.png') }}" />



    @yield('css')
</head>
<body>
<div class="container-scroller">
