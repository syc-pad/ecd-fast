var tid = setInterval(function () {
    if (document.readyState !== "complete") {
        return;
    }
    clearInterval(tid);

    var editSections = document.getElementsByClassName('edit');

    for (i = 0; i < editSections.length; i++) {
        editSections[i].firstElementChild.firstElementChild.children[1].firstChild.addEventListener('click', startEdit);
        editSections[i].firstElementChild.firstElementChild.children[2].firstChild.addEventListener('click', startDelete);
    }
}, 100);

document.getElementsByClassName('btn')[0].addEventListener('click', createNewCategory);

function startEdit(event) {
    event.preventDefault();
    event.target.textContent = "Enregistrer";
    var li = event.target.parentNode.parentNode.children[0];
    // récupération du nom de la catégorie que l'on veut éditer
    li.children[0].value = event.path[4].previousElementSibling.children[0].textContent;
    li.style.display = "inline-block";
    setTimeout(function() {
        li.children[0].style.maxWidth = "110px";
    }, 1);
    event.target.removeEventListener('click', startEdit);
    event.target.addEventListener('click', saveEdit);
}

function saveEdit(event) {
    event.preventDefault();
    var li = event.path[2].children[0];
    var categoryName = li.children[0].value;
    var categoryId = event.path[4].previousElementSibling.dataset['id'];
    if (categoryName.length === 0) {
        alert("Merci d'entrer un nom valide !");
        return;
    }
    ajax("POST", "/admin/categorie/maj", "name=" + categoryName + "&category_id=" + categoryId, endEdit, [event]);
}

function endEdit(params, success, responseObj) {
    var event = params[0];

    if (success) {
        var newName = responseObj.new_name;
        var article = event.path[5];
        article.style.backgroundColor = "#afefac";
        setTimeout(function() {
            article.style.backgroundColor = "white";
        }, 300);
        article.firstElementChild.firstElementChild.textContent = newName;
    }

    event.target.textContent = "Editer";
    var li = event.path[2].children[0];
    li.children[0].style.maxWidth = "0px";
    setTimeout(function() {
        li.style.display = "none";
    }, 310);
    event.target.removeEventListener('click', saveEdit);
    event.target.addEventListener('click', startEdit)
}

function createNewCategory(event) {
    event.preventDefault();
    var name = event.target.previousElementSibling.value;
    if (name.length === 0) {
        alert("Merci de saisir un nom valide !");
        return;
    }
    ajax("POST", "/admin/categorie/creer", "name=" + name, newCategoryCreated, [name]);
}

function newCategoryCreated(params, success, responseObj) {
    var name = params[0];
    location.reload();
}

function startDelete(event) {
    // Open Modal here
    deleteCategory(event);
}

function deleteCategory(event) {
    event.preventDefault();
    event.target.removeEventListener('click', startDelete);
    var categoryId = event.path[4].previousElementSibling.dataset['id'];
    ajax("GET", "/admin/categorie/" + categoryId + "/supprimer", null, categoryDeleted, [event.path[5]]);
}

function categoryDeleted(params, success, responseObj) {
    var article = params[0];
    if (success) {
        article.style.backgroundColor = "#ffc4be";
        setTimeout(function() {
            article.remove();
            location.reload();
        }, 300);
    }
}

function ajax(method, url, params, callback, callbackParams) {
    var http;

    if (window.XMLHttpRequest) {
        // IE7+, Firefox, Chrome, Opera, Safari
        http = new XMLHttpRequest();
    } else {
        // IE6, IE5
        http = new ActiveXObject("Microsoft.XMLHTTP");
    }

    http.onreadystatechange = function() {
        if (http.readyState == XMLHttpRequest.DONE ) {
            if(http.status == 200){
                var obj = JSON.parse(http.responseText);
                console.log(obj);
                callback(callbackParams, true, obj);
            }
            else if(http.status == 400) {
                alert("Enregistrement impossible. Merci de réessayer.");
                callback(callbackParams, false);
            }
            else {
                var obj = JSON.parse(http.responseText);
                if (obj.message) {
                    alert(obj.message);
                } else {
                    alert("Merci de bien vérifier le nom");
                }
                callback(callbackParams, false);
            }
        }
    };

    console.log(baseUrl + url);
    console.log(token);
    console.log(params);
    console.log(callbackParams);
    http.open(method, baseUrl + url, true);
    http.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    http.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
    http.setRequestHeader('X-CSRF-TOKEN', token);
    http.send(params + "&token="+token);
}