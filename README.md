# 📦 Inventory Management System

![Laravel](https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![Tailwind CSS](https://img.shields.io/badge/Tailwind_CSS-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white)
![Livewire](https://img.shields.io/badge/Livewire-4E56A6?style=for-the-badge&logo=livewire&logoColor=white)
![Security](https://img.shields.io/badge/Security-Cloudflare-orange?style=for-the-badge)

> **A robust, secure, and intuitive dashboard for managing product stock flows with precision.**

---

## 📖 Overview

This project is a streamlined **Inventory Management Dashboard** built on the **TALL Stack**. It handles the core lifecycle of product tracking—from creation to stock adjustments—guarded by strict validation rules to ensure data integrity.

Secured by **Cloudflare**, the application is built to withstand DDoS attacks and ensure high availability, while **Laravel Breeze** handles secure authentication.

---

## 🔄 Application Flow

The application follows a logical and efficient workflow designed for quick inventory updates:

### 1️⃣ Add Product

Initialize new items in the system with essential details (Name, Price, Unit Type).

### 2️⃣ Dashboard Operations

Once a product is added, the Dashboard becomes the command center:

-   **📥 Stock In**: Add inventory to existing products.
-   **📤 Stock Out**: Process sales or usage by decreasing stock.
-   **🗑️ Delete Product**: Remove obsolete items from the system.

---

## 🛡️ Security & Validations

We prioritize data accuracy and system security. Here is how we ensure the system remains reliable:

### ✅ Data Integrity & Validation

-   **Uniqueness**: `Product Name` must be unique across the database to prevent duplicates.
-   **Pricing Logic**: `Price` must strictly be **greater than zero**.
-   **Stock In Precision**:
    -   Inputs cannot be negative.
    -   **Unit Check**: If the product is "Countable" (e.g., pieces), decimal values are rejected to ensure physical reality.
-   **Stock Out Safety**:
    -   The system calculates the _future stock_ before processing.
    -   Transaction is blocked if `Current Stock - Output < 0`. Real-world stock cannot be negative!

### 🔒 Network & App Security

-   **Cloudflare Integration**: The application sits behind Cloudflare's robust network for DDoS protection, caching, and traffic analysis.
-   **Secure Authentication**: Powered by **Laravel Breeze**, ensuring industry-standard security for user sessions and data access.

---

## 💻 Tech Stack & Libraries

This project utilizes the **TALL Stack** architecture for a modern, reactive user experience without leaving the comfort of Laravel.

| Component         | Technology         | Description                                        |
| :---------------- | :----------------- | :------------------------------------------------- |
| **Framework**     | **Laravel 10+**    | The PHP framework for web artisans.                |
| **Styling**       | **Tailwind CSS**   | Utility-first CSS framework.                       |
| **UI Kit**        | **Basecoat CSS**   | For consistent and clean UI components.            |
| **Interactivity** | **Alpine.js**      | Lightweight JavaScript framework.                  |
| **Dynamic UI**    | **Livewire**       | Dynamic front-end interactions without complex JS. |
| **Auth**          | **Laravel Breeze** | Minimal and simple authentication implementation.  |

---

## 🚀 Getting Started

Follow these steps to set up the project locally:

1.  **Clone the repository**

    ```bash
    git clone [https://github.com/felixa1243/your-repo-name.git](https://github.com/felixa1243/your-repo-name.git)
    cd your-repo-name
    ```

2.  **Install Dependencies**

    ```bash
    composer install
    npm install && npm run build
    ```

3.  **Environment Setup**
    Copy the environment file and generate the application key:

    ```bash
    cp .env.example .env
    php artisan key:generate
    ```

    _Configure your database credentials in the `.env` file._

4.  **Migrate and Seed (Important!)**
    Run the migrations and **seed the database** to populate it with the necessary mock data for testing:

    ```bash
    php artisan migrate --seed
    ```

5.  **Run the application**
    ```bash
    php artisan serve
    ```

---

<div align="center">

**Created by [felixa1243](https://github.com/felixa1243)**

</div>
