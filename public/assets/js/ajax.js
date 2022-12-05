function ajax_send(obj, url)
{
    const myForm = new FormData();

    for (key in obj) {
        myForm.append(key, obj[key]);
    }

    let xhr = new XMLHttpRequest();
    xhr.addEventListener('readystatechange', (e) => {
        if (xhr.readyState == 4 && xhr.status == 200) {
            handle_result(xhr.responseText);
        }
    });
    xhr.open('post', url, true);
    xhr.send(myForm);
}

function handle_result(result)
{
    let obj = JSON.parse(result);
    alert(obj.message);
}

function change_img(file)
{
    let obj = {};
    obj.image = file;
    obj.data_type = "profile-img";
    obj.id = "";

    ajax_send(obj);
}