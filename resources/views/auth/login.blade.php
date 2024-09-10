<!doctype html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>{{ config('app.name') }} - Login</title>
{{--      <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests" />--}}

{{--      <link rel="android-chrome" sizes="512x512" href="{{ asset('assets/icons/android-chrome-512x512.png') }}">--}}
{{--      <link rel="apple-touch-icon" sizes="512x512" href="{{ asset('assets/icons/apple-touch-icon.png') }}">--}}
{{--      <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/icons/favicon-32x32.png') }}">--}}
{{--      <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/icons/favicon-16x16.png') }}">--}}
      <link rel="manifest" href="{{ asset('assets/site.manifest') }}">
      <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.css') }}">
      <link rel="stylesheet" href="{{ asset('assets/fontawesome/css/all.min.css') }}">
      <link rel="stylesheet" href="{{ asset('assets/css/_login.css') }}">

   </head>
   <body>
   <div class="container-fluid mt-3">
       <div class="shadow-llx rounded center-block">
           <div class="card border-0 p-5" style="width: 55rem">
               <div class="row g-0">
                   <div class="col-6">
                       <div class="card-body">
                           <form action="{{ route('login') }}" class="mx-auto" method="POST">
                               <div class="text-start">
                                   <h2>Sign in</h2>
                                   <p class="fs-15">{{ config('app.name') }} | For Construction department</p>
                               </div>
                               @csrf
                               <div class="row mt-4">
                                   @if($errors->any())
                                       <p class="mb-0 font-500 text-danger">{!! $errors->first('message') !!}</p>
                                   @endif
                                   <div class="col-10">
                                       <div class="form-group mb-3">
                                           <label class="form-label">Username</label>
                                           <input type="text" name="username" class="form-control">
                                       </div>
                                       <div class="form-group mb-3">
                                           <label class="form-label">Password</label>
                                           <input type="password" class="form-control" name="password">
                                       </div>
                                   </div>
                               </div>
                               <button class="btn btn-danger-d w-8 btn-lg font-500 mt-3" type="submit">Sign in</button>
                           </form>
                       </div>
                   </div>
                   <div class="col-6">
                       <img class="img-fluid ms-5 mt-4" style="width: 85%" src="{{ asset('assets/img/logo-etc.png') }}" alt="Logo"/>
                   </div>
               </div>
           </div>
       </div>
   </div>
      <script src="{{ asset('assets/js/jquery3.7.js') }}"></script>
      <script>
         $('input[name="username"]').on('input', function() {
             $(this).removeClass('is-invalid');
             $('.js_class_login').addClass('d-none');
         });

         $('input[name="password"]').on('input', function() {
             $(this).removeClass('is-invalid');
             $('.js_class_password').addClass('d-none');
         });
      </script>
   </body>
