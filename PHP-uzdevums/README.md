## Prerequisites
- PHP 8.1 or higher
- Composer
- Node.js / NPM

## Installation
1. Clone the repository:
   git clone <repo_url>
   cd <repo_folder>
2. Install PHP dependencies:
   composer install
3. Install frontend dependencies and compile assets:
   npm install
   npm run dev
4. Generate the application key:
   php artisan key:generate
5. Run migrations and seeders:
   php artisan migrate --seed
6. Serve the application:
   php artisan serve

## Authentication
- User registration is handled via Laravel Breeze (Blade).
- Admin users can be created created via Tinker:
  php artisan tinker:
   use App\Models\User;
   use Illuminate\Support\Facades\Hash;

   User::create([
     'name' => 'Admin',
     'email' => 'admin@example.com',
     'password' => Hash::make('secret'),
     'is_admin' => true
   ]);

## Policies / Security
- Only admins can delete customers
- Regular users can only edit their own orders

## Seeders & Factories
- You can populate sample data using factories:
  php artisan tinker \App\Models\Customer::factory()->count(10)->create();
  php artisan tinker \App\Models\Order::factory()->count(20)->create();