import NotificationToast from "./NotificationToast";

/**
 * Form Controller by params (noEmpty)
 * @param {Element} element
 */

export default function formControl(element, elementData = null) {
    let allInput = element.querySelectorAll('input[data-control]')
    let allSelect = element.querySelectorAll('select[data-control]')

    allInput.forEach((item) => {
        let controlData = (item.dataset.control).split(',')
        controlData.forEach((control) => {
            let parentItem = item.parentElement.parentElement
            switch (control) {
                case 'noEmpty':

                    let maxValue = item.dataset.maxvalue
                    if (maxValue != null){
                        if (parseInt(item.value) > parseInt(maxValue, 10)){
                            item.value = ""
                            parentItem.classList.add("shake", "error")
                            setTimeout(() => { //remove shake class after 500ms
                                parentItem.classList.remove("shake");
                            }, 500);
                        }
                    }

                    if ((item.value).trim() === "") {
                        parentItem.classList.add("shake", "error")
                        setTimeout(() => { //remove shake class after 500ms
                            parentItem.classList.remove("shake");
                        }, 500);
                    } else {
                        parentItem.classList.remove("shake", "error")
                    }
                    item.onkeyup = () => {
                        check__noEmpty(item, parentItem);
                    }
                    item.onchange = () => {
                        check__noEmpty(item, parentItem);
                    }
                    break;

                case 'other_max_field':

                        let other_max_field = item.parentElement.parentElement.parentElement.querySelector("input[name='"+ item.dataset.maxfield +"']")

                        let max = parseInt(other_max_field.dataset.maxvalue , 10 ) - parseInt(other_max_field.value, 10)

                        if (!isNaN(parseInt(item.value,10)) && parseInt(item.value, 10) > max) {
                            parentItem.classList.add("shake", "error")
                            setTimeout(() => { //remove shake class after 500ms
                                parentItem.classList.remove("shake");
                            }, 500);
                            if (max > 0){
                                item.value = max
                            }else{
                                item.value = null
                            }

                            if (isNaN(parseInt(item.value,10)) && parseInt(item.value,10) === max){
                                parentItem.classList.remove("shake", "error")
                            }

                        } else {
                            parentItem.classList.remove("shake", "error")
                        }

                        item.onkeyup = () => {
                            check()
                        }
                        item.onchange = () => {
                            check()
                        }

                        function check(){
                            max = parseInt(other_max_field.dataset.maxvalue , 10 ) - parseInt(other_max_field.value, 10)
                            if (!isNaN(parseInt(item.value,10)) && parseInt(item.value, 10) > max) {
                                parentItem.classList.add("shake", "error")
                                setTimeout(() => { //remove shake class after 500ms
                                    parentItem.classList.remove("shake");
                                }, 500);

                                if (max > 0){
                                    item.value = max
                                }else{
                                    item.value = null
                                }

                                max = parseInt(other_max_field.dataset.maxvalue , 10 ) - parseInt(other_max_field.value, 10)
                                if (isNaN(parseInt(item.value,10)) && parseInt(item.value,10) === max){
                                    parentItem.classList.remove("shake", "error")
                                }

                            } else {
                                parentItem.classList.remove("shake", "error")
                            }
                        }
                    break;

                case 'minLength4':
                    if ((item.value).trim() === "" || (item.value).trim().length < 4) {
                        parentItem.classList.add("shake", "error")
                        setTimeout(() => { //remove shake class after 500ms
                            parentItem.classList.remove("shake");
                        }, 500);
                    } else {
                        parentItem.classList.remove("shake", "error")
                    }
                    item.onkeyup = () => {
                        check__minLength4(item, parentItem);
                    }
                    break;

                case 'noZero':
                    if (isNaN(parseInt((item.value).trim(), 10)) || (item.value).trim() === "" || parseInt((item.value).trim(), 10) <= 0) {
                        parentItem.classList.add("shake", "error")
                        setTimeout(() => { //remove shake class after 500ms
                            parentItem.classList.remove("shake");
                        }, 500);
                    } else {
                        parentItem.classList.remove("shake", "error")
                    }
                    item.onkeyup = () => {
                        check__noZero(item, parentItem);
                    }
                    break;
                case 'checkConfirmPassword':
                    let password = element.querySelector("#password").value
                    if (item.value !== password){
                        parentItem.classList.add("shake", "error")
                        setTimeout(() => { //remove shake class after 500ms
                            parentItem.classList.remove("shake");
                        }, 500);
                        NotificationToast('error', 'Mot de passe incorrect')
                    }else {
                        parentItem.classList.remove("shake", "error")
                    }
                    break;
                default:
                    break;
            }
        })
    })

    allSelect.forEach((item) => {
        let controlData = (item.dataset.control).split(',')
        controlData.forEach((control) => {
            switch (control) {
                case 'noEmpty':
                    let parentItem = item.parentElement.parentElement
                    if (item.selectedIndex === "" || item.selectedIndex <= 0) {
                        parentItem.classList.add("shake", "error")
                        setTimeout(() => { //remove shake class after 500ms
                            parentItem.classList.remove("shake");
                        }, 500);
                    } else {
                        parentItem.classList.remove("shake", "error")
                    }
                    // item.change = ()=>{check__noEmptySelect(item, parentItem);}
                    item.addEventListener("change", () => {
                        check__noEmptySelect(item, parentItem)
                    })
                    break;

                default:
                    break;
            }
        })
    })
    removeSelectPlaceholder(element, elementData)
    let countError = element.querySelectorAll('.field.error').length
    return countError <= 0;

}

function check__noEmpty(element, parent) {
    if ((element.value).trim() === "") {
        parent.classList.add("error");
        parent.classList.remove("valid");
    } else {
        parent.classList.remove("error");
        parent.classList.add("valid");
    }
    let maxValue = element.dataset.maxvalue
    if (maxValue != null){
        if (parseInt(element.value) > parseInt(maxValue, 10)){
            element.value = maxValue
        }
    }
}

function check__minLength4(element, parent) {
    if ((element.value).trim() === ""  || (element.value).trim().length < 4) {
        parent.classList.add("error");
        parent.classList.remove("valid");
    } else {
        parent.classList.remove("error");
        parent.classList.add("valid");
    }
}

function check__noZero(element, parent) {
    if (parseInt((element.value).trim(), 10) <= 0 || isNaN(parseInt((element.value).trim(), 10)) || (element.value).trim() === "") {
        parent.classList.add("error");
        parent.classList.remove("valid");
    } else {
        parent.classList.remove("error");
        parent.classList.add("valid");
    }
}

function removeSelectPlaceholder(element, elementData){
    let allCustomSelect = element.querySelectorAll("select")
    allCustomSelect.forEach((item) => {
        let placeholder = item.querySelector('[data-placeholder]')
        if (placeholder !== null){
            if (item.value === placeholder.value && elementData !== null){
                let allOptions = item.options
                for(let i = 0; i < allOptions.length; i++){
                    allOptions[i].selected = false
                }
                item.value = ''
                elementData.set(item.name, '')
            }
        }
    })
}
function check__noEmptySelect(element, parent) {
    if (element.selectedIndex === "" || element.selectedIndex <= 0) {
        parent.classList.add("error");
        parent.classList.remove("valid");
    } else {
        parent.classList.remove("error");
        parent.classList.add("valid");
    }
}
