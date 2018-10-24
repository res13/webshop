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
select o.id                                                          optionId,
       i.text_de                                                     optionText,
       ov.id                                                         optionValueId,
       (select text_de from webshop.i18n where id = ov.name_i18n_id) optionValueText
from webshop.product p
       join webshop.product_option_value pov on p.id = pov.product_id
       join webshop.option_value ov on pov.optionvalue_id = ov.id
       join webshop.options o on ov.options_id = o.id
       join webshop.i18n i on o.name_i18n_id = i.id
where p.id = 1;

-- Get all options for product 1
select o.id optionId, i.text_de optionText
from webshop.product p
       join webshop.product_option_value pov on p.id = pov.product_id
       join webshop.option_value ov on pov.optionvalue_id = ov.id
       join webshop.options o on ov.options_id = o.id
       join webshop.i18n i on o.name_i18n_id = i.id
where p.id = 1
group by optionId;

-- Get all optionsValues for product 1 and option 1
select ov.id optionValueId, i.text_de optionValueText
from webshop.product p
       join webshop.product_option_value pov on p.id = pov.product_id
       join webshop.option_value ov on pov.optionvalue_id = ov.id
       join webshop.options o on ov.options_id = o.id
       join webshop.i18n i on ov.name_i18n_id = i.id
where p.id = 1
  and o.id = 1
group by optionValueId;

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
select o.id
from webshop.orders o
       join webshop.person p on p.id = o.person_id
where o.state = 0
  and p.id = 0;

-- Get all sub-categories
select id, name_i18n_id, category_id
from (select * from webshop.category c order by c.category_id, id) category,
     (select @pv := '1') initialisation
where find_in_set(category_id, @pv) > 0
        and @pv := concat(@pv, ',', id)
union
select c.id, c.name_i18n_id, c.category_id
from webshop.category c
where id = 1;

-- Get my sub-categories
select c.id, i.text_de as text, c.category_id as categoryid
from webshop.category c
       join webshop.i18n i on i.id = c.name_i18n_id
where c.category_id in (select id from webshop.category c where c.category_id = 5);

-- Get all products in this category and its subcategories
select p.id,
       p.productnumber,
       p.pname                                                      name,
       p.price,
       i.text_de                                                    description,
       p.image,
       (select text_de from webshop.i18n where id = c.name_i18n_id) category,
       m.name                                                       manufacturer
from webshop.product p
       join webshop.i18n i on p.description_i18n_id = i.id
       join webshop.category c on p.category_id = c.id
       join webshop.manufacturer m on p.manufacturer_id = m.id
where c.id in (select id
               from (select * from webshop.category c order by c.category_id, id) category,
                    (select @pv := '1') initialisation
               where find_in_set(category_id, @pv) > 0
                       and @pv := concat(@pv, ',', id));

-- Get category
select c.id, i.text_de name, c.category_id categoryid
from webshop.category c
       join webshop.i18n i on c.name_i18n_id = i.id
where c.id = 1;

delete from webshop.orders where person_id = 1 and state = 0;
DELETE FROM `webshop`.`orders` WHERE `id` = 8;
update webshop.product_orders po set po.quantity = 2 where po.orders_id = 19;
