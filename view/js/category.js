
// template gallery managment

function display(event)
{
    var category = event.target;
    var content = document.getElementById('category_' + category.id);
    content.style.display = 'flex';
    category.addEventListener('click', hide);
}

function hide(event)
{
    var category = event.target;
    var content = document.getElementById('category_' + category.id);
    content.style.display = 'none';
    category.removeEventListener('click', hide);
    category.addEventListener('click', display);
}


function getUploadButton()
{
    var upload = document.getElementById('upload_button');
    upload.click();
}