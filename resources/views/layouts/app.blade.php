<!--
* Copyright 2016 Carlos Eduardo Alfaro Orellana
-->
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Home</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/sweetalert2.css">
    <link rel="stylesheet" href="css/material.min.css">
    <link rel="stylesheet" href="css/material-design-iconic-font.min.css">
    <link rel="stylesheet" href="css/jquery.mCustomScrollbar.css">
    <link rel="stylesheet" href="css/main.css">
    <script src="{{ asset('js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    {{-- <script>
        window.jQuery || document.write('<script src="js/jquery-1.11.2.min.js"><\/script>')
    </script> --}}
    {{-- <script src="{{ asset('js/material.min.js') }}"></script> --}}
    <script src="js/jquery.mCustomScrollbar.concat.min.js"></script>
    <script src="js/main.js"></script>
    {{-- <script src="js/sweetalert2.min.js"></script> --}}

</head>

<body>
    @include('layouts.notificaction')
    @include('layouts.header')
    @include('layouts.sidebar')
    <section class="full-width pageContent">
        <section class="full-width text-center" style="padding: 40px 0;">
            {{ $slot }}
        </section>
    </section>
    @livewireScripts
    <script src="https://cdn.jsdelivr.net/gh/livewire/turbolinks@v0.1.x/dist/livewire-turbolinks.js"
        data-turbolinks-eval="true" data-turbo-eval="true"></script>

    <script src="js/sweetalert2.all.min.js"></script>
</body>
<script>
    $(document).ready(function() {
        /*Mostrar ocultar area de notificaciones*/
        $('.btn-Notification').on('click', function() {
            var ContainerNoty = $('.container-notifications');
            var NotificationArea = $('.NotificationArea');
            if (NotificationArea.hasClass('NotificationArea-show') && ContainerNoty.hasClass(
                    'container-notifications-show')) {
                NotificationArea.removeClass('NotificationArea-show');
                ContainerNoty.removeClass('container-notifications-show');
            } else {
                NotificationArea.addClass('NotificationArea-show');
                ContainerNoty.addClass('container-notifications-show');
            }
        });
        /*Mostrar ocultar menu principal*/
        $('.btn-menu').on('click', function() {
            var navLateral = $('.navLateral');
            var pageContent = $('.pageContent');
            var navOption = $('.navBar-options');
            if (navLateral.hasClass('navLateral-change') && pageContent.hasClass(
                'pageContent-change')) {
                navLateral.removeClass('navLateral-change');
                pageContent.removeClass('pageContent-change');
                navOption.removeClass('navBar-options-change');
            } else {
                navLateral.addClass('navLateral-change');
                pageContent.addClass('pageContent-change');
                navOption.addClass('navBar-options-change');
            }
        });
        /*Salir del sistema*/
        $('.btn-exit').on('click', function() {
            new swal({
                title: 'You want out of the system?',
                text: "The current session will be closed and will leave the system",
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, exit',
                closeOnConfirm: false
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById("logoutForm").submit();
                }
            })
        });
        /*Mostrar y ocultar submenus*/
        $('.btn-subMenu').on('click', function() {
            var subMenu = $(this).next('ul');
            var icon = $(this).children("span");
            if (subMenu.hasClass('sub-menu-options-show')) {
                subMenu.removeClass('sub-menu-options-show');
                icon.addClass('zmdi-chevron-left').removeClass('zmdi-chevron-down');
            } else {
                subMenu.addClass('sub-menu-options-show');
                icon.addClass('zmdi-chevron-down').removeClass('zmdi-chevron-left');
            }
        });
    });
</script>
<style>
    *,
    html {
        font-size: 14px;
    }

</style>

</html>
