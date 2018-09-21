DROP TABLE IF EXISTS manufacturer;
DROP TABLE IF EXISTS CATEGORY;
DROP TABLE IF EXISTS product;
DROP TABLE IF EXISTS parachute;

CREATE TABLE manufacturer
(
    id long AUTO_INCREMENT PRIMARY KEY NOT NULL,
    name varchar(20) NOT NULL
);
create table CATEGORY
(
    ID long AUTO_INCREMENT PRIMARY KEY NOT NULL,
    NAME varchar(20) not null
);

create TABLE product
(
    id long AUTO_INCREMENT PRIMARY KEY NOT NULL,
    name varchar(20) NOT NULL,
    price DECIMAL NOT NULL
)

CREATE TABLE parachute
(
    id long AUTO_INCREMENT PRIMARY KEY NOT NULL,
    product_id long, FOREIGN KEY (product_id) REFERENCES product (id),
    cell int NOT NULL,
    manufacturer_id long, FOREIGN KEY (manufacturer_id) REFERENCES manufacturer(id)
);
