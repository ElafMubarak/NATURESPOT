# NatureSpot

NatureSpot is a full-stack PHP + MySQL web application that lets users *register/login* and *share nature places* (spots) with an image and location (latitude/longitude).
 Other users can *explore* the community spots with filtering and sorting.

## Features

- User authentication (Register / Login / Logout)
- Add new spots (name, description, category, image, lat/long)
- View all spots in *Explore*
- Filter by category: `park`, `cafe`, `restaurant`
- Sort spots: `Newest`, `Oldest`, `A → Z`, `Z → A`
- User dashboard for managing your own spots:
  - Edit spot
  - Delete spot
- “View on Map” link for spots that have latitude/longitude

## Tech Stack

- *PHP* (plain PHP pages)
- *MySQL* (via `mysqli`)
- HTML/CSS (see `style.css`)
- Client-side: `script.js` (if used for map/UI)

## Project Structure (main files)

- `index.php` – Landing page
- `login.php` – Login form
- `register.php` – Registration form
- `navbar.php` – Navigation bar (changes based on session)
- `explore.php` – Browse spots with filter/sort
- `dashboard.php` – Your spots (requires login)
- `add.php` – Add a new spot + image upload
- `edit.php` – Edit an existing spot (optionally replace image)
- `delete.php` – Delete a spot
- `logout.php` – Logout
- `db.php` – Database connection (mysqli)
- `uploads/` – Uploaded images

## Database Setup

### 1) Create the database

Create a database named:

- `mapproject`

### 2) Create tables

Run the following SQL (adjust types as needed):

```sql
CREATE TABLE IF NOT EXISTS users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(255) NOT NULL,
  email VARCHAR(255) NOT NULL,
  password VARCHAR(255) NOT NULL
);

CREATE TABLE IF NOT EXISTS spots (
  id INT AUTO_INCREMENT PRIMARY KEY,
  site_name VARCHAR(255) NOT NULL,
  description TEXT NOT NULL,
  image VARCHAR(255) DEFAULT '',
  latitude VARCHAR(64) DEFAULT '',
  longitude VARCHAR(64) DEFAULT '',
  category VARCHAR(50) NOT NULL,
  user_id INT NOT NULL,
  FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);
```

> Notes:
> - The code expects `users.password` to contain a **hashed** password (`password_hash`).
> - The code also expects the `spots` columns used across the app (`site_name`, `description`, `image`, `latitude`, `longitude`, `category`, `user_id`).

## Configuration

### Edit `db.php`

Update credentials in `db.php`:

- `host`
- `user`
- `pass`
- `db` (currently `mapproject`)
- `port` (currently set for MAMP: `8889`)

Also ensure that your MySQL server is reachable from your PHP server.

## Running the App Locally

1. Move/copy the project into your PHP server’s document root.
   - Example: Apache: `htdocs/` (XAMPP) or MAMP `htdocs/`.
2. Ensure `uploads/` exists and is writable by the web server.
   - You should be able to upload images from `add.php`.
3. Start your PHP server and MySQL server.
4. Open `index.php` in your browser.
5. Register a user, then login.
6. Add spots from `dashboard.php` → `+ Add`.
7. Explore spots using `explore.php`.

## How to Use

### Register / Login

- Go to `register.php` to create an account.
- Login on `login.php`.

### Add a Spot

- Login → open `dashboard.php` → click *+ Add*
- Fill:
  - Spot name
  - Description
  - Image upload
  - Category (park/cafe/restaurant)
  - Latitude and Longitude
- Submit to save the spot.

### Explore

- Use `explore.php` to browse the community spots.
- Choose a *filter* and *sort order*, then click *Apply*.

### Edit / Delete (Dashboard)

- Go to `dashboard.php`
- Use *Edit* to update details (image can be replaced)
- Use *Delete* to remove a spot

## Troubleshooting

- *“Connection failed” / DB errors*: verify `db.php` credentials and MySQL port.
- *Uploads fail*: check that the `uploads/` folder exists and is writable.
- *Explore page empty*: confirm that the `spots` table has data and categories match `park/cafe/restaurant`.
- *Map link not showing*: latitude/longitude fields must be present (non-empty).

## Security Notes (Important)

This project uses plain SQL queries with interpolated values in several places. For a production-ready app, you should:

- Use prepared statements to prevent SQL injection
- Validate/sanitize user inputs
- Restrict allowed upload file types and file sizes
- Consider CSRF protection for forms


The repository contains images under:

- `web/`
- `uploads/`

These can be used to preview the UI and uploaded media.
