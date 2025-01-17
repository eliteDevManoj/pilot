<!DOCTYPE html>
<html class="h-full" data-theme="true" data-theme-mode="light" lang="en">
 
<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<head>
  <title>
   Metronic
  </title>
  <meta charset="utf-8"/>
  <meta content="follow, index" name="robots"/>
  <link href="https://keenthemes.com/metronic" rel="canonical"/>
  <meta content="width=device-width, initial-scale=1, shrink-to-fit=no" name="viewport"/>
  <meta content="Sign in page using Tailwind CSS" name="description"/>
  <meta content="@keenthemes" name="twitter:site"/>
  <meta content="@keenthemes" name="twitter:creator"/>
  <meta content="summary_large_image" name="twitter:card"/>
  <meta content="Metronic - Tailwind CSS Sign In" name="twitter:title"/>
  <meta content="Sign in page using Tailwind CSS" name="twitter:description"/>
  <meta content="resources/media/app/og-image.png" name="twitter:image"/>
  <meta content="https://keenthemes.com/metronic" property="og:url"/>
  <meta content="en_US" property="og:locale"/>
  <meta content="website" property="og:type"/>
  <meta content="@keenthemes" property="og:site_name"/>
  <meta content="Metronic - Tailwind CSS Sign In" property="og:title"/>
  <meta content="Sign in page using Tailwind CSS" property="og:description"/>
  <meta content="../../resources/media/app/og-image.png" property="og:image"/>
  <link href="../../resources/media/app/apple-touch-icon.png" rel="apple-touch-icon" sizes="180x180"/>
  <link href="../../resources/media/app/favicon-32x32.png" rel="icon" sizes="32x32" type="image/png"/>
  <link href="../../resources/media/app/favicon-16x16.png" rel="icon" sizes="16x16" type="image/png"/>
  <link href="https://keenthemes.com/static/metronic/tailwind/dist/assets/media/app/favicon.ico" rel="shortcut icon"/>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&amp;display=swap" rel="stylesheet"/>
  <link href="../../resources/vendors/apexcharts/apexcharts.css" rel="stylesheet"/>
  <link href="../../resources/vendors/keenicons/styles.bundle.css" rel="stylesheet"/>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" rel="stylesheet" />
  <link href="../../resources/css/styles.css" rel="stylesheet"/>
  <!-- Google tag (gtag.js) -->
  <script async="" src="https://www.googletagmanager.com/gtag/js?id=UA-37564768-1">
  </script>
  <script>
   window.dataLayer = window.dataLayer || [];
	function gtag(){dataLayer.push(arguments);}
	gtag('js', new Date());
	gtag('config', 'UA-37564768-1');
  </script>
 </head>
 <body class="flex h-full dark:bg-coal-500">
  <!--begin::Theme mode setup on page load-->
  <script>
   const defaultThemeMode = 'light'; // light|dark|system
		let themeMode;

		if ( document.documentElement ) {
			if ( localStorage.getItem('theme')) {
					themeMode = localStorage.getItem('theme');
			} else if ( document.documentElement.hasAttribute('data-theme-mode')) {
				themeMode = document.documentElement.getAttribute('data-theme-mode');
			} else {
				themeMode = defaultThemeMode;
			}

			if (themeMode === 'system') {
				themeMode = window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light';
			}

			document.documentElement.classList.add(themeMode);
		}
  </script>
  <!--end::Theme mode setup on page load-->
  <!--begin::Page layout-->
  <style>
   .page-bg {
			background-image: url('../../resources/media/images/2600x1200/bg-10.png');
		}
		.dark .page-bg {
			background-image: url('../../resources/media/images/2600x1200/bg-10-dark.png');
		}
  </style>
  <div class="flex items-center justify-center grow bg-center bg-no-repeat page-bg">
   <div class="card max-w-[370px] w-full">
    <form action="/login" class="card-body flex flex-col gap-5 p-10" id="sign_in_form" method="post">
    <input type="hidden" name="login" value="login"> 
    <div class="text-center mb-2.5">
      <h3 class="text-lg font-semibold text-gray-900 leading-none mb-2.5">
       Sign in
      </h3>
      <div class="flex items-center justify-center font-medium">
       <span class="text-2sm text-gray-600 me-1.5">
        Need an account?
       </span>
       <a class="text-2sm link" href="/register">
        Sign up
       </a>
      </div>
     </div>
     <div class="grid grid-cols-2 gap-2.5">
      <a class="btn btn-light btn-sm justify-center" href="#">
       <img alt="" class="size-3.5 shrink-0" src="https://keenthemes.com/static/metronic/tailwind/dist/assets/media/brand-logos/google.svg"/>
       Use Google
      </a>
      <a class="btn btn-light btn-sm justify-center" href="#">
       <img alt="" class="size-3.5 shrink-0 dark:hidden" src="https://keenthemes.com/static/metronic/tailwind/dist/assets/media/brand-logos/apple-black.svg"/>
       <img alt="" class="size-3.5 shrink-0 light:hidden" src="https://keenthemes.com/static/metronic/tailwind/dist/assets/media/brand-logos/apple-white.svg"/>
       Use Apple
      </a>
     </div>
     <div class="flex items-center gap-2">
      <span class="border-t border-gray-200 w-full">
      </span>
      <span class="text-2xs text-gray-500 font-medium uppercase">
       Or
      </span>
      <span class="border-t border-gray-200 w-full">
      </span>
     </div>
     <div class="flex flex-col gap-1">
      <label class="form-label text-gray-900">
       Email
      </label>
      <input  name = "user_email" class="input" placeholder="email@email.com" type="text" value=""/>
     </div>
     <div class="flex flex-col gap-1">
      <div class="flex items-center justify-between gap-1">
       <label class="form-label text-gray-900">
        Password
       </label>
       <a class="text-2sm link shrink-0" href="reset-password/enter-email/index.html">
        Forgot Password?
       </a>
      </div>
      <label class="input" data-toggle-password="true">
       <input name="user_password" placeholder="Enter Password" type="password" value=""/>
       <button type="button" class="btn btn-icon" data-toggle-password-trigger="true">
        <i class="ki-filled ki-eye text-gray-500 toggle-password-active:hidden">
        </i>
        <i class="ki-filled ki-eye-slash text-gray-500 hidden toggle-password-active:block">
        </i>
       </button>
      </label>
     </div>
     <label class="checkbox-group">
      <input class="checkbox checkbox-sm" name="check" type="checkbox" value="1"/>
      <span class="checkbox-label">
       Remember me
      </span>
     </label>
     <button class="btn btn-primary flex justify-center grow" type="submit">
      Sign In
     </button>
    </form>
   </div>
  </div>
  <!--end::Page layout-->
  <!--begin::Page scripts-->
  <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js" ></script>
  <script src="../../resources/js/core.bundle.js">
  </script>
  <script src="../../resources/vendors/apexcharts/apexcharts.min.js">
  </script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

  <?php 
    if(isset($_SESSION['success_msg'])){
      ?>

      <script>

        var success_msg = '<?= $_SESSION['success_msg'];?>'
        toastr.success(success_msg);
      </script>
      
      <?php

      unset($_SESSION['success_msg']);
    }

    if(isset($_SESSION['error_msg'])){
    ?>
      
      <script>

        var error_msg = '<?= $_SESSION['error_msg'];?>'
        toastr.error(error_msg);

      </script>

    <?php

      unset($_SESSION['error_msg']);
    }
  ?>
  <!--end::Page scripts-->
 </body>

</html>