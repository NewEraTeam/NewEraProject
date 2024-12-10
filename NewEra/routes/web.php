use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserDataController;
use App\Http\Controllers\MainPageController;
use App\Http\Controllers\BadmintonController;
use App\Http\Controllers\SwimmingController;
use App\Http\Controllers\StadiumController;
use App\Http\Controllers\GymController;
use App\Http\Controllers\CustomerBookingController;
use App\Http\Controllers\BookingController;

// Default route
Route::get('/', [UserDataController::class, 'showLogin'])->name('login.page');

// Login and registration routes
Route::get('/login', [UserDataController::class, 'showLogin'])->name('login.page');
Route::post('/login', [UserDataController::class, 'login'])->name('login.submit');
Route::get('/register', [UserDataController::class, 'showForm'])->name('register.page');
Route::post('/register', [UserController::class, 'register'])->name('register.submit');

// Main page
Route::get('/mainpage', [MainPageController::class, 'index'])->name('mainpage');

// Facility routes
Route::get('/facility/badminton', [BadmintonController::class, 'index'])->name('facility.badminton');
Route::get('/facility/swimming', [SwimmingController::class, 'index'])->name('facility.swimming');
Route::get('/facility/stadium', [StadiumController::class, 'index'])->name('facility.stadium');
Route::get('/facility/gym', [GymController::class, 'index'])->name('facility.gym');

// Customer booking history
Route::get('/customer-booking', fn() => view('CustomerBookingModule.CustomerBooking'))->name('customer-booking');

// About Us
Route::get('/about-us', fn() => view('AboutUsModule.AboutUs'))->name('about-us');

// Profile
Route::get('/view-profile', fn() => view('ViewProfileModule.ViewProfile'))->name('view-profile');

// Localization
Route::get('/lang/{locale}', function ($locale) {
    if (in_array($locale, ['en', 'bm', 'cn'])) {
        session(['locale' => $locale]);
    }
    return redirect()->back();
});

// Booking routes
Route::get('/booking/badminton', fn() => view('BookingModule.bookingBadminton'))->name('bookingBadminton');
Route::post('/booking/badminton', [BookingController::class, 'submitBookingBadminton']);
Route::get('/booking/personal-details', fn() => view('BookingModule.BookingPersonalDetails'))->name('bookingPersonalDetails');
Route::post('/booking/personal-details', [BookingController::class, 'storePersonalDetails']);
Route::get('/booking/payment', fn() => view('BookingModule.Payment'))->name('payment');
Route::post('/booking/payment', [BookingController::class, 'storePaymentDetails']);
Route::get('/booking/success', [BookingController::class, 'success'])->name('success');
