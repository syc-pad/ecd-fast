var addedCategoriesText;
var addedCategoriesIds;

var tid = setInterval(function () {
    if (document.readyState !== "complete") {
        return;
    }
    clearInterval(tid);

    var addCategoryButton = document.getElementsByClassName('btn')[0];
    addedCategoriesIds = document.getElementById('categories');
    addCategoryButton.addEventListener('click', addCategoryToQuote);
    addedCategoriesText = document.getElementsByClassName('added-categories')[0];
    
    for(i = 0 ; i < addedCategoriesText.firstElementChild.children.length ; i++){
        addedCategoriesText.firstElementChild.children[1].firstElementChild.addEventListener('click', removeCategoryFromQuote);
    }
    
}, 100);

function addCategoryToQuote(event){
    event.preventDefault();
    
    // récupération de la catégorie sélectionnée
    var select = document.getElementById('category_select');
    var selectedCategoryId = select.options[select.selectedIndex].value;
    var selectedCategoryName = select.options[select.selectedIndex].text;
    
    // check cat pas encore ajoutée
    if(addedCategoriesIds.value.split(',').indexOf(selectedCategoryId) != -1){
        alert('Vous avez déjà ajouté la catégorie ' + selectedCategoryName + ".");
        return;
    }
    
    if(addedCategoriesIds.value.length > 0){
        addedCategoriesIds.value = addedCategoriesIds.value + "," + selectedCategoryId;
    }else{
        addedCategoriesIds.value = selectedCategoryId;
    }
    
    var newCategoryLi = document.createElement('li');
    var newCategoryLink = document.createElement('a');
    
    newCategoryLink.href = "#";
    newCategoryLink.innerHTML = selectedCategoryName;
    newCategoryLink.dataset['category_id'] = selectedCategoryId;
    newCategoryLink.addEventListener('click', removeCategoryFromQuote);
    newCategoryLi.appendChild(newCategoryLink);
    
    addedCategoriesText.firstElementChild.appendChild(newCategoryLi);
}

function removeCategoryFromQuote(event){
    event.preventDefault();
    
    event.target.removeEventListener('click', removeCategoryFromQuote);
    var categoryId = event.target.dataset['category_id'];
    var categoryIdArray = addedCategoriesIds.value.split(',');
    var index = categoryIdArray.indexOf(categoryId);
    
    categoryIdArray.splice(index, 1);
    
    var newCategoriesIds = categoryIdArray.join(',');
    addedCategoriesIds.value = newCategoriesIds;
    event.target.parentElement.remove();
}