//template images func
function changeHeight(flag)
{
    var template = document.getElementById('template');

    if (flag == 1)
    {
        var size =  template.offsetHeight + 5;
        template.style.height = size + 'px';
    }else
    {
        var size =  template.offsetHeight - 5;
        template.style.height = size + 'px';
    }
}

function changeWidth(flag)
{
    var template = document.getElementById('template');

    if (flag == 1)
    {
        var size =  template.offsetWidth + 5;
        template.style.width = size + 'px';
    }else
    {
        var size =  template.offsetWidth - 5;
        template.style.width = size + 'px';
    }
}

function hideTemplate()
{
    var template = document.getElementById('template');
    var snapButton = document.getElementById('snap');
    template.style.display = 'none';
    snapButton.style.opacity = '0.4';
    snapButton.removeEventListener('click', makePhoto);
    snapButton.addEventListener('click', error);
}

function error()
{
    var err = document.getElementById('template_error');
    var template = document.getElementById('template');
    if (template.style.display != 'block')
    {
        err.style.display = "block";
        setTimeout(function () {
            err.style.display = 'none';
        }, 2000)
    }
}