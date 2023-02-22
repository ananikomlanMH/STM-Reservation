import flatpickr from "flatpickr";
const French = require("flatpickr/dist/l10n/fr.js").default.fr;
import 'flatpickr/dist/flatpickr.min.css'
flatpickr.localize(French);

export class DatePicker extends HTMLInputElement{

    connectedCallback(){
        this.date = flatpickr(this, {
            altInput: true,
            altFormat: "d/m/Y",
            dateFormat: "Y-m-d",
            allowInput: true
        });
    }

    disconnectedCallback(){
        this.date.destroy()
    }
}
export class TimePicker extends HTMLInputElement{

    connectedCallback(){
        this.date = flatpickr(this, {
            enableTime: true,
            noCalendar: true,
            dateFormat: "H:i",
            time_24hr: true,
            allowInput: true
        });
    }

    disconnectedCallback(){
        this.date.destroy()
    }
}

export class DatePickerTwo extends HTMLInputElement{

    connectedCallback(){
        this.date = flatpickr(this, {
            altInput: true,
            mode: "range",
            altFormat: "d/m/Y",
            dateFormat: "Y-m-d",
            allowInput: true
        });
    }

    disconnectedCallback(){
        this.date.destroy()
    }
}
