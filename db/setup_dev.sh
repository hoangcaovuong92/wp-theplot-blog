mysqladmin -u root drop wp_charity
mysqladmin -u root create wp_charity
mysql -u root wp_charity < 1_schema.sql
mysql -u root wp_charity < 2_init_data.sql
