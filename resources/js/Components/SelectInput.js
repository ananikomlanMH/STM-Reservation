import SlimSelect from "../lib/slimSelect";
import "../lib/slimSelect.css"
export class SelectInput extends HTMLSelectElement{

    connectedCallback(){
        this.select = new SlimSelect({
            select: this,
            settings: {
                searchText: 'Aucun résultat trouvé',
                searchPlaceholder: 'Rechercher',
                searchHighlight: true
            }
        });
    }

    disconnectedCallback(){
        this.select.destroy()
    }
}

export class SelectInputTop extends HTMLSelectElement{

    connectedCallback(){
        this.select = new SlimSelect({
            select: this,
            settings: {
                searchText: 'Aucun résultat trouvé',
                searchPlaceholder: 'Rechercher',
                searchHighlight: true,
                openPosition: 'up'
            }
        });
    }

    disconnectedCallback(){
        this.select.destroy()
    }
}
