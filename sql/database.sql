CREATE DATABASE lalitpur_bags;

USE lalitpur_bags;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100),
    email VARCHAR(100) UNIQUE,
    password VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE repair_requests (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    bag_type VARCHAR(50),
    issue_type VARCHAR(50),
    image_path VARCHAR(255),
    calendar_date DATE,
    location VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE orders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    item VARCHAR(100),
    quantity INT,
    total_price DECIMAL(10, 2),
    status VARCHAR(50),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE blogs (
id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    content TEXT NOT NULL,
    author VARCHAR(100),
    image VARCHAR(255),
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE purchase_history (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    item VARCHAR(100),
    amount DECIMAL(10, 2),
    purchased_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE feedback (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100),
  email VARCHAR(100),
  message TEXT NOT NULL,
  submitted_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE products (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100),
  price DECIMAL(10,2),
  description TEXT,
  image_path VARCHAR(255),
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
CREATE TABLE product_reviews (
  id INT AUTO_INCREMENT PRIMARY KEY,
  product_id INT,
  user_id INT,
  rating INT CHECK (rating >= 1 AND rating <= 5),
  comment TEXT,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
CREATE TABLE product_categories (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100) UNIQUE,
  description TEXT,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
CREATE TABLE product_category_mapping (
  id INT AUTO_INCREMENT PRIMARY KEY,
  product_id INT,
  category_id INT,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  UNIQUE (product_id, category_id)
);
CREATE TABLE product_images (
  id INT AUTO_INCREMENT PRIMARY KEY,
  product_id INT,
  image_path VARCHAR(255),
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
CREATE TABLE product_tags (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100) UNIQUE,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
CREATE TABLE product_tag_mapping (
    id INT AUTO_INCREMENT PRIMARY KEY,
    product_id INT,
    tag_id INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    UNIQUE (product_id, tag_id)
);
CREATE TABLE product_variants (
  id INT AUTO_INCREMENT PRIMARY KEY,
  product_id INT,
  variant_name VARCHAR(100),
  price DECIMAL(10,2),
  stock INT DEFAULT 0,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
CREATE TABLE product_variant_images (
  id INT AUTO_INCREMENT PRIMARY KEY,
  variant_id INT,
  image_path VARCHAR(255),
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
CREATE TABLE product_variant_options (
  id INT AUTO_INCREMENT PRIMARY KEY,
  variant_id INT,
  option_name VARCHAR(100),
  option_value VARCHAR(100),
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
CREATE TABLE product_variant_option_mapping (
  id INT AUTO_INCREMENT PRIMARY KEY,
  variant_id INT,
  option_id INT,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  UNIQUE (variant_id, option_id)
);
CREATE TABLE product_inventory (
  id INT AUTO_INCREMENT PRIMARY KEY,
  product_id INT,
  stock INT DEFAULT 0,
  reserved_stock INT DEFAULT 0,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
CREATE TABLE product_inventory_history (
    id INT AUTO_INCREMENT PRIMARY KEY,
    product_id INT,
    change_type ENUM('addition', 'removal') NOT NULL,
    change_amount INT NOT NULL,
    change_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    notes TEXT
);
CREATE TABLE product_wishlist (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT,
  product_id INT,
  added_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  UNIQUE (user_id, product_id)
);
CREATE TABLE product_cart (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT,
  product_id INT,
  quantity INT DEFAULT 1,
  added_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  UNIQUE (user_id, product_id)
);
CREATE TABLE product_cart_history (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT,
  product_id INT,
  quantity INT DEFAULT 1,
  action ENUM('added', 'removed') NOT NULL,
  action_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE product_promotions (
  id INT AUTO_INCREMENT PRIMARY KEY,
  product_id INT,
  promotion_type ENUM('discount', 'buy_one_get_one', 'free_shipping') NOT NULL,
  discount_amount DECIMAL(10,2),
  start_date DATE,
  end_date DATE,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
CREATE TABLE product_related_products (
  id INT AUTO_INCREMENT PRIMARY KEY,
  product_id INT,
  related_product_id INT,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  UNIQUE (product_id, related_product_id)
);
CREATE TABLE product_faq (
    id INT AUTO_INCREMENT PRIMARY KEY,
    product_id INT,
    question TEXT NOT NULL,
    answer TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
CREATE TABLE product_shipping_options (
    id INT AUTO_INCREMENT PRIMARY KEY,
    product_id INT,
    shipping_method VARCHAR(100),
    shipping_cost DECIMAL(10,2),
    estimated_delivery_days INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
CREATE TABLE product_return_policy (
    id INT AUTO_INCREMENT PRIMARY KEY,
    product_id INT,
    return_period_days INT,
    restocking_fee DECIMAL(10,2),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE admins (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100),
    email VARCHAR(100) UNIQUE,
    password VARCHAR(255)
);
CREATE TABLE admin_logs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    admin_id INT,
    action VARCHAR(255),
    action_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    details TEXT
);
CREATE TABLE product_sales (
    id INT AUTO_INCREMENT PRIMARY KEY,
    product_id INT,
    sale_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    quantity_sold INT,
    total_revenue DECIMAL(10,2)
);
CREATE TABLE product_stock_alerts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    product_id INT,
    alert_threshold INT,
    alert_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    message TEXT
);
CREATE TABLE product_bulk_uploads (
    id INT AUTO_INCREMENT PRIMARY KEY,
    admin_id INT,
    file_path VARCHAR(255),
    upload_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    status ENUM('pending', 'completed', 'failed') DEFAULT 'pending',
    error_message TEXT
);

CREATE TABLE product_bulk_upload_errors (
    id INT AUTO_INCREMENT PRIMARY KEY,
    upload_id INT,
    row_number INT,
    error_message TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
CREATE TABLE product_bulk_upload_history (
    id INT AUTO_INCREMENT PRIMARY KEY,
    upload_id INT,
    processed_rows INT,
    successful_rows INT,
    failed_rows INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
CREATE TABLE product_bulk_upload_templates (
    id INT AUTO_INCREMENT PRIMARY KEY,
    template_name VARCHAR(100),
    template_description TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
CREATE TABLE product_bulk_upload_template_fields (
    id INT AUTO_INCREMENT PRIMARY KEY,
    template_id INT,
    field_name VARCHAR(100),
    field_type ENUM('text', 'number', 'date', 'boolean') NOT NULL,
    is_required BOOLEAN DEFAULT FALSE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
