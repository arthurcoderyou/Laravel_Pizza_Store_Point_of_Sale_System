<?php

use Dompdf\Dompdf;
use App\Models\Menu;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TransactionController;

Route::get('/generate-pdf/{order_id}', function ($order_id) {
    // Create a new Dompdf instance
    $dompdf = new Dompdf();
    
    // Load the HTML content from the Blade view
    $html = view('reciept',compact('order_id'))->render();
    
    // Load the HTML into Dompdf
    $dompdf->loadHtml($html);
    
    // (Optional) Adjust Dompdf configuration settings
    $dompdf->setPaper('A4', 'portrait');
    
    // Render the HTML to PDF
    $dompdf->render();
    
    // Generate a unique filename for the PDF
    $filename = 'output_' . uniqid() . '.pdf';
    
    // Save the PDF to the public directory
    $dompdf->stream($filename, ['Attachment' => false]);
    
    // Return the filename for further processing, if needed
    return $filename;
});
//end of for priting



//Admin Middleware
Route::middleware(['auth','role:admin'])->group(function(){
    Route::prefix('admin')->group(function(){

        //Admin Menu Routes
        Route::prefix('menu')->group(function(){
            Route::get('/index',[MenuController::class,'index']);
            Route::post('/index',[MenuController::class,'search']); //for searching and landing on the admin/menu/index route
            Route::get('/create',[MenuController::class,'create']);
            Route::post('/create_store',[MenuController::class,'create_store']);
            Route::get('/update/{menu_id}',[MenuController::class,'update']);
            Route::post('/update_store',[MenuController::class,'update_store']);
            Route::post('/delete',[MenuController::class,'delete']);
            Route::post('/add_to_cart',[MenuController::class,'add_to_cart']);
        });
        //end of Admin Menu Routes

        //Admin Cart Route
        Route::prefix('cart')->group(function(){
            Route::get('/index',[CartController::class,'index']);
            Route::post('/update',[CartController::class,'update']);
            Route::post('/delete',[CartController::class,'delete']);

            Route::get('/checkout/{user_id}',[CartController::class,'checkout']);

        });
        //end of Admin Cart Routes


        //Admin Order Routes
        Route::prefix('order')->group(function(){
            Route::get('/orders',[OrderController::class,'index']);
            Route::get('/order_details/{order_id}',[OrderController::class,'order_menu_details']);
            Route::get('/pending_orders',[TransactionController::class,'pending']);
            Route::get('/completed_orders',[TransactionController::class,'completed']);
            Route::get('/denied_orders',[TransactionController::class,'denied']);
            Route::post('/update_order_status',[TransactionController::class,'update']);
        });
        //end of Admin Order Routes

        //Admin Sales Routes
        Route::prefix('sales')->group(function(){
            Route::get('/sales_report',[AdminController::class,'sales']);
            Route::post('/sales_report',[AdminController::class,'search_sales']);
        });
        //end of Admin Sales Routes

    });
});







//User Authenticated Routes
Route::middleware(['auth'])->group(function () {
    Route::prefix('admin')->group(function(){

        //User Menu Routes
        Route::prefix('menu')->group(function(){
            Route::get('/index',[MenuController::class,'index']);
            Route::post('/index',[MenuController::class,'search']); //for searching and landing on the admin/menu/index route
            Route::post('/add_to_cart',[MenuController::class,'add_to_cart']);
            
        });
        //end of User Menu Routes

        //User Cart Routes
        Route::prefix('cart')->group(function(){
            Route::get('/index',[CartController::class,'index']);
            Route::post('/update',[CartController::class,'update']);
            Route::post('/delete',[CartController::class,'delete']);

            Route::get('/checkout/{user_id}',[CartController::class,'checkout']);

        });
        //end of User Cart Routes


        //User Order Routes
        Route::prefix('order')->group(function(){
            Route::get('/orders',[OrderController::class,'index']);
            Route::get('/order_details/{order_id}',[OrderController::class,'order_menu_details']);
            Route::post('/delete',[OrderController::class,'delete']);
        });
        //end of User Order Routes

    });
});









Route::get('/', function () {
    $products = Menu::where('id','>','0')->latest()->take(3)->get();
    return view('welcome',compact('products'));
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
