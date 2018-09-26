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

-- Get options for Product 1 and language german
select i.text_de 'Option',
       (select text_de from webshop.i18n where id = ov.name_i18n_id) Optionvalue
from webshop.product p
       join webshop.product_option_value pov on p.id = pov.product_id
       join webshop.option_value ov on pov.optionvalue_id = ov.id
       join webshop.options o on ov.options_id = o.id
       join webshop.i18n i on o.name_i18n_id = i.id
where p.id = 1;

