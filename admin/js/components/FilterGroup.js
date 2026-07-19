export class FilterGroup {

    constructor({
        container,
        items = [],
        field,
        render
    }) {

        this.container = container;
        this.items = items;
        this.field = field;
        this.render = render;

        this.initialize();

    }

    initialize() {

        this.container.addEventListener("change", e => {

            if (e.target.type !== "radio") {
                return;
            }

            this.filter(e.target.value);

        });

    }

    setItems(items) {
        this.items = items;
    }

    filter(value) {

        if (value === "all") {
            this.render(this.items);
            return;
        }

        const filtered = this.items.filter(item => {

            return String(item[this.field]).toLowerCase() ===
                value.toLowerCase();

        });

        this.render(filtered);

    }

}