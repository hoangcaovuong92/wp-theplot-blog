mysqldump -d --comments=FALSE -u root wp_woo_charity > 1_schema.sql
mysqldump -t --order-by-primary --comments=FALSE -u root wp_woo_charity > 2_init_data.sql
