-- Get the Product with id 1 and language german
select p.id,
       p.productnumber,
       p.pname,
       p.price,
       i.text_de,
       p.image,
       (select text_de from webshop.i18n where id = c.name_i18n_id) Category,
       m.name                                                       Manufacturer
from webshop.product p
       join webshop.i18n i on p.description_i18n_id = i.id
       join webshop.category c on p.category_id = c.id
       join webshop.manufacturer m on p.manufacturer_id = m.id
where p.id = 1;

-- Get all options comma separated for product 1 and language german
select i.text_de 'Option', GROUP_CONCAT((select text_de from webshop.i18n where id = ov.name_i18n_id)) Optionvalue
from webshop.product p
       join webshop.product_option_value pov on p.id = pov.product_id
       join webshop.option_value ov on pov.optionvalue_id = ov.id
       join webshop.options o on ov.options_id = o.id
       join webshop.i18n i on o.name_i18n_id = i.id
where p.id = 1
group by 1;

-- Get user by username
select c.id,
       c.firstname,
       c.lastname,
       c.username,
       c.email,
       c.birthdate,
       c.phone,
       a.street,
       a.homenumber,
       ci.city,
       ci.zip,
       co.name country,
       r.name  role,
       c.lang
from webshop.person c
       join webshop.address a on a.id = c.address_id
       join webshop.city ci on ci.id = a.city_id
       join webshop.country co on co.id = a.country_id
       join webshop.role r on r.id = c.role_id
where c.username = 'res13';

-- Get current basket of user
select *
from webshop.orders o
       join webshop.person p on p.id = o.person_id
where o.state = 0;

update webshop.person p set p.passwordhash = '$2y$10$dfW9o4WTBQn8Wf.kF.6xbeKl9F/IpkIjwnnMcI3JUELYBaUdcJvSe' and p.resetPassword = 1 where p.email = 'andreas.erb@gmx.ch';