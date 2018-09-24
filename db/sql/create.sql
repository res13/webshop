drop table if exists manufacturer;
drop table if exists category;
drop table if exists product;
drop table if exists product_option_value;
drop table if exists options;
drop table if exists option_value;
drop table if exists customer;
drop table if exists address;
drop table if exists city;
drop table if exists country;
drop table if exists i18n;
drop table if exists basket;
drop table if exists orders;
drop table if exists product_order;

create table manufacturer
(
    id integer auto_increment primary key not null,
    name varchar(50) not null,
    image varchar(50) not null
);

create table category
(
    id integer auto_increment primary key not null,
    name_i18n_id integer not null,
    category_id integer
);

create table product
(
    id integer auto_increment primary key not null,
    productnumber integer not null,
    pname varchar(50) not null,
    price decimal(10,2) not null,
    description_i18n_id integer not null,
    image varchar(50) not null,
    category_id integer not null,
    manufacturer_id integer not null
);

create table product_option_value
(
    product_id integer not null,
    optionvalue_id integer not null,
    primary key (product_id, optionvalue_id)
);

create table options
(
    id integer auto_increment primary key not null,
    name_i18n_id integer not null
);

create table option_value
(
    id integer auto_increment primary key not null,
    name_i18n_id integer not null,
    options_id integer not null
);

create table customer
(
    id integer auto_increment primary key not null,
    firstname varchar(50) not null,
    lastname varchar(50) not null,
    username varchar(20) not null,
    email varchar(255) not null,
    birthdate date not null,
    phone varchar(50) not null,
    passwordhash varchar(255) not null,
    salt char(10) not null,
    address_id integer not null
);

create table address
(
    id integer auto_increment primary key not null,
    street varchar(100) not null,
    homenumber varchar (20) not null,
    city_id integer not null,
    country_id integer not null
);

create table city
(
    id integer auto_increment primary key not null,
    zip integer not null,
    city varchar(100) not null
);

create table country
(
    id integer auto_increment primary key not null,
    name varchar(255) not null
);

create table i18n
(
    id integer auto_increment primary key not null,
    text_de varchar(255) not null,
    text_en varchar(255) not null
);

create table basket
(
    id integer auto_increment primary key not null,
    customer_id integer not null,
    product_id integer not null,
    quantity integer default 1
);

create table orders
(
    id integer auto_increment primary key not null,
    customer_id integer not null,
    billingfirstname varchar(50) not null,
    billinglastname varchar(50) not null,
    billingaddress_id integer not null,
    deliveryfirstname varchar(50),
    deliverylastname varchar(50),
    deliveryaddress_id integer,
    purchasedate datetime not null,
    paymentmethod tinyint(1) not null,
    state tinyint(1) not null
);

create table product_order
(
    id integer auto_increment primary key not null,
    orders_id integer not null,
    product_id integer not null,
    pname varchar(50) not null,
    price decimal(10,2) not null,
    quantity integer not null
);

alter table customer add constraint customer_unique_email unique (email);
alter table customer add constraint customer_unique_username unique (username);
alter table category add constraint category_foreign_key_category_id foreign key (category_id) references category(id);
alter table product add constraint product_foreign_key_category_id foreign key (category_id) references category(id);
alter table product add constraint product_foreign_key_manufacturer_id foreign key (manufacturer_id) references manufacturer(id);
alter table option_value add constraint option_value_foreign_key_options_id foreign key (options_id) references options(id);
alter table product_option_value add constraint product_option_value_foreign_key_product_id foreign key (product_id) references product(id);
alter table product_option_value add constraint product_option_value_foreign_key_optionvalue_id foreign key (optionvalue_id) references option_value(id);
alter table address add constraint address_foreign_key_country_id foreign key (country_id) references country(id);
alter table address add constraint address_foreign_key_city_id foreign key (city_id) references city(id);
alter table customer add constraint customer_foreign_key_address_id foreign key (address_id) references address(id);
alter table product add constraint product_foreign_key_description_i18n_id foreign key (description_i18n_id) references i18n(id);
alter table options add constraint options_foreign_key_name_i18n_id foreign key (name_i18n_id) references i18n(id);
alter table option_value add constraint option_value_foreign_key_name_i18n_id foreign key (name_i18n_id) references i18n(id);
alter table category add constraint category_foreign_key_name_i18n_id foreign key (name_i18n_id) references i18n(id);
alter table basket add constraint basket_foreign_key_customer_id foreign key (customer_id) references customer(id);
alter table basket add constraint basket_foreign_key_product_id foreign key (product_id) references product(id);
alter table orders add constraint orders_foreign_key_customer_id foreign key (customer_id) references customer(id);
alter table orders add constraint orders_foreign_key_billingaddress_id foreign key (billingaddress_id) references address(id);
alter table orders add constraint orders_foreign_key_deliveryaddress_id foreign key (deliveryaddress_id) references address(id);
alter table product_order add constraint product_order_foreign_key_orders_id foreign key (orders_id) references orders(id);
alter table product_order add constraint product_order_foreign_key_product_id foreign key (product_id) references product(id);