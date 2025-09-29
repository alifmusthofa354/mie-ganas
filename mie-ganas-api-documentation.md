# API Documentation - Mie Ganas
**Version:** 1.0  
**Base URL:** `https://api.mieganas.com/api/v1`  
**Content-Type:** `application/json`  
**Authentication:** Bearer Token (Laravel Sanctum)

---

## 📌 Table of Contents
1. [Authentication](#authentication)
2. [Customer APIs](#customer-apis)
3. [Admin APIs](#admin-apis)
4. [Kasir APIs](#kasir-apis)
5. [Pelayan APIs](#pelayan-apis)
6. [Webhook](#webhook)
7. [Error Responses](#error-responses)

---

## 🔐 Authentication

### 1. Login (Admin/Kasir/Pelayan)
**POST** `/auth/login`

**Request Body:**
```json
{
  "email": "admin@mieganas.com",
  "password": "password"
}
```

**Response Success (200):**
```json
{
  "success": true,
  "message": "Login successful",
  "data": {
    "user": {
      "id": 1,
      "name": "Admin Mie Ganas",
      "email": "admin@mieganas.com",
      "role": "admin"
    },
    "token": "1|abcdef123456..."
  }
}
```

---

### 2. Logout
**POST** `/auth/logout`

**Headers:**
```
Authorization: Bearer {token}
```

**Response Success (200):**
```json
{
  "success": true,
  "message": "Logout successful"
}
```

---

### 3. Get Current User
**GET** `/auth/me`

**Headers:**
```
Authorization: Bearer {token}
```

**Response Success (200):**
```json
{
  "success": true,
  "data": {
    "id": 1,
    "name": "Admin Mie Ganas",
    "email": "admin@mieganas.com",
    "role": "admin",
    "last_login_at": "2025-09-29T10:30:00Z"
  }
}
```

---

## 👥 Customer APIs

### 1. Create Customer Session (Scan QR)
**POST** `/customer/session`

**Request Body:**
```json
{
  "table_number": "A1"
}
```

**Response Success (200):**
```json
{
  "success": true,
  "message": "Session created successfully",
  "data": {
    "session_token": "abc123def456...",
    "table": {
      "id": 1,
      "table_number": "A1",
      "capacity": 4
    },
    "expired_at": "2025-09-29T14:30:00Z"
  }
}
```

---

### 2. Get Menu List
**GET** `/customer/menus`

**Query Parameters:**
- `category_id` (optional): Filter by category
- `search` (optional): Search by name
- `sort_by` (optional): `name`, `price`, `popular` (default: `display_order`)

**Headers:**
```
X-Session-Token: {session_token}
```

**Response Success (200):**
```json
{
  "success": true,
  "data": {
    "categories": [
      {
        "id": 1,
        "name": "Mie Ganas",
        "slug": "mie-ganas"
      }
    ],
    "menus": [
      {
        "id": 1,
        "name": "Mie Ganas Level 1",
        "slug": "mie-ganas-level-1",
        "description": "Mie dengan level kepedasan pemula",
        "image_url": "https://cdn.mieganas.com/mie-level-1.jpg",
        "price": 15000,
        "price_formatted": "Rp 15.000",
        "spicy_level": 1,
        "is_available": true,
        "is_recommended": true,
        "category": {
          "id": 1,
          "name": "Mie Ganas"
        }
      }
    ]
  }
}
```

---

### 3. Get Menu Detail
**GET** `/customer/menus/{id}`

**Headers:**
```
X-Session-Token: {session_token}
```

**Response Success (200):**
```json
{
  "success": true,
  "data": {
    "id": 1,
    "name": "Mie Ganas Level 1",
    "slug": "mie-ganas-level-1",
    "description": "Mie dengan level kepedasan pemula",
    "image_url": "https://cdn.mieganas.com/mie-level-1.jpg",
    "price": 15000,
    "price_formatted": "Rp 15.000",
    "spicy_level": 1,
    "spicy_level_text": "Pedas Ringan",
    "is_available": true,
    "is_recommended": true,
    "sold_count": 245,
    "category": {
      "id": 1,
      "name": "Mie Ganas"
    }
  }
}
```

---

### 4. Add to Cart
**POST** `/customer/cart/add`

**Headers:**
```
X-Session-Token: {session_token}
```

**Request Body:**
```json
{
  "menu_id": 1,
  "quantity": 2,
  "notes": "Tanpa bawang, extra pedas"
}
```

**Response Success (200):**
```json
{
  "success": true,
  "message": "Item added to cart",
  "data": {
    "cart_item_id": 5,
    "cart_total_items": 3,
    "cart_total_amount": 45000
  }
}
```

---

### 5. Get Cart
**GET** `/customer/cart`

**Headers:**
```
X-Session-Token: {session_token}
```

**Response Success (200):**
```json
{
  "success": true,
  "data": {
    "cart_id": 1,
    "items": [
      {
        "id": 1,
        "menu_id": 1,
        "menu_name": "Mie Ganas Level 1",
        "menu_image": "https://cdn.mieganas.com/mie-level-1.jpg",
        "price": 15000,
        "quantity": 2,
        "subtotal": 30000,
        "notes": "Tanpa bawang"
      }
    ],
    "summary": {
      "subtotal": 30000,
      "tax": 3000,
      "service_charge": 1500,
      "total": 34500,
      "formatted": {
        "subtotal": "Rp 30.000",
        "tax": "Rp 3.000",
        "service_charge": "Rp 1.500",
        "total": "Rp 34.500"
      }
    }
  }
}
```

---

### 6. Update Cart Item
**PUT** `/customer/cart/items/{id}`

**Headers:**
```
X-Session-Token: {session_token}
```

**Request Body:**
```json
{
  "quantity": 3,
  "notes": "Extra pedas"
}
```

**Response Success (200):**
```json
{
  "success": true,
  "message": "Cart item updated",
  "data": {
    "cart_total_items": 3,
    "cart_total_amount": 45000
  }
}
```

---

### 7. Remove Cart Item
**DELETE** `/customer/cart/items/{id}`

**Headers:**
```
X-Session-Token: {session_token}
```

**Response Success (200):**
```json
{
  "success": true,
  "message": "Item removed from cart"
}
```

---

### 8. Checkout (QRIS)
**POST** `/customer/checkout`

**Headers:**
```
X-Session-Token: {session_token}
```

**Request Body:**
```json
{
  "payment_method": "qris",
  "customer_notes": "Tolong diantar ke meja"
}
```

**Response Success (200):**
```json
{
  "success": true,
  "message": "Order created successfully",
  "data": {
    "order_id": 123,
    "order_number": "MG20250929001",
    "total_amount": 34500,
    "payment_method": "qris",
    "payment_status": "pending",
    "midtrans": {
      "snap_token": "abc123def456...",
      "redirect_url": "https://app.midtrans.com/snap/v2/vtweb/abc123..."
    }
  }
}
```

---

### 9. Checkout (Cash - Pay at Cashier)
**POST** `/customer/checkout`

**Headers:**
```
X-Session-Token: {session_token}
```

**Request Body:**
```json
{
  "payment_method": "cash",
  "customer_notes": "Bayar di kasir"
}
```

**Response Success (200):**
```json
{
  "success": true,
  "message": "Order created, please pay at cashier",
  "data": {
    "order_id": 124,
    "order_number": "MG20250929002",
    "total_amount": 34500,
    "payment_method": "cash",
    "payment_status": "pending",
    "qr_code": "https://cdn.mieganas.com/qr/MG20250929002.png"
  }
}
```

---

### 10. Get Order Status (Tracking)
**GET** `/customer/orders/{order_number}`

**Headers:**
```
X-Session-Token: {session_token}
```

**Response Success (200):**
```json
{
  "success": true,
  "data": {
    "order_id": 123,
    "order_number": "MG20250929001",
    "status": "preparing",
    "status_text": "Sedang Disiapkan",
    "estimated_time": 15,
    "progress": [
      {
        "status": "waiting_payment",
        "label": "Menunggu Pembayaran",
        "completed": true,
        "timestamp": "2025-09-29T10:30:00Z"
      },
      {
        "status": "processing",
        "label": "Sedang Diproses",
        "completed": true,
        "timestamp": "2025-09-29T10:32:00Z"
      },
      {
        "status": "preparing",
        "label": "Sedang Disiapkan",
        "completed": true,
        "timestamp": "2025-09-29T10:35:00Z"
      },
      {
        "status": "ready",
        "label": "Siap Diantar",
        "completed": false,
        "timestamp": null
      },
      {
        "status": "served",
        "label": "Selesai",
        "completed": false,
        "timestamp": null
      }
    ],
    "items": [
      {
        "menu_name": "Mie Ganas Level 1",
        "quantity": 2,
        "price": 15000,
        "subtotal": 30000,
        "notes": "Tanpa bawang"
      }
    ],
    "summary": {
      "subtotal": 30000,
      "tax": 3000,
      "service_charge": 1500,
      "total": 34500
    },
    "table": {
      "table_number": "A1"
    }
  }
}
```

---

### 11. Get Order History
**GET** `/customer/orders`

**Headers:**
```
X-Session-Token: {session_token}
```

**Query Parameters:**
- `status` (optional): Filter by status
- `limit` (optional): Default 10
- `page` (optional): Default 1

**Response Success (200):**
```json
{
  "success": true,
  "data": {
    "current_page": 1,
    "data": [
      {
        "order_id": 123,
        "order_number": "MG20250929001",
        "status": "completed",
        "status_text": "Selesai",
        "total_amount": 34500,
        "total_items": 2,
        "created_at": "2025-09-29T10:30:00Z",
        "completed_at": "2025-09-29T10:50:00Z"
      }
    ],
    "total": 5,
    "per_page": 10,
    "last_page": 1
  }
}
```

---

## 👨‍💼 Admin APIs

### 1. Dashboard Statistics
**GET** `/admin/dashboard`

**Headers:**
```
Authorization: Bearer {token}
```

**Query Parameters:**
- `period` (optional): `today`, `week`, `month` (default: `today`)

**Response Success (200):**
```json
{
  "success": true,
  "data": {
    "period": "today",
    "date_range": {
      "start": "2025-09-29",
      "end": "2025-09-29"
    },
    "summary": {
      "total_orders": 45,
      "total_revenue": 1250000,
      "total_revenue_formatted": "Rp 1.250.000",
      "average_order_value": 27777,
      "unique_customers": 38,
      "completed_orders": 42,
      "cancelled_orders": 3
    },
    "payment_methods": [
      {
        "method": "qris",
        "count": 30,
        "total": 850000,
        "percentage": 68
      },
      {
        "method": "cash",
        "count": 15,
        "total": 400000,
        "percentage": 32
      }
    ],
    "hourly_sales": [
      {
        "hour": "10:00",
        "orders": 5,
        "revenue": 125000
      },
      {
        "hour": "11:00",
        "orders": 8,
        "revenue": 220000
      }
    ],
    "top_menus": [
      {
        "menu_id": 1,
        "menu_name": "Mie Ganas Level 1",
        "quantity_sold": 25,
        "revenue": 375000
      },
      {
        "menu_id": 3,
        "menu_name": "Mie Ganas Level 5",
        "quantity_sold": 15,
        "revenue": 300000
      }
    ]
  }
}
```

---

### 2. Get All Categories
**GET** `/admin/categories`

**Headers:**
```
Authorization: Bearer {token}
```

**Response Success (200):**
```json
{
  "success": true,
  "data": [
    {
      "id": 1,
      "name": "Mie Ganas",
      "slug": "mie-ganas",
      "description": "Menu mie pedas khas Mie Ganas",
      "icon": "fa-bowl-rice",
      "display_order": 1,
      "is_active": true,
      "total_menus": 10
    }
  ]
}
```

---

### 3. Create Category
**POST** `/admin/categories`

**Headers:**
```
Authorization: Bearer {token}
```

**Request Body:**
```json
{
  "name": "Dessert",
  "description": "Menu penutup manis",
  "icon": "fa-ice-cream",
  "display_order": 5
}
```

**Response Success (201):**
```json
{
  "success": true,
  "message": "Category created successfully",
  "data": {
    "id": 5,
    "name": "Dessert",
    "slug": "dessert"
  }
}
```

---

### 4. Update Category
**PUT** `/admin/categories/{id}`

**Headers:**
```
Authorization: Bearer {token}
```

**Request Body:**
```json
{
  "name": "Dessert Special",
  "display_order": 4,
  "is_active": true
}
```

**Response Success (200):**
```json
{
  "success": true,
  "message": "Category updated successfully"
}
```

---

### 5. Delete Category
**DELETE** `/admin/categories/{id}`

**Headers:**
```
Authorization: Bearer {token}
```

**Response Success (200):**
```json
{
  "success": true,
  "message": "Category deleted successfully"
}
```

---

### 6. Get All Menus
**GET** `/admin/menus`

**Headers:**
```
Authorization: Bearer {token}
```

**Query Parameters:**
- `category_id` (optional): Filter by category
- `search` (optional): Search by name
- `is_available` (optional): true/false
- `page` (optional): Default 1
- `per_page` (optional): Default 15

**Response Success (200):**
```json
{
  "success": true,
  "data": {
    "current_page": 1,
    "data": [
      {
        "id": 1,
        "name": "Mie Ganas Level 1",
        "slug": "mie-ganas-level-1",
        "category": {
          "id": 1,
          "name": "Mie Ganas"
        },
        "price": 15000,
        "price_formatted": "Rp 15.000",
        "spicy_level": 1,
        "is_available": true,
        "is_recommended": true,
        "sold_count": 245,
        "image_url": "https://cdn.mieganas.com/mie-level-1.jpg"
      }
    ],
    "total": 25,
    "per_page": 15,
    "last_page": 2
  }
}
```

---

### 7. Create Menu
**POST** `/admin/menus`

**Headers:**
```
Authorization: Bearer {token}
Content-Type: multipart/form-data
```

**Request Body (Form Data):**
```
name: Mie Ganas Level 2
category_id: 1
description: Mie dengan level kepedasan sedang
price: 17000
spicy_level: 2
is_available: true
is_recommended: false
image: [file upload]
```

**Response Success (201):**
```json
{
  "success": true,
  "message": "Menu created successfully",
  "data": {
    "id": 10,
    "name": "Mie Ganas Level 2",
    "slug": "mie-ganas-level-2",
    "image_url": "https://cdn.mieganas.com/mie-level-2.jpg"
  }
}
```

---

### 8. Update Menu
**POST** `/admin/menus/{id}`

**Headers:**
```
Authorization: Bearer {token}
Content-Type: multipart/form-data
```

**Request Body (Form Data):**
```
_method: PUT
name: Mie Ganas Level 2 Updated
price: 18000
is_available: true
image: [file upload] (optional)
```

**Response Success (200):**
```json
{
  "success": true,
  "message": "Menu updated successfully"
}
```

---

### 9. Delete Menu (Soft Delete)
**DELETE** `/admin/menus/{id}`

**Headers:**
```
Authorization: Bearer {token}
```

**Response Success (200):**
```json
{
  "success": true,
  "message": "Menu deleted successfully"
}
```

---

### 10. Bulk Update Menu Availability
**POST** `/admin/menus/bulk-availability`

**Headers:**
```
Authorization: Bearer {token}
```

**Request Body:**
```json
{
  "menu_ids": [1, 2, 3],
  "is_available": false
}
```

**Response Success (200):**
```json
{
  "success": true,
  "message": "3 menus updated successfully"
}
```

---

### 11. Get All Orders
**GET** `/admin/orders`

**Headers:**
```
Authorization: Bearer {token}
```

**Query Parameters:**
- `status` (optional): Filter by status
- `payment_status` (optional): Filter by payment status
- `date_from` (optional): YYYY-MM-DD
- `date_to` (optional): YYYY-MM-DD
- `search` (optional): Search by order number
- `page` (optional): Default 1

**Response Success (200):**
```json
{
  "success": true,
  "data": {
    "current_page": 1,
    "data": [
      {
        "id": 123,
        "order_number": "MG20250929001",
        "table_number": "A1",
        "total_amount": 34500,
        "payment_method": "qris",
        "payment_status": "paid",
        "status": "completed",
        "total_items": 2,
        "customer_notes": "Extra pedas",
        "created_at": "2025-09-29T10:30:00Z",
        "completed_at": "2025-09-29T10:50:00Z"
      }
    ],
    "total": 150,
    "per_page": 20,
    "last_page": 8
  }
}
```

---

### 12. Export Sales Report
**GET** `/admin/reports/export`

**Headers:**
```
Authorization: Bearer {token}
```

**Query Parameters:**
- `format`: `excel` or `pdf`
- `period`: `today`, `week`, `month`, `custom`
- `date_from` (optional): YYYY-MM-DD
- `date_to` (optional): YYYY-MM-DD

**Response Success (200):**
```
File download (Excel/PDF)
```

---

### 13. Manage Users (Kasir/Pelayan)
**GET** `/admin/users`

**Headers:**
```
Authorization: Bearer {token}
```

**Response Success (200):**
```json
{
  "success": true,
  "data": [
    {
      "id": 2,
      "name": "Kasir 1",
      "email": "kasir1@mieganas.com",
      "username": "kasir1",
      "role": "kasir",
      "is_active": true,
      "last_login_at": "2025-09-29T09:00:00Z"
    }
  ]
}
```

---

### 14. Create User
**POST** `/admin/users`

**Headers:**
```
Authorization: Bearer {token}
```

**Request Body:**
```json
{
  "name": "Kasir 2",
  "email": "kasir2@mieganas.com",
  "username": "kasir2",
  "password": "password123",
  "role": "kasir",
  "phone": "081234567890"
}
```

**Response Success (201):**
```json
{
  "success": true,
  "message": "User created successfully",
  "data": {
    "id": 5,
    "name": "Kasir 2",
    "email": "kasir2@mieganas.com"
  }
}
```

---

### 15. Generate Table QR Code
**POST** `/admin/tables/{id}/generate-qr`

**Headers:**
```
Authorization: Bearer {token}
```

**Response Success (200):**
```json
{
  "success": true,
  "message": "QR Code generated successfully",
  "data": {
    "table_id": 1,
    "table_number": "A1",
    "qr_code_url": "https://cdn.mieganas.com/qr/table-a1.png",
    "qr_code_download": "https://api.mieganas.com/download/qr/table-a1.png"
  }
}
```

---

## 💵 Kasir APIs

### 1. Get Pending Orders (for Manual Payment)
**GET** `/kasir/orders/pending`

**Headers:**
```
Authorization: Bearer {token}
```

**Response Success (200):**
```json
{
  "success": true,
  "data": [
    {
      "id": 124,
      "order_number": "MG20250929002",
      "table_number": "B1",
      "total_amount": 45000,
      "total_amount_formatted": "Rp 45.000",
      "payment_method": "cash",
      "payment_status": "pending",
      "items": [
        {
          "menu_name": "Mie Ganas Level 3",
          "quantity": 2,
          "price": 18000,
          "subtotal": 36000
        }
      ],
      "created_at": "2025-09-29T11:00:00Z"
    }
  ]
}
```

---

### 2. Process Payment
**POST** `/kasir/orders/{id}/payment`

**Headers:**
```
Authorization: Bearer {token}
```

**Request Body:**
```json
{
  "payment_method": "cash",
  "cash_received": 50000
}
```

**Response Success (200):**
```json
{
  "success": true,
  "message": "Payment processed successfully",
  "data": {
    "order_id": 124,
    "order_number": "MG20250929002",
    "total_amount": 45000,
    "cash_received": 50000,
    "change": 5000,
    "receipt_number": "RC20250929001",
    "transaction_id": 15
  }
}
```

---

### 3. Print Receipt
**GET** `/kasir/receipts/{transaction_id}/print`

**Headers:**
```
Authorization: Bearer {token}
```

**Response Success (200):**
```json
{
  "success": true,
  "data": {
    "receipt_number": "RC20250929001",
    "order_number": "MG20250929002",
    "restaurant": {
      "name": "Mie Ganas",
      "address": "Jl. Contoh No. 123, Jakarta",
      "phone": "021-12345678"
    },
    "table_number": "B1",
    "cashier": "Kasir 1",
    "items": [
      {
        "name": "Mie Ganas Level 3",
        "quantity": 2,
        "price": 18000,
        "subtotal": 36000
      }
    ],
    "subtotal": 36000,
    "tax": 3600,
    "service_charge": 1800,
    "total": 45000,
    "cash_received": 50000,
    "change": 5000,
    "payment_method": "cash",
    "date": "2025-09-29T11:15:00Z",
    "print_url": "https://api.mieganas.com/kasir/receipts/15/download"
  }
}
```

---

### 4. Create Walk-in Order
**POST** `/kasir/orders/walkin`

**Headers:**
```
Authorization: Bearer {token}
```

**Request Body:**
```json
{
  "table_id": 3,
  "items": [
    {
      "menu_id": 1,
      "quantity": 1,
      "notes": "Extra pedas"
    },
    {
      "menu_id": 4,
      "quantity": 2
    }
  ],
  "payment_method": "cash",
  "cash_received": 50000
}
```

**Response Success (201):**
```json
{
  "success": true,
  "message": "Walk-in order created and paid",
  "data": {
    "order_id": 125,
    "order_number": "MG20250929003",
    "total_amount": 35000,
    "change": 15000,
    "receipt_number": "RC20250929002"
  }
}
```

---

### 5. Get Today's Transactions
**GET** `/kasir/transactions/today`

**Headers:**
```
Authorization: Bearer {token}
```

**Response Success (200):**
```json
{
  "success": true,
  "data": {
    "date": "2025-09-29",
    "summary": {
      "total_transactions": 25,
      "total_cash": 450000,
      "total_qris": 350000,
      "total_revenue": 800000
    },
    "transactions": [
      {
        "id": 15,
        "receipt_number": "RC20250929001",
        "order_number": "MG20250929002",
        "payment_method": "cash",
        "amount": 45000,
        "cash_received": 50000,
        "change": 5000,
        "created_at": "2025-09-29T11:15:00Z"
      }
    ]
  }
}
```

---

### 6. Reprint Receipt
**POST** `/kasir/receipts/{transaction_id}/reprint`

**Headers:**
```
Authorization: Bearer {token}
```

**Response Success (200):**
```json
{
  "success": true,
  "message": "Receipt reprinted successfully",
  "data": {
    "print_url": "https://api.mieganas.com/kasir/receipts/15/download"
  }
}
```

---

## 👔 Pelayan APIs

### 1. Get Active Orders
**GET** `/pelayan/orders`

**Headers:**
```
Authorization: Bearer {token}
```

**Query Parameters:**
- `status` (optional): Filter by status
- `table_number` (optional): Filter by table

**Response Success (200):**
```json
{
  "success": true,
  "data": [
    {
      "id": 123,
      "order_number": "MG20250929001",
      "table_number": "A1",
      "status": "preparing",
      "status_text": "Sedang Disiapkan",
      "payment_status": "paid",
      "total_items": 2,
      "total_amount": 34500,
      "estimated_time": 10,
      "elapsed_time": 5,
      "is_late": false,
      "items": [
        {
          "menu_name": "Mie Ganas Level 1",
          "quantity": 2,
          "notes": "Tanpa bawang"
        }
      ],
      "created_at": "2025-09-29T10:30:00Z"
    }
  ]
}
```

---

### 2. Update Order Status
**PUT** `/pelayan/orders/{id}/status`

**Headers:**
```
Authorization: Bearer {token}
```

**Request Body:**
```json
{
  "status": "ready"
}
```

**Valid status transitions:**
- `processing` → `preparing`
- `preparing` → `ready`
- `ready` → `served`
- `served` → `completed`

**Response Success (200):**
```json
{
  "success": true,
  "message": "Order status updated to ready",
  "data": {
    "order_id": 123,
    "order_number": "MG20250929001",
    "status": "ready",
    "updated_at": "2025-09-29T10:45:00Z"
  }
}
```

---

### 3. Get Table Status
**GET** `/pelayan/tables`

**Headers:**
```
Authorization: Bearer {token}
```

**Response Success (200):**
```json
{
  "success": true,
  "data": [
    {
      "id": 1,
      "table_number": "A1",
      "capacity": 4,
      "status": "occupied",
      "active_orders": 1,
      "current_order": {
        "order_number": "MG20250929001",
        "status": "preparing",
        "total_amount": 34500,
        "created_at": "2025-09-29T10:30:00Z"
      }
    },
    {
      "id": 2,
      "table_number": "A2",
      "capacity": 4,
      "status": "available",
      "active_orders": 0,
      "current_order": null
    }
  ]
}
```

---

### 4. Get Order Detail
**GET** `/pelayan/orders/{id}`

**Headers:**
```
Authorization: Bearer {token}
```

**Response Success (200):**
```json
{
  "success": true,
  "data": {
    "id": 123,
    "order_number": "MG20250929001",
    "table": {
      "id": 1,
      "table_number": "A1",
      "capacity": 4
    },
    "status": "preparing",
    "status_text": "Sedang Disiapkan",
    "payment_status": "paid",
    "payment_method": "qris",
    "items": [
      {
        "id": 1,
        "menu_name": "Mie Ganas Level 1",
        "quantity": 2,
        "price": 15000,
        "subtotal": 30000,
        "notes": "Tanpa bawang",
        "spicy_level": 1
      }
    ],
    "subtotal": 30000,
    "tax": 3000,
    "service_charge": 1500,
    "total": 34500,
    "customer_notes": "Tolong diantar ke meja",
    "estimated_time": 15,
    "created_at": "2025-09-29T10:30:00Z",
    "confirmed_at": "2025-09-29T10:32:00Z",
    "preparing_at": "2025-09-29T10:35:00Z"
  }
}
```

---

### 5. Mark Order as Served
**POST** `/pelayan/orders/{id}/served`

**Headers:**
```
Authorization: Bearer {token}
```

**Response Success (200):**
```json
{
  "success": true,
  "message": "Order marked as served",
  "data": {
    "order_id": 123,
    "order_number": "MG20250929001",
    "status": "served",
    "served_at": "2025-09-29T10:50:00Z"
  }
}
```

---

### 6. Add Kitchen Notes
**POST** `/pelayan/orders/{id}/kitchen-notes`

**Headers:**
```
Authorization: Bearer {token}
```

**Request Body:**
```json
{
  "kitchen_notes": "Customer alergi bawang"
}
```

**Response Success (200):**
```json
{
  "success": true,
  "message": "Kitchen notes added successfully"
}
```

---

## 🔔 Webhook

### Midtrans Payment Notification
**POST** `/webhook/midtrans`

**No Authentication Required** (verified via signature key)

**Request Body (from Midtrans):**
```json
{
  "transaction_time": "2025-09-29 10:33:45",
  "transaction_status": "settlement",
  "transaction_id": "abc123def456",
  "status_message": "midtrans payment notification",
  "status_code": "200",
  "signature_key": "abc123...",
  "payment_type": "qris",
  "order_id": "MG20250929001-1727604825",
  "merchant_id": "G123456789",
  "gross_amount": "34500.00",
  "fraud_status": "accept",
  "currency": "IDR"
}
```

**Response Success (200):**
```json
{
  "success": true,
  "message": "Notification processed"
}
```

**Actions performed:**
- Update `payment_status` to `paid`
- Update `paid_at` timestamp
- Update order `status` from `waiting_payment` to `processing`
- Send push notification to customer
- Send notification to pelayan (new order)

---

## ⚠️ Error Responses

### Standard Error Format

**400 - Bad Request**
```json
{
  "success": false,
  "message": "Validation error",
  "errors": {
    "email": ["The email field is required."],
    "password": ["The password must be at least 8 characters."]
  }
}
```

---

**401 - Unauthorized**
```json
{
  "success": false,
  "message": "Unauthenticated",
  "error_code": "UNAUTHORIZED"
}
```

---

**403 - Forbidden**
```json
{
  "success": false,
  "message": "You don't have permission to access this resource",
  "error_code": "FORBIDDEN"
}
```

---

**404 - Not Found**
```json
{
  "success": false,
  "message": "Resource not found",
  "error_code": "NOT_FOUND"
}
```

---

**422 - Unprocessable Entity**
```json
{
  "success": false,
  "message": "The given data was invalid",
  "errors": {
    "menu_id": ["The selected menu is unavailable."]
  }
}
```

---

**429 - Too Many Requests**
```json
{
  "success": false,
  "message": "Too many requests. Please try again later.",
  "error_code": "RATE_LIMIT_EXCEEDED",
  "retry_after": 60
}
```

---

**500 - Internal Server Error**
```json
{
  "success": false,
  "message": "An error occurred while processing your request",
  "error_code": "INTERNAL_SERVER_ERROR"
}
```

---

## 📱 Push Notification Events

### Event Types & Payloads

#### 1. Order Status Changed
**Event:** `order.status.changed`

**Payload:**
```json
{
  "event": "order.status.changed",
  "data": {
    "order_id": 123,
    "order_number": "MG20250929001",
    "old_status": "processing",
    "new_status": "preparing",
    "table_number": "A1"
  },
  "notification": {
    "title": "Status Pesanan Diperbarui",
    "body": "Pesanan Anda sedang disiapkan",
    "icon": "https://cdn.mieganas.com/icon-cooking.png"
  }
}
```

---

#### 2. Payment Confirmed
**Event:** `payment.confirmed`

**Payload:**
```json
{
  "event": "payment.confirmed",
  "data": {
    "order_id": 123,
    "order_number": "MG20250929001",
    "payment_method": "qris",
    "amount": 34500
  },
  "notification": {
    "title": "Pembayaran Berhasil",
    "body": "Pembayaran Anda telah dikonfirmasi",
    "icon": "https://cdn.mieganas.com/icon-success.png"
  }
}
```

---

#### 3. Order Ready
**Event:** `order.ready`

**Payload:**
```json
{
  "event": "order.ready",
  "data": {
    "order_id": 123,
    "order_number": "MG20250929001",
    "table_number": "A1"
  },
  "notification": {
    "title": "Pesanan Siap!",
    "body": "Pesanan Anda siap diantar ke meja A1",
    "icon": "https://cdn.mieganas.com/icon-ready.png",
    "sound": "default"
  }
}
```

---

#### 4. New Order (for Pelayan)
**Event:** `order.new`

**Payload:**
```json
{
  "event": "order.new",
  "data": {
    "order_id": 124,
    "order_number": "MG20250929002",
    "table_number": "B1",
    "total_items": 3,
    "total_amount": 45000
  },
  "notification": {
    "title": "Pesanan Baru Masuk!",
    "body": "Meja B1 - 3 item - Rp 45.000",
    "icon": "https://cdn.mieganas.com/icon-new-order.png",
    "sound": "notification_sound"
  }
}
```

---

## 🔒 Rate Limiting

| Endpoint Type | Limit | Window |
|---------------|-------|--------|
| Authentication | 5 requests | 1 minute |
| Customer APIs | 60 requests | 1 minute |
| Admin APIs | 120 requests | 1 minute |
| Kasir APIs | 100 requests | 1 minute |
| Pelayan APIs | 100 requests | 1 minute |

---

## 🌐 CORS Policy

**Allowed Origins:**
- `https://mieganas.com`
- `https://www.mieganas.com`
- `https://admin.mieganas.com`
- `http://localhost:3000` (development only)

**Allowed Methods:**
- GET, POST, PUT, DELETE, PATCH, OPTIONS

**Allowed Headers:**
- Content-Type, Authorization, X-Session-Token, X-Requested-With

---

## 📝 Pagination

All list endpoints support pagination with the following parameters:

**Query Parameters:**
- `page` (default: 1)
- `per_page` (default: 15, max: 100)
- `sort_by` (optional)
- `sort_order` (optional: `asc` or `desc`)

**Response Format:**
```json
{
  "success": true,
  "data": {
    "current_page": 1,
    "data": [...],
    "first_page_url": "https://api.mieganas.com/api/v1/menus?page=1",
    "from": 1,
    "last_page": 5,
    "last_page_url": "https://api.mieganas.com/api/v1/menus?page=5",
    "next_page_url": "https://api.mieganas.com/api/v1/menus?page=2",
    "path": "https://api.mieganas.com/api/v1/menus",
    "per_page": 15,
    "prev_page_url": null,
    "to": 15,
    "total": 75
  }
}
```

---

## 🔍 Search & Filter

### General Search Format
Most list endpoints support search with `search` query parameter:

```
GET /api/v1/admin/menus?search=mie%20ganas
```

### Date Range Filtering
```
GET /api/v1/admin/orders?date_from=2025-09-01&date_to=2025-09-30
```

### Multiple Filters
```
GET /api/v1/admin/orders?status=completed&payment_method=qris&date_from=2025-09-29
```

---

## 🎯 Best Practices

### 1. **Use HTTPS**
All API requests must be made over HTTPS in production.

### 2. **Handle Errors Gracefully**
Always check the `success` field and handle errors appropriately.

### 3. **Store Tokens Securely**
- Never expose Bearer tokens in client-side code
- Use secure storage (HttpOnly cookies, encrypted storage)
- Implement token refresh mechanism

### 4. **Validate Before Sending**
Validate data on client-side before making API requests to reduce unnecessary calls.

### 5. **Use Appropriate HTTP Methods**
- GET: Retrieve data
- POST: Create new resources
- PUT/PATCH: Update existing resources
- DELETE: Remove resources

### 6. **Handle Rate Limits**
Implement exponential backoff when receiving 429 responses.

### 7. **Cache When Possible**
Cache menu data, categories, and settings to reduce API calls.

### 8. **Use Webhooks for Real-time Updates**
For payment notifications, use Midtrans webhooks instead of polling.

---

## 🧪 Testing

### Testing Credentials

**Admin:**
- Email: `admin@mieganas.com`
- Password: `password`

**Kasir:**
- Email: `kasir1@mieganas.com`
- Password: `password`

**Pelayan:**
- Email: `pelayan1@mieganas.com`
- Password: `password`

### Test Environment
- **Base URL:** `https://staging.mieganas.com/api/v1`
- **Midtrans:** Sandbox mode enabled

### Midtrans Test Data
**Test QRIS Payment:**
- Scan QR and use Midtrans Simulator app
- Auto-approve after 5 seconds in sandbox

---

## 📞 Support

**API Issues:**
- Email: `api-support@mieganas.com`
- Documentation: `https://docs.mieganas.com`

**Midtrans Integration:**
- Midtrans Docs: `https://docs.midtrans.com`
- Support: `support@midtrans.com`

---

## 📋 Changelog

### Version 1.0 (2025-09-29)
- Initial API release
- Full CRUD for menus and categories
- Customer ordering flow
- Kasir POS system
- Pelayan order tracking
- Midtrans QRIS integration
- Push notification support
- Real-time order tracking

---

**Last Updated:** September 29, 2025  
**API Version:** 1.0  
**Status:** Production Ready ✅