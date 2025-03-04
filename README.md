# CakeTracker

CakeTracker is a service that helps manage and schedule cake days for employees based on their birthdays. The service ensures that employees get their birthday off, and assigns a cake day on the first working day after their day off. It also ensures no back-to-back cake days and handles merging of consecutive cake days.

## Features

- Employees get their birthday off.
- Cake Day is the first working day after their day off.
- Ensures no back-to-back cake days.
- Merges consecutive cake days into the second day.
- Assigns one large cake if two or more people have the same cake day.

## Installation

1. Clone the repository:
    ```sh
    git clone https://github.com/yourusername/CakeTracker.git
    ```

2. Navigate to the project directory:
    ```sh
    cd CakeTracker
    ```

3. Install the dependencies:
    ```sh
    composer install
    ```

4. Set up the environment variables:
    ```sh
    cp .env.example .env
    php artisan key:generate
    ```

5. Run the migrations:
    ```sh
    php artisan migrate
    ```

## Usage

To calculate and get the cake days, you can use the `CakeDayService` class. Here is an example of how to use it:

```php
use App\Services\CakeDayService;

$cakeDayService = new CakeDayService();
$cakeDays = $cakeDayService->calculateCakeDays();

print_r($cakeDays);
