import './bootstrap';
const characters ='ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
function generateString(length){
    let result = '';
    for(let i = 0; i < length; ++i){
        result += characters.charAt(Math.floor(Math.random() * characters.length));
    }
    return result;
}
$(document).ready(function(){
    $('.form-filed').each(function(item){
        const name = $(this).attr('data-name');
        const id = $(this).attr('data-id');
        if(name || id) {
            $(this).find('input').attr('name', name).attr('id', id);
            $(this).find('select').attr('name', name).attr('id', id);
            $(this).find('textarea').attr('name', name).attr('id', id);
        }
    });
    
    $('.create-password').on('click', function(e) {
        if(e.target.closest('.btn-create-password')){
          console.log(generateString(17));
          $(this).find('input.input-password').val(generateString(17));
        }
    });
})
$(document).on('click','p.class',function(e){
    e.preventDefault();
       //Code 
});

