create or replace package ndcraiglist
as
  function create_store(id_man store.id_manager%type,name_store store.name_store%type, price store.price_per_product%type,category_desc category.cat_description%type,description store.description_store%type)
  return store.id_store%type;
  
  procedure create_image(store_id store.id_store%type,name_image image.image_name%type);
   procedure create_comment(store_id store.id_store%type, commenter_id users.id_user%type, content commentary.content_comment%type);

end ndcraiglist;
/
