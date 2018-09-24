DROP TABLE IF EXISTS manufacturer;
DROP TABLE IF EXISTS CATEGORY;
DROP TABLE IF EXISTS product;
DROP TABLE IF EXISTS productOptionValue;
DROP TABLE IF EXISTS options;
DROP TABLE IF EXISTS optionValue;
DROP TABLE IF EXISTS customer;
DROP TABLE IF EXISTS address;
DROP TABLE IF EXISTS city;
DROP TABLE IF EXISTS country;

CREATE TABLE manufacturer
(
    id long AUTO_INCREMENT PRIMARY KEY NOT NULL,
    name varchar(20) NOT NULL,
    image varchar(50) not null
);
create table CATEGORY
(
    ID long AUTO_INCREMENT PRIMARY KEY NOT NULL,
    NAME varchar(20) not null,
    category_id long
);

create TABLE product
(
    id long AUTO_INCREMENT PRIMARY KEY NOT NULL,
    name varchar(20) NOT NULL,
    price DECIMAL NOT NULL,
    description varchar(500) not null,
    image varchar(50) not null,
    category_id long not null,
    manufacturer_id long not null
);

create table product_option_value
(
    product_id long PRIMARY KEY NOT NULL,
    optionValue_id long PRIMARY KEY NOT NULL
);

create table options
(
    id long AUTO_INCREMENT PRIMARY KEY NOT NULL,
    name varchar(20) NOT NULL,
);

create table option_value
(
    id long AUTO_INCREMENT PRIMARY KEY NOT NULL,
    name varchar(20) NOT NULL,
    options_id long not null
);

create table customer
(
    id long AUTO_INCREMENT PRIMARY KEY NOT NULL,
    firstname varchar(50) NOT NULL,
    lastname varchar(50) NOT NULL,
    username varchar(20) NOT NULL,
    email varchar(50) NOT NULL,
    birthdate date NOT NULL,
    phone varchar(50) NOT NULL,
    passwordhash varchar(255) NOT NULL,
    salt varchar(255) NOT NULL,
    adress_id long not null
);

create table address
(
    id long AUTO_INCREMENT PRIMARY KEY NOT NULL,
    street varchar(100) NOT null,
    homenumber varchar (20) not null,
    city_id long not null,
    country_id long not null
);

create table city
(
    id long AUTO_INCREMENT PRIMARY KEY NOT NULL,
    zip number not null,
    city varchar(100) not null
);

create table country
(
    id long AUTO_INCREMENT PRIMARY KEY NOT NULL,
    name varchar(255) not null
);

alter table customer add constraint customer_unique_email unique (email);
alter table customer add constraint customer_unique_email unique (username);

alter table CATEGORY add constraint category_foreign_key_category_id foreign key (category_id) references CATEGORY(ID);
alter table product add constraint product_foreign_key_category_id foreign key (category_id) references CATEGORY(ID);
alter table product add constraint product_foreign_key_category_id foreign key (category_id) references CATEGORY(ID);
alter table product add constraint product_foreign_key_manufacturer_id foreign key (manufacturer_id) references manufacturer(ID);
alter table option_value add constraint option_value_foreign_key_options_id foreign key (options_id) references options(ID);
alter table product_option_value add constraint product_option_value_foreign_key_product_id foreign key (product_id) references product(ID);
alter table product_option_value add constraint product_option_value_foreign_key_option_value_id foreign key (option_value_id) references option_value(ID);
alter table address add constraint address_foreign_key_country_id foreign key (country_id) references country(ID);
alter table address add constraint address_foreign_key_city_id foreign key (city_id) references city(ID);
alter table customer add constraint customer_foreign_key_address_id foreign key (address_id) references address(ID);

-- TODO:
-- i18n von description, option, optionValue
-- warenkorb
-- bestellung
