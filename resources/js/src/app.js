import carouselCustomers from "../lib/CarouselCustomers";

require('../libs/bootstrap');
import NotificationToast from "../lib/NotificationToast";
import {CustomConfirm, CustomConfirmLogOut} from "../lib/CustomConfirm";
import config from "../lib/config";
import autoComplete from "@tarekraafat/autocomplete.js";
import formControl from "../lib/FormControl";
import Chart from 'chart.js/auto';
import autocolors from 'chartjs-plugin-autocolors';
import {SelectInput, SelectInputTop} from "../Components/SelectInput";
import {DatePicker, DatePickerTwo, TimePicker} from "../Components/DatePicker";

Turbolinks.start()

//Custom Select Input
customElements.define("custom-select", SelectInput, {extends: "select"})
customElements.define("custom-select-top", SelectInputTop, {extends: "select"})
customElements.define("date-picker", DatePicker, {extends: "input"})
customElements.define("time-picker", TimePicker, {extends: "input"})
customElements.define("date-picker-two", DatePickerTwo, {extends: "input"})

function getAllFormSubit() {
    let allForm = document.querySelectorAll(".modal__body form")
    allForm.forEach((item) => {
        item.addEventListener("submit", (e) => {
            e.preventDefault()
            document.querySelector(".modal__box.active .modal__footer .form__submit__btn").click()
        })
    })
}

document.addEventListener("turbolinks:load", function () {

    carouselCustomers()

// Autoclose dropdown
    window.addEventListener("click", (e) => {
        if (!e.target.matches('.icon.fi-rr-menu-dots-vertical') && !e.target.matches('.table_drop_action')) {
            document.querySelectorAll('.table_drop_action').forEach(elm => {
                if (elm.classList.contains("active")) {
                    elm.classList.remove("active");
                }
            });
        }

        if (document.querySelector(".dropdown .default_option") !== null) {
            if (!e.target.matches('.dropdown .default_option')) {
                if (document.querySelector(".dropdown .default_option + ul").classList.contains("active")) {
                    document.querySelector(".dropdown .default_option + ul").classList.remove("active");
                }
            }
        }

        if (!e.target.matches('.default_option')) {
            document.querySelectorAll('.dropdownList > ul').forEach(elm => {
                if (elm.classList.contains("active")) {
                    elm.classList.remove("active");
                }
            });
        }
    });

// Gestion de la suppression
    let formDelete = document.querySelectorAll(".deleteForm");
    formDelete.forEach((item) => {
        item.addEventListener("submit", (e) => {
            e.preventDefault();
            CustomConfirm(item.dataset.content, item)
        })
    })

// Table DropDown Action menu
    let table_drop_action = document.querySelectorAll('.table_drop_action');
    table_drop_action.forEach(element => {
        element.addEventListener("click", () => {
            table_drop_action.forEach(elm => {
                if (elm.classList.contains("active") && elm !== element) {
                    elm.classList.remove("active");
                }
            });
            element.classList.toggle("active");
        });
    });

// Navigation sidebar toggle

    let sidebar = document.querySelector(".sidebar");
    let sidebarBtn = document.querySelector("#close-nav");
    sidebarBtn?.addEventListener("click", () => {
        sidebar.classList.toggle("close")
        menuBtnChange()
    });

// Navigation sidebar control
    let nav_dropdown_link = document.querySelectorAll(".dropdown-link");
    for (let i = 0; i < nav_dropdown_link.length; i++) {
        nav_dropdown_link[i].addEventListener("click", (e) => {
            let nav_dropdown_linkParent = nav_dropdown_link[i].parentElement.parentElement;
            nav_dropdown_linkParent.classList.toggle("showMenu")
        });
    }

    // Filter Drop
    let filterDrop = document.querySelector(".dropdown .default_option");
    if (filterDrop !== null && filterDrop !== undefined) {
        filterDrop.addEventListener("click", () => {
            let filterElm = document.querySelector(".dropdown .default_option + ul");
            filterElm.classList.toggle("active");
        });
    }

    let dropdownList = document.querySelectorAll(".dropdownList .default_option");
    dropdownList.forEach((dropdown) => {
        let dropdownListElm = dropdown.parentElement.querySelector("ul");
        if (dropdownList !== null && dropdownList !== undefined) {
            dropdown.addEventListener("click", () => {
                dropdownListElm.classList.toggle("active");
            });
        }
    })


    function menuBtnChange() {
        if (!sidebar.classList.contains("close")) {
            sidebarBtn.classList.replace("fi-rr-menu-burger", "fi-rr-align-right")
        } else {
            sidebarBtn.classList.replace("fi-rr-align-right", "fi-rr-menu-burger")
        }
    }

// Gestion de bar de recherche
    let searchField = document.querySelector(".search_field .input")
    if (searchField !== null && searchField !== undefined) {
        const autoCompleteJS = new autoComplete({
            selector: "#autoComplete",
            placeHolder: "Rechercher...",
            data: {
                src: searchList,
                cache: true,
            },
            resultsList: {
                element: (list, data) => {
                    if (!data.results.length) {
                        // Create "No Results" message element
                        const message = document.createElement("div");
                        // Add class to the created element
                        message.setAttribute("class", "no_result");
                        // Add message text content
                        message.innerHTML = `<span>Aucun résultat trouvé pour "${data.query}"</span>`;
                        // Append message element to the results list
                        list.prepend(message);
                    }
                },
                noResults: true,
                maxResults: 15,
                tabSelect: true,
            },
            // submit form
            submit: true,
            resultItem: {
                highlight: true
            },
            events: {
                input: {
                    selection: (event) => {
                        const selection = event.detail.selection.value;
                        let url = window.location.origin + window.location.pathname
                        const params = new URLSearchParams({
                            q: selection
                        });
                        Turbolinks.visit(url + '?' + params.toString());
                    }
                }
            }
        });
    }


    let JS_Call_Url_Get_Form = document.querySelectorAll(".JS_Call_Url_Get_Form")
    JS_Call_Url_Get_Form.forEach((item) => {
        item.addEventListener('click', () => {
            let url = item.dataset.url
            if (url !== null && url !== undefined) {
                fetch(url, {
                    method: "GET",
                    body: null,
                })
                    .then(res => res)
                    .then(response => {
                        if (response.status === 200) {
                            return response.text()
                        } else {
                            NotificationToast("error", "Erreur lors de l'opération.")
                        }
                    })
                    .then(data => {
                        let generateEditForm = document.querySelector("#JS_GenerateForm")
                        if (data === undefined || generateEditForm === null) {
                            return 0
                        }
                        generateEditForm.innerHTML = data

                        // Toggle Switch Edit Modal
                        toggleEditForm()

                        // loadInputFile
                        loadInputFile()

                        setTimeout(function () {
                            generateEditForm.querySelector('.modal__box').classList.add('active')
                        }, 100)

                        // Close Modal
                        let close__modal = generateEditForm.querySelectorAll(".close__modal")
                        if (close__modal !== null && close__modal !== undefined) {
                            close__modal.forEach((item) => {
                                item.addEventListener("click", () => {
                                    CloseModal()
                                })
                            })
                        }

                        // Submit Form
                        let modalForm__submit = generateEditForm.querySelector(".modalForm__submit")
                        if (modalForm__submit !== null && modalForm__submit !== undefined) {
                            modalForm__submit.addEventListener("click", () => {
                                submitForm(modalForm__submit)
                            })

                            let form = generateEditForm.querySelector("form")
                            form.addEventListener("submit", (e) => {
                                e.preventDefault()
                                submitForm(modalForm__submit)
                            })
                        }

                    })
                    .catch(err => {
                        NotificationToast("error", "Erreur XHR: " + err)
                    });

                return true
            }
        })
    })

    // Load all input file preview Img
    loadInputFile()


    let custom__link = document.querySelectorAll('.custom__link')
    custom__link.forEach((item) => {
        item.addEventListener('click', (e) => {
            e.preventDefault()
            let url = item.dataset.url
            Turbolinks.visit(url)
        })
    })

    // Chart graphique
    const chart__ca_year = document.querySelector("#chart__ca_year")
    if (chart__ca_year !== null){
        const data = ca_reservation_by_year

        new Chart(
            chart__ca_year,
            {
                type: 'polarArea',
                data: {
                    labels: data.map(row => "CA " + row._id),
                    datasets: [
                        {
                            label: 'Montant',
                            data: data.map(row => row.total)
                        }
                    ]
                },
                options: {
                    plugins: {
                        autocolors,
                        legend: {
                            labels: {
                                // This more specific font property overrides the global property
                                font: {
                                    family: 'poppins'
                                }
                            }
                        },
                        tooltip:{
                            bodyFont:{
                                family: 'poppins',
                                weight: '400'
                            },
                            titleFont:{
                                family: 'poppins',
                                weight: '400'
                            }
                        },
                        subtitle: {
                            display: true,
                            text: "CHIFFRES D'AFFAIRES ANNUELS",
                            font: {
                                family: 'poppins',
                                weight: '700'
                            }
                        }
                    }
                }
            }
        );
    }

    const chart__ca_type = document.querySelector("#chart__ca_type")
    if (chart__ca_type !== null){
        const data = ca_reservation_by_type

        new Chart(
            chart__ca_type,
            {
                type: 'pie',
                data: {
                    labels: data.map(row => "CA " + row._id),
                    datasets: [
                        {
                            label: 'Montant',
                            data: data.map(row => row.total)
                        }
                    ]
                },
                options: {
                    plugins: {
                        autocolors,
                        legend: {
                            labels: {
                                // This more specific font property overrides the global property
                                font: {
                                    family: 'poppins'
                                }
                            }
                        },
                        tooltip:{
                            bodyFont:{
                                family: 'poppins',
                                weight: '400'
                            },
                            titleFont:{
                                family: 'poppins',
                                weight: '400'
                            }
                        },
                        subtitle: {
                            display: true,
                            text: "CHIFFRES D'AFFAIRES TYPE VOYAGE",
                            font: {
                                family: 'poppins',
                                weight: '700'
                            }
                        }
                    }
                }
            }
        );
    }

    const chart__ca_trajet = document.querySelector("#chart__ca_trajet")
    if (chart__ca_trajet !== null){
        const data = ca_reservation_by_trajet

        new Chart(
            chart__ca_trajet,
            {
                type: 'line',
                data: {
                    labels: data.map(row => row._id),
                    datasets: [{
                        label: "CA/Trajet",
                        data: data.map(row => row.total),
                        pointStyle: 'circle',
                        pointRadius: 5,
                        pointHoverRadius: 8,
                        tension: 0.2
                    }]
                },
                options: {
                    plugins: {
                        autocolors,
                        legend: {
                            labels: {
                                // This more specific font property overrides the global property
                                font: {
                                    family: 'poppins',
                                    weight: '500'
                                }
                            }
                        },
                        tooltip:{
                            bodyFont:{
                                family: 'poppins',
                                weight: '400'
                            },
                            titleFont:{
                                family: 'poppins',
                                weight: '400'
                            }
                        },
                        subtitle: {
                            display: true,
                            text: 'Situation CA/TRAJETS',
                            font: {
                                family: 'poppins',
                                weight: '700'
                            }
                        }
                    },
                    scales:{
                        y:{
                            ticks:{
                                font: {
                                    family: 'poppins',
                                    weight: '500'
                                }
                            }
                        },
                        x:{
                            ticks:{
                                font: {
                                    family: 'poppins',
                                    weight: '500'
                                }
                            }
                        }
                    }
                }
            }
        );
    }

    let tabsBtn = document.querySelectorAll('.planning__item')
    if (tabsBtn !== null && tabsBtn !== undefined) {
        tabsBtn.forEach(element => {
            element.addEventListener("click", () => {
                tabsBtn.forEach(elm => {
                    if (elm.classList.contains("active") && elm !== element) {
                        elm.classList.remove("active");
                    }
                });
                let tabsContent = document.querySelector('.planning-content')
                tabsContent.querySelector('.planning-content-item.active').classList.remove('active')
                element.classList.add("active");
                tabsContent.querySelector('.ctn' + element.dataset.id).classList.add('active')
            });
        });
    }

    let log__out = document.querySelector("#log__out")
    if(log__out !== null){
        log__out.addEventListener("click", (e) => {
            let url = log__out.dataset.url
            CustomConfirmLogOut(url)
        })
    }

    let login__form = document.querySelector("#login__form")
    if(login__form !== null){
        let btn = login__form.querySelector("button")
        btn.addEventListener("click", (e) => {
            e.preventDefault()
            let payload = new FormData(login__form)
            let url = login__form.action
            let formControlResult = formControl(login__form, payload)
            btn.setAttribute("disabled", "")
            if (formControlResult === true) {
                fetch(url, {
                    method: "POST",
                    body: payload,
                })
                    .then(res => res.json())
                    .then(data => {
                        Turbolinks.visit(data?.redirection + window.location.search)
                        document.addEventListener("turbolinks:load", function () {
                            if (data !== undefined) {
                                NotificationToast(data.type, data.message)
                                setTimeout(() => { //remove data after 500ms
                                    data = undefined;
                                }, 500);
                            }
                        })
                    })
                    .catch(err => {
                        btn.removeAttribute("disabled")
                        NotificationToast("error", "Erreur XHR: " + err)
                    });
                return true
            }
            setTimeout(() => {
                btn.removeAttribute("disabled")
            }, 1000)
        })
        login__form.addEventListener("submit", (e) => {
            btn.click()
        })
    }
})

// Functions
function CloseModal() {
    const popUpModal = document.querySelector(".modal__box")
    popUpModal.classList.toggle("active")
    setTimeout(function () {
        document.querySelector("#JS_GenerateForm").innerHTML = ""
    }, 200)
}

function submitForm(element) {
    element.setAttribute("disabled", "")
    let animation = element.parentElement.parentElement
    let formParent = element.parentElement.parentElement.querySelector(".modal__body")
    let formElement = formParent.querySelector(".modal__body form")
    let payload = new FormData(formElement)
    let url = formElement.action
    let formControlResult = formControl(formElement, payload)

    if (formControlResult === true) {
        animation.classList.add("show__loader")
        fetch(url, {
            method: "POST",
            body: payload,
        })
            .then(res => res.json())
            .then(data => {
                animation.classList.add("show__loader")
                Turbolinks.visit(data?.redirection + window.location.search)
                document.addEventListener("turbolinks:load", function () {
                    if (data !== undefined) {
                        NotificationToast(data.type, data.message)
                        setTimeout(() => { //remove data after 500ms
                            data = undefined;
                        }, 500);
                    }
                })
            })
            .catch(err => {
                element.removeAttribute("disabled")
                animation.classList.remove("show__loader")
                NotificationToast("error", "Erreur XHR: " + err)
            });
        return true
    }
    setTimeout(() => {
        element.removeAttribute("disabled")
    }, 1000)
}

function loadInputFile() {

    let allInputUploadImage = document.querySelectorAll(".JS_load__previewImg");
    allInputUploadImage.forEach((item) => {
        let uploadImagePreview = document.querySelector("#load__previewImg_" + item.name)
        let uploadImageDeletePreview = item.parentElement.querySelector(".deleteUploadPreview")

        item.addEventListener("change", () => {
            if (item.files && item.files.length === 1 && item.files[0].size > 2097152) {
                alert("La taille de l'image ne doit pas dépasser " + parseInt(2097152 / 1024 / 1024) + " MB");
                item.value = null;
                uploadImagePreview.setAttribute('src', uploadImagePreview.dataset.img);
                uploadImageDeletePreview.style.display = "none";
            } else {
                const fileSrc = item.files[0];
                if (fileSrc) {
                    const reader = new FileReader();
                    reader.addEventListener("load", () => {
                        if (item.files[0].type.indexOf("image") !== -1) uploadImagePreview.setAttribute('src', reader.result);
                        uploadImageDeletePreview.style.display = "block";
                    });
                    reader.readAsDataURL(fileSrc);
                } else {
                    // item.value = uploadImagePreview.src;
                    if (item.files[0].type.indexOf("image") !== -1) uploadImagePreview.setAttribute('src', uploadImagePreview.dataset.img);
                    uploadImageDeletePreview.style.display = "none";
                }
            }
        })

        uploadImageDeletePreview.addEventListener("click", (e) => {
            e.preventDefault();
            if (item.value != null) {
                item.value = null;
                uploadImagePreview.setAttribute('src', uploadImagePreview.dataset.img);
                uploadImageDeletePreview.style.display = "none";
            }
        })
    })
}


function toggleEditForm() {
    let switch_btn = document.querySelector(".modal__box .modal__header #JS_editModal")
    if (switch_btn !== null) {
        verifyToggle(switch_btn)
        switch_btn.addEventListener('click', () => {
            verifyToggle(switch_btn)
        })
    }

    function verifyToggle(switch_btn) {
        if (switch_btn.checked === false) {
            let allInput = document.querySelectorAll(".modal__body input")
            allInput.forEach((item) => {
                item.setAttribute('disabled', '')
            })

            let allSelect = document.querySelectorAll(".modal__body select")
            allSelect.forEach((item) => {
                item.setAttribute('disabled', '')
            })

            let allTextArea = document.querySelectorAll(".modal__body textarea")
            allTextArea.forEach((item) => {
                item.setAttribute('disabled', '')
            })

            let submitBtn = document.querySelectorAll(".modal__footer input")
            submitBtn.forEach((item) => {
                item.style.opacity = 0
                item.style.visibility = "hidden"
            })

            let requiredIcon = document.querySelectorAll(".modal__body [data-control*=noEmpty] + label + i")
            requiredIcon.forEach((item) => {
                item.style.opacity = 0
                item.style.visibility = "hidden"
                item.setAttribute('disabled', '')
            })

            let requiredIcon2 = document.querySelectorAll(".modal__body [data-control*=noEmpty] + .ss-main + label + i")
            requiredIcon2.forEach((item) => {
                item.style.opacity = 0
                item.style.visibility = "hidden"
                item.setAttribute('disabled', '')
            })

            let br = document.querySelector('.modal__body + br')
            if (br !== null) {
                br.style.display = "none"
            }
            document.querySelector(".required__placeholder").style.display = "none"
        } else {
            let allInput = document.querySelectorAll(".modal__body input")
            allInput.forEach((item) => {
                if (item.getAttribute("forceDisabled") == null) {
                    item.removeAttribute('disabled')
                }
            })

            let allSelect = document.querySelectorAll(".modal__body select")
            allSelect.forEach((item) => {
                if (item.getAttribute("forceDisabled") == null) {
                    item.removeAttribute('disabled')
                }
            })

            let allTextArea = document.querySelectorAll(".modal__body textarea")
            allTextArea.forEach((item) => {
                item.removeAttribute('disabled')
            })

            let submitBtn = document.querySelectorAll(".modal__footer input")
            submitBtn.forEach((item) => {
                item.style.opacity = 1
                item.style.visibility = "visible"
            })

            let requiredIcon = document.querySelectorAll(".modal__body [data-control*=noEmpty] + label + i")
            requiredIcon.forEach((item) => {
                item.style.opacity = 1
                item.style.visibility = "visible"
                item.removeAttribute('disabled')
            })

            let requiredIcon2 = document.querySelectorAll(".modal__body [data-control*=noEmpty] + .ss-main + label + i")
            requiredIcon2.forEach((item) => {
                item.style.opacity = 1
                item.style.visibility = "visible"
                item.removeAttribute('disabled')
            })
            let br = document.querySelector('.modal__body + br')
            if (br !== null) {
                br.style.display = "block"
            }
            document.querySelector(".required__placeholder").style.display = "block"
        }
    }
}
