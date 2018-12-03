-- DDL
drop table if exists product_option_value;
drop table if exists option_value;
drop table if exists options;
drop table if exists product_orders;
drop table if exists orders;
drop table if exists person;
drop table if exists address;
drop table if exists city;
drop table if exists country;
drop table if exists product;
drop table if exists category;
drop table if exists i18n;
drop table if exists manufacturer;
drop table if exists role;

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

create table role
(
  id integer auto_increment primary key not null,
  name varchar(10) not null
);

create table person
(
  id integer auto_increment primary key not null,
  firstname varchar(50) not null,
  lastname varchar(50) not null,
  username varchar(20) not null,
  email varchar(255) not null,
  birthdate date not null,
  phone varchar(50) not null,
  passwordhash varchar(255) not null,
  address_id integer not null,
  role_id integer not null,
  lang varchar(2) not null,
  resetpassword tinyint(1) default 0
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
  text_de text not null,
  text_en text not null
);

create table orders
(
  id integer auto_increment primary key not null,
  person_id integer not null,
  billingfirstname varchar(50),
  billinglastname varchar(50),
  billingaddress_id integer,
  deliveryfirstname varchar(50),
  deliverylastname varchar(50),
  deliveryaddress_id integer,
  purchasedate datetime,
  paymentmethod tinyint(1),
  state tinyint(1) not null default 0
);

create table product_orders
(
  id integer auto_increment primary key not null,
  orders_id integer not null,
  product_id integer not null,
  pname varchar(50) not null,
  price decimal(10,2) not null,
  quantity integer not null
);

create table product_orders_option_value
(
  productorders_id integer not null,
  optionvalue_id integer not null
);

alter table person add constraint person_unique_email unique (email);
alter table person add constraint person_unique_username unique (username);
alter table category add constraint category_foreign_key_category_id foreign key (category_id) references category(id);
alter table product add constraint product_foreign_key_category_id foreign key (category_id) references category(id);
alter table product add constraint product_foreign_key_manufacturer_id foreign key (manufacturer_id) references manufacturer(id);
alter table option_value add constraint option_value_foreign_key_options_id foreign key (options_id) references options(id);
alter table product_option_value add constraint product_option_value_foreign_key_product_id foreign key (product_id) references product(id);
alter table product_option_value add constraint product_option_value_foreign_key_optionvalue_id foreign key (optionvalue_id) references option_value(id);
alter table address add constraint address_foreign_key_country_id foreign key (country_id) references country(id);
alter table address add constraint address_foreign_key_city_id foreign key (city_id) references city(id);
alter table person add constraint person_foreign_key_address_id foreign key (address_id) references address(id);
alter table person add constraint person_foreign_key_role_id foreign key (role_id) references role(id);
alter table product add constraint product_foreign_key_description_i18n_id foreign key (description_i18n_id) references i18n(id);
alter table options add constraint options_foreign_key_name_i18n_id foreign key (name_i18n_id) references i18n(id);
alter table option_value add constraint option_value_foreign_key_name_i18n_id foreign key (name_i18n_id) references i18n(id);
alter table category add constraint category_foreign_key_name_i18n_id foreign key (name_i18n_id) references i18n(id);
alter table orders add constraint orders_foreign_key_person_id foreign key (person_id) references person(id);
alter table orders add constraint orders_foreign_key_billingaddress_id foreign key (billingaddress_id) references address(id);
alter table orders add constraint orders_foreign_key_deliveryaddress_id foreign key (deliveryaddress_id) references address(id);
alter table product_orders add constraint product_orders_foreign_key_orders_id foreign key (orders_id) references orders(id) on delete cascade;
alter table product_orders add constraint product_orders_foreign_key_product_id foreign key (product_id) references product(id) on delete cascade;
alter table product_orders_option_value add constraint product_orders_option_value_foreign_key_product_orders_id foreign key (productorders_id) references product_orders(id) on delete cascade;
alter table product_orders_option_value add constraint product_orders_option_value_foreign_key_optionvalue_id foreign key (optionvalue_id) references option_value(id) on delete cascade;

-- DML
INSERT INTO i18n (id, text_de, text_en) VALUES (14, 'xxx', 'So you''ve decided model step it up from your Sabre2? You''re in the right place! The Katana is a fully elliptical nine cell canopy that is the ride of a lifetime for the experienced canopy pilot. Warning: this canopy is not for the faint of heart. Soft smooth openings, long control range, steep dive, light front riser pressure and a powerful flare make the Katana an excellent choice for those looking for the engine model push their limits. Whether you''re considering an 83 or a 170 square foot wing, the Katana can provide the canopy enthusiast with the ride they are looking for now, and will continue model challenge their piloting skills for years model come.');
INSERT INTO i18n (id, text_de, text_en) VALUES (15, 'xxx', 'From openings model landings, the Pulse is stress-free fun. It is a lightly-elliptical 9-cell canopy designed for the novice model experienced fun jumper. Pack volume has been reduced significantly by combining our proprietary low bulk fabric technology with our well-known Zero-P fabric. The Pulse offers soft, consistently on-heading openings with a shorter snivel. It has a very flat glide, short recovery arc, and easy landings. It is highly responsive, very capable, and lots of fun model fly!');
INSERT INTO i18n (id, text_de, text_en) VALUES (16, 'xxx', 'The Sabre2 is a powerful semi-elliptical 9-cell canopy that is a great choice for current intermediate and experienced jumpers. Our most popular all-around canopy, the Sabre2 feels aggressive at higher wing loadings but is quite tame when lightly loaded. This canopy is best known for its powerful flare and wide speed range. With neat packing and proper deployment technique, Sabre2 openings are consistently soft and predictable. The Sabre2 has a steeper glide and a longer recovery arc than the flatter gliding Pulse or Stiletto and is an excellent choice for those wanting a bit more aggressive piloting experience but are not interested in the demands of the Katana or Velocity.');
INSERT INTO i18n (id, text_de, text_en) VALUES (17, 'xxx', 'The Velocity''s rigid crossbraced structure and extremely responsive controls make it a long-standing staple in the high-performance canopy piloting community. Incredibly clean aerodynamics give this powerful wing a wide speed range and amazing performance opportunities when in the right hands. From opening model landing this is a very capable but very demanding canopy.');
INSERT INTO i18n (id, text_de, text_en) VALUES (18, 'xxx', 'The Optimum Reserve is made from a 30 denier low-permeability, low-bulk fabric available exclusively from Performance Designs. We''ve combined this fabric with special aerodynamics and extensive reinforcing model create great strength, better performance, and a far smaller pack volume for a given size. The Optimums are rated for maximum exit weights ranging from 220 pound model as much as 290 pounds! This reserve has successfully been drop-tested at weights and speeds considerably higher than those required for FAA certification according model TSO C23d, the highest standard model-date. The Optimum flies and lands far more like a main parachute with a more powerful flare, by a wide margin, than any reserve we have ever tried.');
INSERT INTO i18n (id, text_de, text_en) VALUES (19, 'xxx', 'Looking for a tough, highly capable reserve that has stood the test of time? How does a 25+ year track record and 45,000 PD reserves in use work for you? The PD Reserve is our best selling canopy of time, trusted by pilots all over the world as their last-resort canopy. It is known for responsive flight characteristics, predictable handling, excellent glide in the brakes, and outstanding landings. Designed and built with every potential situation in mind, we tested well beyond the maximum weight and speed limits required for TSO certification. If you want proven reliability, the PD Reserve is for you.');
INSERT INTO i18n (id, text_de, text_en) VALUES (20, 'xxx', 'Performance Designs is venturing into the world of BASE. PD BASE. Since 2000, Performance Designs has been building the Ace and Blackjack BASE canopies for Consolidated Rigging. Building on the legacy and great reputation of Consolidated Rigging''s BASE canopies, PD is excited model introduce the Proxy. Our mission was model build the ideal canopy for wingsuit BASE and alpine flying. We wanted something that was low volume, low weight and high performing. We went model great lengths model exceed your expectations of what a low volume BASE canopy can be. With over 30% less volume and 20% less weight than standard construction BASE canopies, jumpers who desire the lightest and lowest profile container will love the Proxy. Whether you''re hiking up that mountain or flying that line, you''ll notice the reduced weight and drag. The Proxy is also a great flying canopy, with good on heading performance, a truly excellent glide ratio and powerful flare.');
INSERT INTO i18n (id, text_de, text_en) VALUES (21, 'xxx', 'The Safire 3 is the result of five years of research, development and refinement. She is the most modern mainstream all-rounder canopy model hit the market.She’s not just different. She’s a beginner and intermediate wing that let’s you take advantage of parametric design software and Computational Fluid Dynamics technologies used formerly only in high performance wings. She’s been engineered model fly better. More efficiently. More responsively. Safire pilots will find her completely familiar, but entirely revolutionary.She has all the things you love about the Safire 2 – great openings, safe predictable flight, a short recovery arc and a smooth flare – and everything else you asked us for.You wanted the same consistent openings. We made them smoother and more progressive. You wanted model have more range. We made the Safire 3 more efficient and gave you the glide model get back from that long spot. You wanted more fun. We made all her inputs more responsive. You wanted even more flare. We found a balance of more power, without inducing an early stall.The Safire 3 is perfect for your first canopy or a fun intermediate canopy at slightly higher wingloadings. We recommend loading her between 0.8 and 1.5. She’s available in any size you want, so you can load her exactly what you want. If you’re not sure, ask us.Loaded lightly she is the vehicle model carry any beginner or even the most nervous canopy pilot model the ground safely, and for the intermediate jumper she will make your flying experience come alive with quick turns and a powerful flare.If you’re looking for superior opening qualities, outstanding slow flight stability and confidence-inspiring flight, the Safire 3 is your perfect choice.');
INSERT INTO i18n (id, text_de, text_en) VALUES (22, 'xxx', 'Unparalleled openings, a longer recovery arc and incredible swoop distance combine in a 9-cell fully elliptical wing that''s 100% devoted model the art of having fun. If you''re ready model step it up a notch from your Safire or want model upgrade your Crossfire 2, the Crossfire 3 is for you. She''s fun model fly at docile wingloadings between 1.0 and 1.4 for the confident intermediate pilot, but we recommend a wingloading between 1.5 and 2.0 for maximum performance. Simply put, the Crossfire 3 is the all-round maestro from the Icarus Canopies range. She will have you flying long and high, turf surfing, or coming in hot for your first swoops across the pond. It''s time model take model the sky the way you were meant model, on a 9-cell sports machine that keeps it as real as you do.');
INSERT INTO i18n (id, text_de, text_en) VALUES (23, 'xxx', 'Sink steep approaches into technical BASE LZs with ease. This new design offers deep-brake and slow-flight performance in an agile, lightweight, and efficient design with tight handling and improved glide & flare performance. HAYDUKE is an ultralite & low-bulk parachute. HAYDUKE represents what we think is an ideal balance of performance and passive safety. HAYDUKE offers improved glide, yet retains the benefit of slow forward speed in DBS. The result: more time for object avoidance in the case of an off-heading, with agile handling that allows for fast, easy, and efficient (low sink rate) turns using risers or brakes.');
INSERT INTO i18n (id, text_de, text_en) VALUES (24, 'xxx', 'The OUTLAW is a versatile BASE canopy that excels in technical landing areas. It contains real innovations in BASE canopy design that can be seen and experienced. The OUTLAW is not designed especially for only one type of jumping. Instead of creating a highly-specialized canopy, our focus was on a new type of versatility made possible by low freefall specific features and reefing devices for terminal openings. The OUTLAW is a user-friendly design that performs well in a vast range of applications for all qualified jumpers.');
INSERT INTO i18n (id, text_de, text_en) VALUES (25, 'xxx', 'The EPICENE PRO delivers the same consistent and reliable openings, with improved glide and flare performance. The EPICENE series is the most popular choice among the world''s best wingsuit pilots, with a reputation for the best openings in wingsuit skydiving. Since 2014 we have been listening model feedback from our team and our customers, and the EPICENE PRO is the result. We believe the EPICENE concept is the future of wingsuit skydive parachute design.');
INSERT INTO i18n (id, text_de, text_en) VALUES (1, 'Fallschirm', 'Parachute');
INSERT INTO i18n (id, text_de, text_en) VALUES (2, 'Haupt', 'Main');
INSERT INTO i18n (id, text_de, text_en) VALUES (3, 'Reserve', 'Reserve');
INSERT INTO i18n (id, text_de, text_en) VALUES (4, 'BASE', 'BASE');
INSERT INTO i18n (id, text_de, text_en) VALUES (5, 'Grösse', 'Size');
INSERT INTO i18n (id, text_de, text_en) VALUES (6, '260', '260');
INSERT INTO i18n (id, text_de, text_en) VALUES (7, '230', '230');
INSERT INTO i18n (id, text_de, text_en) VALUES (8, '210', '210');
INSERT INTO i18n (id, text_de, text_en) VALUES (9, '190', '190');
INSERT INTO i18n (id, text_de, text_en) VALUES (10, '170', '170');
INSERT INTO i18n (id, text_de, text_en) VALUES (11, '150', '150');
INSERT INTO i18n (id, text_de, text_en) VALUES (12, '135', '135');
INSERT INTO i18n (id, text_de, text_en) VALUES (13, '120', '120');
INSERT INTO i18n (id, text_de, text_en) VALUES (26, '107', '107');
INSERT INTO i18n (id, text_de, text_en) VALUES (27, '97', '97');
INSERT INTO i18n (id, text_de, text_en) VALUES (28, '89', '89');
INSERT INTO i18n (id, text_de, text_en) VALUES (29, '83', '83');
INSERT INTO i18n (id, text_de, text_en) VALUES (30, '111', '111');
INSERT INTO i18n (id, text_de, text_en) VALUES (31, '103', '103');
INSERT INTO i18n (id, text_de, text_en) VALUES (32, '96', '96');
INSERT INTO i18n (id, text_de, text_en) VALUES (33, '90', '90');
INSERT INTO i18n (id, text_de, text_en) VALUES (34, '84', '84');
INSERT INTO i18n (id, text_de, text_en) VALUES (35, '79', '79');
INSERT INTO i18n (id, text_de, text_en) VALUES (36, '75', '75');
INSERT INTO i18n (id, text_de, text_en) VALUES (37, '280', '280');
INSERT INTO i18n (id, text_de, text_en) VALUES (38, '240', '240');
INSERT INTO i18n (id, text_de, text_en) VALUES (39, '220', '220');
INSERT INTO i18n (id, text_de, text_en) VALUES (40, '200', '200');
INSERT INTO i18n (id, text_de, text_en) VALUES (41, 'Produkte', 'Products');
INSERT INTO country (id, name) VALUES (1, 'Switzerland');
INSERT INTO city (id, zip, city) VALUES (1, 3000, 'Bern');
INSERT INTO address (id, street, homenumber, city_id, country_id) VALUES (1, 'Bernstrasse', '1', 1, 1);
INSERT INTO address (id, street, homenumber, city_id, country_id) VALUES (2, 'Hauptstrasse', '12a', 1, 1);
INSERT INTO category (id, name_i18n_id, category_id) VALUES (5, 41, null);
INSERT INTO category (id, name_i18n_id, category_id) VALUES (1, 1, 5);
INSERT INTO category (id, name_i18n_id, category_id) VALUES (2, 2, 1);
INSERT INTO category (id, name_i18n_id, category_id) VALUES (3, 3, 1);
INSERT INTO category (id, name_i18n_id, category_id) VALUES (4, 4, 1);
INSERT INTO manufacturer (id, name, image) VALUES (1, 'Performance Design', '/images/manufacturer/performance.jpg');
INSERT INTO manufacturer (id, name, image) VALUES (2, 'NZ Aerosport', '/images/manufacturers/nz.jpg');
INSERT INTO manufacturer (id, name, image) VALUES (3, 'Squirrel', '/images/manufacturers/squirrel.jpg');
INSERT INTO options (id, name_i18n_id) VALUES (1, 5);
INSERT INTO option_value (id, name_i18n_id, options_id) VALUES (1, 6, 1);
INSERT INTO option_value (id, name_i18n_id, options_id) VALUES (2, 7, 1);
INSERT INTO option_value (id, name_i18n_id, options_id) VALUES (3, 8, 1);
INSERT INTO option_value (id, name_i18n_id, options_id) VALUES (4, 9, 1);
INSERT INTO option_value (id, name_i18n_id, options_id) VALUES (5, 10, 1);
INSERT INTO option_value (id, name_i18n_id, options_id) VALUES (6, 11, 1);
INSERT INTO option_value (id, name_i18n_id, options_id) VALUES (7, 12, 1);
INSERT INTO option_value (id, name_i18n_id, options_id) VALUES (8, 13, 1);
INSERT INTO option_value (id, name_i18n_id, options_id) VALUES (9, 26, 1);
INSERT INTO option_value (id, name_i18n_id, options_id) VALUES (10, 27, 1);
INSERT INTO option_value (id, name_i18n_id, options_id) VALUES (11, 28, 1);
INSERT INTO option_value (id, name_i18n_id, options_id) VALUES (12, 29, 1);
INSERT INTO option_value (id, name_i18n_id, options_id) VALUES (13, 30, 1);
INSERT INTO option_value (id, name_i18n_id, options_id) VALUES (14, 31, 1);
INSERT INTO option_value (id, name_i18n_id, options_id) VALUES (15, 32, 1);
INSERT INTO option_value (id, name_i18n_id, options_id) VALUES (16, 33, 1);
INSERT INTO option_value (id, name_i18n_id, options_id) VALUES (17, 34, 1);
INSERT INTO option_value (id, name_i18n_id, options_id) VALUES (18, 35, 1);
INSERT INTO option_value (id, name_i18n_id, options_id) VALUES (19, 36, 1);
INSERT INTO option_value (id, name_i18n_id, options_id) VALUES (20, 37, 1);
INSERT INTO option_value (id, name_i18n_id, options_id) VALUES (21, 38, 1);
INSERT INTO option_value (id, name_i18n_id, options_id) VALUES (22, 39, 1);
INSERT INTO option_value (id, name_i18n_id, options_id) VALUES (23, 40, 1);
INSERT INTO role (id, name) VALUES (1, 'client');
INSERT INTO role (id, name) VALUES (2, 'admin');
INSERT INTO person(id, firstname, lastname, username, email, birthdate, phone, passwordhash, address_id, role_id, lang) VALUES (1,'Andreas','Erb','res13','andreas.erb@gmx.ch','1993-11-13','0041797951835','$2y$10$KM9VWsN6O4m6iE/robealePEimKXL0NggwnR2ER9CMuMMUWyRRhjG',1, 2, 'de');
INSERT INTO person(id, firstname, lastname, username, email, birthdate, phone, passwordhash, address_id, role_id, lang) VALUES (2,'Nik','Test','nik','nik@nik.ch','1990-01-21','0041791234567','$2y$10$KM9VWsN6O4m6iE/robealePEimKXL0NggwnR2ER9CMuMMUWyRRhjG',2, 2, 'de');
INSERT INTO person(id, firstname, lastname, username, email, birthdate, phone, passwordhash, address_id, role_id, lang) VALUES (3,'Admin','Admin','admin','admin@parachute-ch','1994-05-25','0041791234567','$2y$10$m9Uuxf6s8FbrBziOcoa93u4VHidRNGGQt9lkRN2T5RSc263Y6Gh7C',2, 2, 'de');
INSERT INTO product (id, productnumber, pname, price, description_i18n_id, image, category_id, manufacturer_id) VALUES (NULL, '1', 'Katana', '2350', '14', 'img/products/katana.jpg', '2', '1');
INSERT INTO product (id, productnumber, pname, price, description_i18n_id, image, category_id, manufacturer_id) VALUES (NULL, '2', 'Pulse', '2320', '15', 'img/products/pulse.jpg', '2', '1');
INSERT INTO product (id, productnumber, pname, price, description_i18n_id, image, category_id, manufacturer_id) VALUES (NULL, '3', 'Sabre2', '2330', '16', 'img/products/sabre2.jpg', '2', '1');
INSERT INTO product (id, productnumber, pname, price, description_i18n_id, image, category_id, manufacturer_id) VALUES (NULL, '4', 'Velocity', '3025', '17', 'img/products/velocity.jpg', '2', '1');
INSERT INTO product (id, productnumber, pname, price, description_i18n_id, image, category_id, manufacturer_id) VALUES (NULL, '5', 'Optimum', '1730', '18', 'img/products/optimum.jpg', '3', '1');
INSERT INTO product (id, productnumber, pname, price, description_i18n_id, image, category_id, manufacturer_id) VALUES (NULL, '6', 'PD Reserve', '1403', '19', 'img/products/reserve.jpg', '3', '1');
INSERT INTO product (id, productnumber, pname, price, description_i18n_id, image, category_id, manufacturer_id) VALUES (NULL, '7', 'Proxy', '2090', '20', 'img/products/proxy.jpg', '4', '1');
INSERT INTO product (id, productnumber, pname, price, description_i18n_id, image, category_id, manufacturer_id) VALUES (NULL, '8', 'Safire 3', '2350', '21', 'img/products/safire.jpg', '2', '2');
INSERT INTO product (id, productnumber, pname, price, description_i18n_id, image, category_id, manufacturer_id) VALUES (NULL, '9', 'Crossfire 3', '2540', '22', 'img/products/crossfire.jpg', '2', '2');
INSERT INTO product (id, productnumber, pname, price, description_i18n_id, image, category_id, manufacturer_id) VALUES (NULL, '10', 'Hayduke', '2390', '23', 'img/products/hayduke.jpg', '4', '3');
INSERT INTO product (id, productnumber, pname, price, description_i18n_id, image, category_id, manufacturer_id) VALUES (NULL, '11', 'Outlaw', '2350', '24', 'img/products/outlaw.jpg', '4', '3');
INSERT INTO product (id, productnumber, pname, price, description_i18n_id, image, category_id, manufacturer_id) VALUES (NULL, '12', 'Epiciene Pro', '2190', '25', 'img/products/epicene.jpg', '2', '3');
INSERT INTO product_option_value (product_id, optionvalue_id) VALUES (1, 5);
INSERT INTO product_option_value (product_id, optionvalue_id) VALUES (1, 6);
INSERT INTO product_option_value (product_id, optionvalue_id) VALUES (1, 7);
INSERT INTO product_option_value (product_id, optionvalue_id) VALUES (1, 8);
INSERT INTO product_option_value (product_id, optionvalue_id) VALUES (1, 9);
INSERT INTO product_option_value (product_id, optionvalue_id) VALUES (1, 10);
INSERT INTO product_option_value (product_id, optionvalue_id) VALUES (1, 11);
INSERT INTO product_option_value (product_id, optionvalue_id) VALUES (1, 12);
INSERT INTO product_option_value (product_id, optionvalue_id) VALUES (2, 1);
INSERT INTO product_option_value (product_id, optionvalue_id) VALUES (2, 2);
INSERT INTO product_option_value (product_id, optionvalue_id) VALUES (2, 3);
INSERT INTO product_option_value (product_id, optionvalue_id) VALUES (2, 4);
INSERT INTO product_option_value (product_id, optionvalue_id) VALUES (2, 5);
INSERT INTO product_option_value (product_id, optionvalue_id) VALUES (2, 6);
INSERT INTO product_option_value (product_id, optionvalue_id) VALUES (2, 7);
INSERT INTO product_option_value (product_id, optionvalue_id) VALUES (2, 8);
INSERT INTO product_option_value (product_id, optionvalue_id) VALUES (2, 9);
INSERT INTO product_option_value (product_id, optionvalue_id) VALUES (3, 1);
INSERT INTO product_option_value (product_id, optionvalue_id) VALUES (3, 2);
INSERT INTO product_option_value (product_id, optionvalue_id) VALUES (3, 3);
INSERT INTO product_option_value (product_id, optionvalue_id) VALUES (3, 4);
INSERT INTO product_option_value (product_id, optionvalue_id) VALUES (3, 5);
INSERT INTO product_option_value (product_id, optionvalue_id) VALUES (3, 6);
INSERT INTO product_option_value (product_id, optionvalue_id) VALUES (3, 7);
INSERT INTO product_option_value (product_id, optionvalue_id) VALUES (3, 8);
INSERT INTO product_option_value (product_id, optionvalue_id) VALUES (3, 9);
INSERT INTO product_option_value (product_id, optionvalue_id) VALUES (3, 10);
INSERT INTO product_option_value (product_id, optionvalue_id) VALUES (4, 8);
INSERT INTO product_option_value (product_id, optionvalue_id) VALUES (4, 13);
INSERT INTO product_option_value (product_id, optionvalue_id) VALUES (4, 14);
INSERT INTO product_option_value (product_id, optionvalue_id) VALUES (4, 15);
INSERT INTO product_option_value (product_id, optionvalue_id) VALUES (4, 16);
INSERT INTO product_option_value (product_id, optionvalue_id) VALUES (4, 17);
INSERT INTO product_option_value (product_id, optionvalue_id) VALUES (4, 18);
INSERT INTO product_option_value (product_id, optionvalue_id) VALUES (4, 19);
INSERT INTO product_option_value (product_id, optionvalue_id) VALUES (5, 1);
INSERT INTO product_option_value (product_id, optionvalue_id) VALUES (5, 2);
INSERT INTO product_option_value (product_id, optionvalue_id) VALUES (5, 3);
INSERT INTO product_option_value (product_id, optionvalue_id) VALUES (5, 4);
INSERT INTO product_option_value (product_id, optionvalue_id) VALUES (5, 5);
INSERT INTO product_option_value (product_id, optionvalue_id) VALUES (5, 6);
INSERT INTO product_option_value (product_id, optionvalue_id) VALUES (5, 7);
INSERT INTO product_option_value (product_id, optionvalue_id) VALUES (5, 8);
INSERT INTO product_option_value (product_id, optionvalue_id) VALUES (5, 9);
INSERT INTO product_option_value (product_id, optionvalue_id) VALUES (5, 10);
INSERT INTO product_option_value (product_id, optionvalue_id) VALUES (6, 1);
INSERT INTO product_option_value (product_id, optionvalue_id) VALUES (6, 2);
INSERT INTO product_option_value (product_id, optionvalue_id) VALUES (6, 3);
INSERT INTO product_option_value (product_id, optionvalue_id) VALUES (6, 4);
INSERT INTO product_option_value (product_id, optionvalue_id) VALUES (6, 5);
INSERT INTO product_option_value (product_id, optionvalue_id) VALUES (6, 6);
INSERT INTO product_option_value (product_id, optionvalue_id) VALUES (6, 7);
INSERT INTO product_option_value (product_id, optionvalue_id) VALUES (6, 8);
INSERT INTO product_option_value (product_id, optionvalue_id) VALUES (6, 9);
INSERT INTO product_option_value (product_id, optionvalue_id) VALUES (6, 10);
INSERT INTO product_option_value (product_id, optionvalue_id) VALUES (7, 1);
INSERT INTO product_option_value (product_id, optionvalue_id) VALUES (7, 20);
INSERT INTO product_option_value (product_id, optionvalue_id) VALUES (7, 21);
INSERT INTO product_option_value (product_id, optionvalue_id) VALUES (7, 22);
INSERT INTO product_option_value (product_id, optionvalue_id) VALUES (7, 23);
INSERT INTO product_option_value (product_id, optionvalue_id) VALUES (8, 1);
INSERT INTO product_option_value (product_id, optionvalue_id) VALUES (8, 2);
INSERT INTO product_option_value (product_id, optionvalue_id) VALUES (8, 3);
INSERT INTO product_option_value (product_id, optionvalue_id) VALUES (8, 4);
INSERT INTO product_option_value (product_id, optionvalue_id) VALUES (8, 5);
INSERT INTO product_option_value (product_id, optionvalue_id) VALUES (8, 6);
INSERT INTO product_option_value (product_id, optionvalue_id) VALUES (8, 7);
INSERT INTO product_option_value (product_id, optionvalue_id) VALUES (8, 8);
INSERT INTO product_option_value (product_id, optionvalue_id) VALUES (8, 9);
INSERT INTO product_option_value (product_id, optionvalue_id) VALUES (9, 1);
INSERT INTO product_option_value (product_id, optionvalue_id) VALUES (9, 2);
INSERT INTO product_option_value (product_id, optionvalue_id) VALUES (9, 3);
INSERT INTO product_option_value (product_id, optionvalue_id) VALUES (9, 4);
INSERT INTO product_option_value (product_id, optionvalue_id) VALUES (9, 5);
INSERT INTO product_option_value (product_id, optionvalue_id) VALUES (9, 6);
INSERT INTO product_option_value (product_id, optionvalue_id) VALUES (9, 7);
INSERT INTO product_option_value (product_id, optionvalue_id) VALUES (9, 8);
INSERT INTO product_option_value (product_id, optionvalue_id) VALUES (9, 9);
INSERT INTO product_option_value (product_id, optionvalue_id) VALUES (9, 10);
INSERT INTO product_option_value (product_id, optionvalue_id) VALUES (10, 1);
INSERT INTO product_option_value (product_id, optionvalue_id) VALUES (10, 20);
INSERT INTO product_option_value (product_id, optionvalue_id) VALUES (10, 21);
INSERT INTO product_option_value (product_id, optionvalue_id) VALUES (10, 22);
INSERT INTO product_option_value (product_id, optionvalue_id) VALUES (10, 23);
INSERT INTO product_option_value (product_id, optionvalue_id) VALUES (11, 1);
INSERT INTO product_option_value (product_id, optionvalue_id) VALUES (11, 20);
INSERT INTO product_option_value (product_id, optionvalue_id) VALUES (11, 21);
INSERT INTO product_option_value (product_id, optionvalue_id) VALUES (11, 22);
INSERT INTO product_option_value (product_id, optionvalue_id) VALUES (11, 23);
INSERT INTO product_option_value (product_id, optionvalue_id) VALUES (12, 1);
INSERT INTO product_option_value (product_id, optionvalue_id) VALUES (12, 2);
INSERT INTO product_option_value (product_id, optionvalue_id) VALUES (12, 3);
INSERT INTO product_option_value (product_id, optionvalue_id) VALUES (12, 4);
INSERT INTO product_option_value (product_id, optionvalue_id) VALUES (12, 5);
INSERT INTO product_option_value (product_id, optionvalue_id) VALUES (12, 6);
INSERT INTO product_option_value (product_id, optionvalue_id) VALUES (12, 7);
INSERT INTO product_option_value (product_id, optionvalue_id) VALUES (12, 8);
INSERT INTO product_option_value (product_id, optionvalue_id) VALUES (12, 9);

GRANT USAGE ON `webshop`.*  TO 'webshop_user'@'localhost' IDENTIFIED BY PASSWORD '*89D97B94AF2E3585CA6625B6AB194B3D5F97F15F';
GRANT SELECT, INSERT, UPDATE, DELETE ON `webshop`.* TO 'webshop_user'@'localhost';