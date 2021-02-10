<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RolController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\CategoriaMaterialController;
use App\Http\Controllers\ActividadController;
use App\Http\Controllers\SubCategoriaMaterialController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\ComposicionMaterialController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\VehiculoController;
use App\Http\Controllers\OrdenReparacionController;
use App\Http\Controllers\ReservaController;
use App\Http\Controllers\ImagenesPromocionController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//Route::get('/', function () {
  //  return view('inicioClientes');
//})->name('home');
Route::get('/', [ImagenesPromocionController::class, 'inicioClientes'])->name('home');

Route::middleware(['auth'])->get('/admin', function () {
    return view('inicioAdmin');
})->name('home');

Route::middleware(['auth:sanctum', 'verified'])
    ->get('/dashboard', [UserController::class, 'index'])->name('dashboard');
Route::post('/Reserva/nueva', [ReservaController::class, 'store'])->name('reserva.store');


//Rutas para usuario

Route::middleware(['auth'])->group(function () {
    //Rutas usuarios
    Route::get('/usuarios/detalle/{id}', [UserController::class, 'show'])->name('user.show')->middleware('permission:user.crear');
    Route::get('/usuarios', [UserController::class, 'index'])->name('user.index');
    Route::get('/usuarios/editar/{id}', [UserController::class, 'edit'])->name('user.edit')->middleware('permission:user.crear');
    Route::get('/usuarios/updatePassword/{id}', [UserController::class, 'getPassword'])->name('user.updatePassword')->middleware('permission:user.cambiarClave');
    Route::post('/usuarios/updatePassword/{id}', [UserController::class, 'updatePassword'])->name('user.updatePasswordPost')->middleware('permission:user.cambiarClave');
    Route::delete('Usuarios/delete', [UserController::class, 'destroy'])->name('user.delete');
    Route::post('/usuarios/update/{id}', [UserController::class, 'update'])->name('user.update')->middleware('permission:user.crear');

    Route::get('/usuarios/getroles/{id}', [UserController::class, 'getRoles'])->name('user.getRoles')->middleware('permission:user.asignarRol');
    Route::post('/usuarios/setroles', [UserController::class, 'setRoles'])->name('user.setRoles')->middleware('permission:user.asignarRol');
    Route::delete('/usuarios/detroles', [UserController::class, 'deleteRoles'])->name('user.deleteRoles')->middleware('permission:user.eliminar');


    //Rutas para ROL
    Route::get('/roles', [RolController::class, 'index'])->name('rol.index')->middleware('permission:rol.gestionRoles');
    Route::post('/roles', [RolController::class, 'index'])->name('rol.index')->middleware('permission:rol.gestionRoles');
    Route::post('/roles/store', [RolController::class, 'store'])->name('rol.store')->middleware('permission:rol.gestionRoles');
    Route::get('/roles/editar/{id}', [RolController::class, 'edit'])->name('rol.edit')->middleware('permission:rol.gestionRoles');
    Route::post('/roles/editar/update', [RolController::class, 'update'])->name('rol.update')->middleware('permission:rol.gestionRoles');
    Route::delete('roles/delete', [RolController::class, 'destroy'])->name('rol.delete')->middleware('permission:rol.gestionRoles');

    //Rutas para logs
    Route::get('/logs', [ActividadController::class, 'index'])->name('logs.index')->middleware('permission:logs.index');

    Route::middleware(['permission:categoria.gestionarCategorias'])->group(function () {
        //Rutas para CategoriaProducto
    Route::get('/CategoriaProducto', [CategoriaController::class, 'index'])->name('categoria.index')->middleware('permission:categoria.gestionarCategorias');
    Route::post('/CategoriaProducto/nueva', [CategoriaController::class, 'store'])->name('categoria.store')->middleware('permission:categoria.gestionarCategorias');
    Route::get('/CategoriaProducto/edit/{id}', [CategoriaController::class, 'edit_view'])->name('categoria.edit_view')->middleware('permission:categoria.gestionarCategorias');
    Route::post('/CategoriaProducto/edit', [CategoriaController::class, 'edit'])->name('categoria.edit')->middleware('permission:categoria.gestionarCategorias');
    Route::delete('/CategoriaProducto/delete', [CategoriaController::class, 'destroy'])->name('categoria.destroy')->middleware('permission:categoria.gestionarCategorias');
      //Rutas para CategoriaMaterial
      Route::get('/CategoriaMaterial', [CategoriaMaterialController::class, 'index'])->name('categoriaMaterial.index')->middleware('permission:categoria.gestionarCategorias');
      Route::post('/CategoriaMaterial/nueva', [CategoriaMaterialController::class, 'store'])->name('categoriaMaterial.store')->middleware('permission:categoria.gestionarCategorias');
      Route::get('/CategoriaMaterial/edit/{id}', [CategoriaMaterialController::class, 'edit_view'])->name('categoriaMaterial.edit_view')->middleware('permission:categoria.gestionarCategorias');
      Route::post('/CategoriaMaterial/edit', [CategoriaMaterialController::class, 'edit'])->name('categoriaMaterial.edit')->middleware('permission:categoria.gestionarCategorias');
      Route::delete('/CategoriaMaterial/delete', [CategoriaMaterialController::class, 'destroy'])->name('categoriaMaterial.destroy')->middleware('permission:categoria.gestionarCategorias');


    });
    Route::middleware(['permission:subcategoria.gestionarSubCategorias'])->group(function () {

    //Rutas para SubCategoria
    Route::get('/SubCategoriaMaterial', [SubCategoriaMaterialController::class, 'index'])->name('subcategoriaMaterial.index');
    Route::post('/SubCategoriaMaterial/nueva', [SubCategoriaMaterialController::class, 'store'])->name('subcategoriaMaterial.store');
    Route::get('/SubCategoriaMaterial/edit/{id}', [SubCategoriaMaterialController::class, 'edit_view'])->name('subcategoriaMaterial.edit_view');
    Route::post('/SubCategoriaMaterial/edit', [SubCategoriaMaterialController::class, 'edit'])->name('subcategoriaMaterial.edit');
    Route::delete('/SubCategoriaMaterial/delete', [SubCategoriaMaterialController::class, 'destroy'])->name('subcategoriaMaterial.destroy');


    });
    Route::middleware(['permission:producto.gestionarProducto'])->group(function () {
         //Rutas para producto
        Route::get('/Producto', [ProductoController::class, 'index'])->name('producto.index');
        Route::post('/Producto/nueva', [ProductoController::class, 'store'])->name('producto.store');
        Route::get('/Producto/edit/{id}', [ProductoController::class, 'edit_view'])->name('producto.edit_view');
        Route::post('/Producto/edit', [ProductoController::class, 'edit'])->name('producto.edit');
        Route::delete('/Producto/delete', [ProductoController::class, 'destroy'])->name('producto.destroy');
        Route::get('/Producto/asignar/{id}', [ProductoController::class, 'setMaterial'])->name('producto.setMaterial');
        Route::post('/Producto/addmaterial', [ProductoController::class, 'addMaterial'])->name('producto.addMaterial');
        Route::get('Producto/editload/{id}', [ProductoController::class,'editRegistros'])->name('producto.editload');
        Route::delete('/Producto/deleteMaterial', [ProductoController::class, 'destroyMaterial'])->name('producto.destroyMaterial');
        Route::get('/Producto/Reporte', [ProductoController::class, 'reporteProductos'])->name('producto.reporte');






        });
        Route::middleware(['permission:herramienta.gestionarHerramienta'])->group(function () {


                //Ruta para material
            Route::get('/Material', [MaterialController::class, 'index'])->name('material.index');
            Route::post('/Material/nueva', [MaterialController::class, 'store'])->name('material.store');
            Route::get('/Material/edit/{id}', [MaterialController::class, 'edit_view'])->name('material.edit_view');
            Route::post('/Material/edit', [MaterialController::class, 'edit'])->name('material.edit');
            Route::delete('/Material/delete', [MaterialController::class, 'destroy'])->name('material.destroy');
            Route::get('/search', [MaterialController::class,'search'])->name('posts.search');
            Route::get('Material/load/{id}', [MaterialController::class,'cargarRegistros'])->name('material.load');



        });

        Route::middleware(['permission:clientes.gestionarClientes'])->group(function () {
            //Ruta para cliente
           Route::get('/Cliente', [ClienteController::class, 'index'])->name('cliente.index');
           Route::delete('/Cliente/delete',[ClienteController::class, 'destroy1'])->name('cliente.destroy');
           Route::post('/Cliente', [ClienteController::class, 'store'])->name('cliente.store');
           Route::get('/Cliente/Vehiculo/{id}',[VehiculoController::class, 'create'])->name('vehiculo.create');
           Route::post('/Cliente/Vehiculo',[VehiculoController::class, 'store'])->name('vehiculo.store');
           Route::get('/Cliente/Reporte',[ClienteController::class, 'reporteVisitas'])->name('cliente.reporteVisitas');
           Route::get('/Cliente/edit/{id}', [ClienteController::class, 'edit_view'])->name('cliente.edit_view');
           Route::post('/Cliente/edit', [ClienteController::class, 'edit'])->name('cliente.edit');






   });

    Route::middleware(['permission:orden.gestionarOrdenes'])->group(function () {
        //Orden materiales
    Route::get('Orden/AsignarMaterial/{id}',[OrdenReparacionController::class,'asignarMaterial'])->name('orden.asignarMaterial');
    Route::post('Orden/addMaterial',[OrdenReparacionController::class,'addMaterial'])->name('orden.addmaterial');
    Route::delete('/Orden/deleteMaterial', [OrdenReparacionController::class, 'destroyMaterial'])->name('orden.destroyMaterial');
    Route::get('/Orden/loadMaterial/{id}',[OrdenReparacionController::class, 'cargarRegistrosMaterial'])->name('orden.loadMaterial');
    Route::get('Orden/editloadMaterial/{id}',[OrdenReparacionController::class,'editLoadMaterial'])->name('orden.editloadMaterial');


    //Orden
      Route::get('Orden/AsignarProducto/{id}',[OrdenReparacionController::class,'asignarProducto'])->name('orden.asignarProducto');
     Route::get('/Orden/create/{id}',[OrdenReparacionController::class, 'create'])->name('orden.create');
     Route::post('/Orden/edit',[OrdenReparacionController::class, 'edit'])->name('orden.edit');
     Route::get('/Orden/edit_view/{id}',[OrdenReparacionController::class, 'edit_view'])->name('orden.edit_view');
      Route::post('/Orden',[OrdenReparacionController::class, 'store'])->name('orden.store');
      Route::get('/searchMaterial', [OrdenReparacionController::class,'searchMaterial'])->name('orden.searchMaterial');
//Orden Productos
    Route::get('/Orden',[OrdenReparacionController::class, 'index'])->name('orden.index');
    Route::post('Orden/addProducto',[OrdenReparacionController::class,'addProducto'])->name('orden.addProducto');
    Route::post('Orden/destroyProducto',[OrdenReparacionController::class,'destroyProducto'])->name('orden.destroyProducto');
    Route::get('/searchProducto', [OrdenReparacionController::class,'search'])->name('orden.search');
    Route::get('/Orden/load/{id}',[OrdenReparacionController::class, 'cargarRegistros'])->name('orden.loadProducto');
    Route::get('Orden/editload/{id}',[OrdenReparacionController::class,'editLoad'])->name('orden.editload');
    Route::delete('/Orden', [OrdenReparacionController::class, 'destroyProducto'])->name('orden.destroyProducto');
    Route::post('Orden/reporte',[OrdenReparacionController::class,'reporteOrden'])->name('orden.reporte');
    Route::post('Orden/reporteHerramientas',[OrdenReparacionController::class,'reporteHerramientas'])->name('orden.reporteHerramientas');


//RUTAS RESERVA
  //Ruta para material
  Route::get('/Reserva', [ReservaController::class, 'index'])->name('reserva.index');
  
  Route::get('/Reserva/edit_view/{id}', [ReservaController::class, 'edit_view'])->name('reserva.edit_view');
  Route::post('/Reserva/edit', [ReservaController::class, 'edit'])->name('reserva.edit');
  Route::delete('/Reserva/delete', [ReservaController::class, 'destroy'])->name('reserva.destroy');
  
  //administracion imagenes
  Route::get('/imagenes', [ImagenesPromocionController::class, 'index'])->name('imagen.index');
  Route::post('/imagenes/nueva', [ImagenesPromocionController::class, 'store'])->name('imagen.store');
  Route::get('/imagenes/edit/{id}', [ImagenesPromocionController::class, 'edit_view'])->name('imagen.edit_view');
  Route::post('/imagenes/edit', [ImagenesPromocionController::class, 'edit'])->name('imagen.edit');
  Route::delete('/imagenes/delete', [ImagenesPromocionController::class, 'destroy'])->name('imagen.destroy');

    });
















});
