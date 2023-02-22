import $ from 'jquery'
import 'jquery-confirm'
import 'jquery-confirm/css/jquery-confirm.css'
import NotificationToast from "./NotificationToast";
import {showModal} from "../src/app";

export default function CustomConfirm(text, formElement) {
    $.confirm({
        icon: 'fa fa-question',
        title: 'Confimation',
        content: 'Voulez-vous vraiment supprimer <br/><b class="delText">' + text + ' ?</b>',
        useBootstrap: false,
        boxWidth: '500px',
        // autoClose: 'Annuler|10000',
        theme: 'modern',
        closeIcon: true,
        animation: 'scale',
        type: 'red',
        buttons: {
            Supprimer: {
                btnClass: 'btn__confirm__delete',
                action: function() {
                    let url = formElement.action
                    let payload = new FormData(formElement)
                    fetch(url, {
                        method: "POST",
                        body: payload
                    })
                        .then(res => res.json())
                        .then(data => {
                            Turbolinks.visit(data.redirect)
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
                            NotificationToast("error", "Erreur XHR: " + err)
                        });
                    document.querySelector(".jconfirm.jconfirm-modern.jconfirm-open").remove()
                }
            },
            Annuler: function () {
            }
        }
    });
}
