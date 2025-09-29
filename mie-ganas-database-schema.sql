-- ============================================
-- DATABASE SCHEMA: MIE GANAS
-- DBMS: MySQL 8.0+
-- ============================================

-- Drop tables if exists (untuk development)
DROP TABLE IF EXISTS order_items;
DROP TABLE IF EXISTS orders;
DROP TABLE IF EXISTS cart_items;
DROP TABLE IF EXISTS carts;
DROP TABLE IF EXISTS customer_sessions;
DROP TABLE IF EXISTS menus;
DROP TABLE IF EXISTS categories;
DROP TABLE IF EXISTS tables;
DROP TABLE IF EXISTS transactions;
DROP TABLE IF EXISTS users;

-- ============================================
-- 1. USERS TABLE (Admin, Kasir, Pelayan)
-- ============================================
CREATE TABLE users (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    username VARCHAR(100) UNIQUE,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin', 'kasir', 'pelayan') NOT NULL,
    phone VARCHAR(20),
    is_active BOOLEAN DEFAULT TRUE,
    last_login_at TIMESTAMP NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    
    INDEX idx_role (role),
    INDEX idx_email (email),
    INDEX idx_username (username)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================
-- 2. CATEGORIES TABLE
-- ============================================
CREATE TABLE categories (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    slug VARCHAR(100) UNIQUE NOT NULL,
    description TEXT,
    icon VARCHAR(50), -- untuk icon class (e.g., 'fa-bowl-rice')
    display_order INT DEFAULT 0,
    is_active BOOLEAN DEFAULT TRUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    
    INDEX idx_slug (slug),
    INDEX idx_display_order (display_order)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================
-- 3. MENUS TABLE
-- ============================================
CREATE TABLE menus (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    category_id BIGINT UNSIGNED NOT NULL,
    name VARCHAR(255) NOT NULL,
    slug VARCHAR(255) UNIQUE NOT NULL,
    image_url VARCHAR(500),
    price DECIMAL(10, 2) NOT NULL,
    is_available BOOLEAN DEFAULT TRUE,
    is_recommended BOOLEAN DEFAULT FALSE,
    display_order INT DEFAULT 0,
    sold_count INT DEFAULT 0 COMMENT 'untuk tracking menu terlaris',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    deleted_at TIMESTAMP NULL COMMENT 'soft delete',
    
    FOREIGN KEY (category_id) REFERENCES categories(id) ON DELETE CASCADE,
    INDEX idx_category (category_id),
    INDEX idx_slug (slug),
    INDEX idx_available (is_available),
    INDEX idx_sold_count (sold_count)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================
-- 4. TABLES (Meja Restoran)
-- ============================================
CREATE TABLE tables (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    table_number VARCHAR(10) UNIQUE NOT NULL,
    qr_code_path VARCHAR(500), -- path ke file QR code
    capacity INT DEFAULT 4,
    status ENUM('available', 'occupied', 'reserved') DEFAULT 'available',
    is_active BOOLEAN DEFAULT TRUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    
    INDEX idx_table_number (table_number),
    INDEX idx_status (status)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================
-- 5. CUSTOMER_SESSIONS (Pelanggan tanpa registrasi)
-- ============================================
CREATE TABLE customer_sessions (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    session_token VARCHAR(100) UNIQUE NOT NULL,
    table_id BIGINT UNSIGNED,
    customer_name VARCHAR(255),
    customer_phone VARCHAR(20),
    ip_address VARCHAR(45),
    user_agent TEXT,
    is_active BOOLEAN DEFAULT TRUE,
    last_activity_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    expired_at TIMESTAMP NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    
    FOREIGN KEY (table_id) REFERENCES tables(id) ON DELETE SET NULL,
    INDEX idx_session_token (session_token),
    INDEX idx_table (table_id),
    INDEX idx_active (is_active)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================
-- 6. CARTS (Keranjang Belanja)
-- ============================================
CREATE TABLE carts (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    customer_session_id BIGINT UNSIGNED NOT NULL,
    status ENUM('active', 'converted', 'abandoned') DEFAULT 'active',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    
    FOREIGN KEY (customer_session_id) REFERENCES customer_sessions(id) ON DELETE CASCADE,
    INDEX idx_customer_session (customer_session_id),
    INDEX idx_status (status)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================
-- 7. CART_ITEMS
-- ============================================
CREATE TABLE cart_items (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    cart_id BIGINT UNSIGNED NOT NULL,
    menu_id BIGINT UNSIGNED NOT NULL,
    quantity INT NOT NULL DEFAULT 1,
    price DECIMAL(10, 2) NOT NULL COMMENT 'harga saat item ditambahkan',
    notes TEXT COMMENT 'catatan khusus customer',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    
    FOREIGN KEY (cart_id) REFERENCES carts(id) ON DELETE CASCADE,
    FOREIGN KEY (menu_id) REFERENCES menus(id) ON DELETE CASCADE,
    INDEX idx_cart (cart_id),
    INDEX idx_menu (menu_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================
-- 8. ORDERS
-- ============================================
CREATE TABLE orders (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    order_number VARCHAR(50) UNIQUE NOT NULL,
    customer_session_id BIGINT UNSIGNED NOT NULL,
    table_id BIGINT UNSIGNED,
    
    -- Pricing
    subtotal DECIMAL(10, 2) NOT NULL,
    tax_amount DECIMAL(10, 2) DEFAULT 0,
    service_charge DECIMAL(10, 2) DEFAULT 0,
    discount_amount DECIMAL(10, 2) DEFAULT 0,
    total_amount DECIMAL(10, 2) NOT NULL,
    
    -- Payment
    payment_method ENUM('qris', 'cash', 'debit', 'credit') NOT NULL,
    payment_status ENUM('pending', 'paid', 'failed', 'refunded') DEFAULT 'pending',
    paid_at TIMESTAMP NULL,
    
    -- Midtrans Integration
    midtrans_order_id VARCHAR(100),
    midtrans_transaction_id VARCHAR(100),
    midtrans_snap_token VARCHAR(255),
    midtrans_payment_type VARCHAR(50),
    
    -- Order Status & Tracking
    status ENUM('waiting_payment', 'processing', 'preparing', 'ready', 'served', 'completed', 'cancelled') DEFAULT 'waiting_payment',
    estimated_time INT COMMENT 'estimasi waktu dalam menit',
    
    -- Staff Info
    served_by BIGINT UNSIGNED COMMENT 'pelayan yang melayani',
    processed_by BIGINT UNSIGNED COMMENT 'kasir yang memproses',
    
    -- Notes & Special Requests
    customer_notes TEXT,
    kitchen_notes TEXT,
    cancellation_reason TEXT,
    
    -- Timestamps
    confirmed_at TIMESTAMP NULL,
    preparing_at TIMESTAMP NULL,
    ready_at TIMESTAMP NULL,
    served_at TIMESTAMP NULL,
    completed_at TIMESTAMP NULL,
    cancelled_at TIMESTAMP NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    
    FOREIGN KEY (customer_session_id) REFERENCES customer_sessions(id) ON DELETE CASCADE,
    FOREIGN KEY (table_id) REFERENCES tables(id) ON DELETE SET NULL,
    FOREIGN KEY (served_by) REFERENCES users(id) ON DELETE SET NULL,
    FOREIGN KEY (processed_by) REFERENCES users(id) ON DELETE SET NULL,
    
    INDEX idx_order_number (order_number),
    INDEX idx_customer_session (customer_session_id),
    INDEX idx_table (table_id),
    INDEX idx_payment_status (payment_status),
    INDEX idx_status (status),
    INDEX idx_created_at (created_at),
    INDEX idx_midtrans_order (midtrans_order_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================
-- 9. ORDER_ITEMS
-- ============================================
CREATE TABLE order_items (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    order_id BIGINT UNSIGNED NOT NULL,
    menu_id BIGINT UNSIGNED NOT NULL,
    menu_name VARCHAR(255) NOT NULL COMMENT 'snapshot nama menu',
    quantity INT NOT NULL,
    price DECIMAL(10, 2) NOT NULL COMMENT 'harga per item saat order',
    subtotal DECIMAL(10, 2) NOT NULL COMMENT 'price * quantity',
    notes TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    
    FOREIGN KEY (order_id) REFERENCES orders(id) ON DELETE CASCADE,
    FOREIGN KEY (menu_id) REFERENCES menus(id) ON DELETE CASCADE,
    INDEX idx_order (order_id),
    INDEX idx_menu (menu_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================
-- 10. TRANSACTIONS (Laporan Kas untuk Kasir)
-- ============================================
CREATE TABLE transactions (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    order_id BIGINT UNSIGNED NOT NULL,
    cashier_id BIGINT UNSIGNED NOT NULL,
    
    -- Payment Details
    payment_method ENUM('qris', 'cash', 'debit', 'credit') NOT NULL,
    amount DECIMAL(10, 2) NOT NULL,
    cash_received DECIMAL(10, 2) COMMENT 'uang yang diterima (untuk cash)',
    change_amount DECIMAL(10, 2) COMMENT 'uang kembalian',
    
    -- Receipt
    receipt_number VARCHAR(50) UNIQUE,
    receipt_printed_at TIMESTAMP NULL,
    
    -- Timestamps
    transaction_date DATE NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    
    FOREIGN KEY (order_id) REFERENCES orders(id) ON DELETE CASCADE,
    FOREIGN KEY (cashier_id) REFERENCES users(id) ON DELETE CASCADE,
    
    INDEX idx_order (order_id),
    INDEX idx_cashier (cashier_id),
    INDEX idx_transaction_date (transaction_date),
    INDEX idx_receipt_number (receipt_number)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================
-- 11. NOTIFICATIONS (Push Notification Log)
-- ============================================
CREATE TABLE notifications (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_id BIGINT UNSIGNED COMMENT 'NULL jika untuk customer session',
    customer_session_id BIGINT UNSIGNED,
    order_id BIGINT UNSIGNED,
    
    title VARCHAR(255) NOT NULL,
    body TEXT NOT NULL,
    type ENUM('order_status', 'payment', 'system', 'promotion') NOT NULL,
    
    is_read BOOLEAN DEFAULT FALSE,
    read_at TIMESTAMP NULL,
    
    -- FCM/Push Notification Details
    fcm_token TEXT,
    sent_at TIMESTAMP NULL,
    failed_at TIMESTAMP NULL,
    error_message TEXT,
    
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (customer_session_id) REFERENCES customer_sessions(id) ON DELETE CASCADE,
    FOREIGN KEY (order_id) REFERENCES orders(id) ON DELETE CASCADE,
    
    INDEX idx_user (user_id),
    INDEX idx_customer_session (customer_session_id),
    INDEX idx_order (order_id),
    INDEX idx_is_read (is_read),
    INDEX idx_created_at (created_at)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================
-- 12. SETTINGS (Konfigurasi Aplikasi)
-- ============================================
CREATE TABLE settings (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    key_name VARCHAR(100) UNIQUE NOT NULL,
    value TEXT,
    description TEXT,
    type ENUM('string', 'number', 'boolean', 'json') DEFAULT 'string',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    
    INDEX idx_key_name (key_name)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================
-- SAMPLE DATA / SEEDERS
-- ============================================

-- Insert Admin User
INSERT INTO users (name, email, username, password, role) VALUES
('Admin Mie Ganas', 'admin@mieganas.com', 'admin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin'), -- password: password
('Kasir 1', 'kasir1@mieganas.com', 'kasir1', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'kasir'),
('Pelayan 1', 'pelayan1@mieganas.com', 'pelayan1', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'pelayan');

-- Insert Categories
INSERT INTO categories (name, slug, description, display_order, is_active) VALUES
('Mie Ganas', 'mie-ganas', 'Menu mie pedas khas Mie Ganas', 1, TRUE),
('Minuman', 'minuman', 'Berbagai pilihan minuman segar', 2, TRUE),
('Snack', 'snack', 'Makanan ringan pendamping', 3, TRUE),
('Paket Hemat', 'paket-hemat', 'Paket combo hemat', 4, TRUE);

-- Insert Sample Menus
INSERT INTO menus (category_id, name, slug, description, image_url, price, spicy_level, is_available, is_recommended) VALUES
(1, 'Mie Ganas Level 1', 'mie-ganas-level-1', 'Mie dengan level kepedasan pemula', '/images/mie-level-1.jpg', 15000, 1, TRUE, TRUE),
(1, 'Mie Ganas Level 3', 'mie-ganas-level-3', 'Mie dengan level kepedasan menengah', '/images/mie-level-3.jpg', 18000, 3, TRUE, TRUE),
(1, 'Mie Ganas Level 5', 'mie-ganas-level-5', 'Mie dengan level kepedasan ekstrim', '/images/mie-level-5.jpg', 20000, 5, TRUE, FALSE),
(2, 'Es Teh Manis', 'es-teh-manis', 'Es teh manis segar', '/images/es-teh.jpg', 5000, 0, TRUE, FALSE),
(2, 'Jeruk Dingin', 'jeruk-dingin', 'Jus jeruk segar dingin', '/images/jeruk.jpg', 8000, 0, TRUE, FALSE),
(3, 'Tahu Crispy', 'tahu-crispy', 'Tahu goreng crispy', '/images/tahu-crispy.jpg', 10000, 0, TRUE, FALSE);

-- Insert Tables
INSERT INTO tables (table_number, capacity, status) VALUES
('A1', 4, 'available'),
('A2', 4, 'available'),
('A3', 2, 'available'),
('B1', 6, 'available'),
('B2', 6, 'available');

-- Insert Settings
INSERT INTO settings (key_name, value, description, type) VALUES
('tax_percentage', '10', 'Persentase pajak', 'number'),
('service_charge_percentage', '5', 'Persentase service charge', 'number'),
('restaurant_name', 'Mie Ganas', 'Nama restoran', 'string'),
('restaurant_address', 'Jl. Contoh No. 123, Jakarta', 'Alamat restoran', 'string'),
('restaurant_phone', '021-12345678', 'No telepon restoran', 'string'),
('midtrans_server_key', '', 'Midtrans Server Key', 'string'),
('midtrans_client_key', '', 'Midtrans Client Key', 'string'),
('midtrans_is_production', 'false', 'Midtrans Production Mode', 'boolean');

-- ============================================
-- VIEWS (Optional - untuk laporan)
-- ============================================

-- View untuk daily sales
CREATE OR REPLACE VIEW v_daily_sales AS
SELECT 
    DATE(o.created_at) as sale_date,
    COUNT(DISTINCT o.id) as total_orders,
    SUM(o.total_amount) as total_revenue,
    AVG(o.total_amount) as avg_order_value,
    COUNT(DISTINCT o.customer_session_id) as unique_customers
FROM orders o
WHERE o.payment_status = 'paid' AND o.status IN ('completed', 'served')
GROUP BY DATE(o.created_at);

-- View untuk best selling menu
CREATE OR REPLACE VIEW v_best_selling_menus AS
SELECT 
    m.id,
    m.name,
    c.name as category_name,
    SUM(oi.quantity) as total_sold,
    SUM(oi.subtotal) as total_revenue
FROM order_items oi
JOIN menus m ON oi.menu_id = m.id
JOIN categories c ON m.category_id = c.id
JOIN orders o ON oi.order_id = o.id
WHERE o.payment_status = 'paid'
GROUP BY m.id, m.name, c.name
ORDER BY total_sold DESC;

-- ============================================
-- TRIGGERS (Optional - untuk auto update)
-- ============================================

DELIMITER $$

-- Trigger untuk update sold_count di menu
CREATE TRIGGER after_order_completed
AFTER UPDATE ON orders
FOR EACH ROW
BEGIN
    IF NEW.status = 'completed' AND OLD.status != 'completed' THEN
        UPDATE menus m
        JOIN order_items oi ON m.id = oi.menu_id
        SET m.sold_count = m.sold_count + oi.quantity
        WHERE oi.order_id = NEW.id;
    END IF;
END$$

-- Trigger untuk update table status
CREATE TRIGGER after_order_created
AFTER INSERT ON orders
FOR EACH ROW
BEGIN
    IF NEW.table_id IS NOT NULL THEN
        UPDATE tables SET status = 'occupied' WHERE id = NEW.table_id;
    END IF;
END$$

CREATE TRIGGER after_order_finished
AFTER UPDATE ON orders
FOR EACH ROW
BEGIN
    IF NEW.status IN ('completed', 'cancelled') AND NEW.table_id IS NOT NULL THEN
        -- Check if there are no other active orders for this table
        IF (SELECT COUNT(*) FROM orders 
            WHERE table_id = NEW.table_id 
            AND status NOT IN ('completed', 'cancelled')) = 0 THEN
            UPDATE tables SET status = 'available' WHERE id = NEW.table_id;
        END IF;
    END IF;
END$$

DELIMITER ;

-- ============================================
-- END OF SCHEMA
-- ============================================