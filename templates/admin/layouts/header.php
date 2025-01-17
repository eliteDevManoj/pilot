<?php
if(!isset($_SESSION)) 
{ 
  session_start(); 
} 

?>
<!DOCTYPE html>
<html class="h-full" data-theme="true" data-theme-mode="light" lang="en">
<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<head>
  <title>
   Metronic - Tailwind CSS Settings - Plain
  </title>
  <meta charset="utf-8"/>
  <meta content="follow, index" name="robots"/>
  <link href="https://keenthemes.com/metronic" rel="canonical"/>
  <meta content="width=device-width, initial-scale=1, shrink-to-fit=no" name="viewport"/>
  <meta content="Plain settings page, styled with Tailwind CSS" name="description"/>
  <meta content="@keenthemes" name="twitter:site"/>
  <meta content="@keenthemes" name="twitter:creator"/>
  <meta content="summary_large_image" name="twitter:card"/>
  <meta content="Metronic - Tailwind CSS Settings - Plain" name="twitter:title"/>
  <meta content="Plain settings page, styled with Tailwind CSS" name="twitter:description"/>
  <meta content="/static/metronic/tailwind/dist/assets/media/app/og-image.png" name="twitter:image"/>
  <meta content="https://keenthemes.com/metronic" property="og:url"/>
  <meta content="en_US" property="og:locale"/>
  <meta content="website" property="og:type"/>
  <meta content="@keenthemes" property="og:site_name"/>
  <meta content="Metronic - Tailwind CSS Settings - Plain" property="og:title"/>
  <meta content="Plain settings page, styled with Tailwind CSS" property="og:description"/>
  <meta content="/media/app/og-image.png" property="og:image"/>
  <link href="../../../resources/media/app/apple-touch-icon.png" rel="apple-touch-icon" sizes="180x180"/>
  <link href="../../../resources/media/app/favicon-32x32.png" rel="icon" sizes="32x32" type="image/png"/>
  <link href="../../../resources/media/app/favicon-16x16.png" rel="icon" sizes="16x16" type="image/png"/>
  <link href="https://keenthemes.com/static/metronic/tailwind/dist/assets/media/app/favicon.ico" rel="shortcut icon"/>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&amp;display=swap" rel="stylesheet"/>
  <link href="../../../resources/vendors/apexcharts/apexcharts.css" rel="stylesheet"/>
  <link href="../../../resources/vendors/keenicons/styles.bundle.css" rel="stylesheet"/>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" rel="stylesheet" />
  <link href="../../../resources/css/styles.css" rel="stylesheet"/>
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
 <body class="flex h-full demo1 sidebar-fixed header-fixed bg-[#fefefe] dark:bg-coal-500">
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