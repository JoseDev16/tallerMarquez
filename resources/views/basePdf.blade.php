<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <title>@yield('titulo')</title>
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
      integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
   <style>
      @page {
         margin: 0cm 0cm 0cm;
      }
      body {
         margin: 2cm 1.5cm 1.5cm;
      }
   </style>
</head>

<body>
   <main>
      <div class="container" style="font-size: 0.9em">
         <p style="text-align: center; margin: 0px;"><strong>TALLER DE SERVICIO MARQUEZ</strong></p>
         <p style="text-align: center; margin: 0px;"><strong>SISTEMA DE ADMINISTRACION GENERAL</strong></p>
         <p style="text-align: center; margin: 0px;"><strong>@yield('titulo_reporte')</strong>
         </p>
         @yield('content')
      </div>
   </main>
</body>

</html>