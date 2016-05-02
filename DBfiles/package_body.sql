create or replace package body ndcraiglist
as
  function create_store(id_man store.id_manager%type,name_store store.name_store%type, price store.price_per_product%type,category_desc category.cat_description%type,description store.description_store%type)
  return store.id_store%type
  as
     category_id category.id_category%type;
     store_id store.id_store%type := store_sequence.nextval;
  begin
     
     select id_category
     into category_id
     from category
     where cat_description = category_desc;

     insert into store
     values (store_id,id_man,name_store,price,sysdate,category_id,description);
     return store_id;
  end;
   
  procedure create_image(store_id store.id_store%type,name_image image.image_name%type)
    as
    begin
      insert into image
      values (image_sequence.nextval,store_id,name_image);
    end;
  
  procedure create_comment(store_id store.id_store%type, commenter_id users.id_user%type, content commentary.content_comment%type)
  as
  begin
    insert into commentary
    values(comment_sequence.nextval,store_id,commenter_id,content,sysdate);
  end;
end ndcraiglist;
/
