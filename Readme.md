## CSV upload and processing Laravel application
---

### Requirements
---
- php^8.3
- apache/nginx
- mysql

### Setting up
1. Clone repo
2. Run `composer install`
3. Run `npm install && npm run build`
3. Copy `.env.example` to `.env` and configure DB
4. Run `php artisan key:generate`
4. Run `php artisan migrate`
5. Run `composer run dev`
6. Go to `http://127.0.0.1:8000`
7. Upload a CSV/Excel file (max 100MB, with headings: name, email, contact_no, address, birthday)

### After setup
Please register yourself from self-registration link (top right corner)) once you got to welcome page.
and login using the registered user and then you should see `Uploads` menu item from the side-navigation in the Dashboard.
From there you can see the uploads you made as a list and make new uploads by clicking on `New Upload` button.
