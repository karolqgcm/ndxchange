load data infile 'category.csv'
insert into table category
fields terminated by "," optionally enclosed by '"'
(id_category,cat_description)
