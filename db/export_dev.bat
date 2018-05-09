D:\wamp64\bin\mysql\mysql5.7.19\bin\mysqldump -d --comments=FALSE -u root woo_no_one_blog  > 1_schema.sql
D:\wamp64\bin\mysql\mysql5.7.19\bin\mysqldump -t --order-by-primary --comments=FALSE -u root woo_no_one_blog  > 2_init_data.sql
